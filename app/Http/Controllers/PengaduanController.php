<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pengaduan;
use App\Models\HistoryChat;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class PengaduanController extends Controller
{
    public function showPengaduan(Request $request)
    {
        $tanggalDari   = $request->tanggal_dari ?? Carbon::today()->toDateString();
        $tanggalSampai = $request->tanggal_sampai ?? Carbon::today()->toDateString();

        $status = $request->status ?? ['Masuk', 'Proses', 'Selesai', 'Tidak Terselesaikan'];

        $pengaduan = Pengaduan::whereBetween('waktu', [
            $tanggalDari . ' 00:00:00',
            $tanggalSampai . ' 23:59:59'
        ])
            ->whereIn('status', $status)
            ->orderBy('waktu', 'desc')
            ->get();

        return view('pengaduan', compact(
            'pengaduan',
            'tanggalDari',
            'tanggalSampai',
            'status'
        ));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $chats = HistoryChat::where('id_laporan', $pengaduan->id_laporan)
            ->orderBy('waktu', 'asc')
            ->get();

        return view('detail_pengaduan', compact('pengaduan', 'chats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Masuk,Proses,Selesai,Tidak Terselesaikan',
            'foto'   => 'required_if:status,Selesai|image|mimes:jpg,jpeg,png|max:5120',
            'alasan' => 'required_if:status,Tidak Terselesaikan'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $fotoPath = null;

        if ($request->status === 'Selesai' && $request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('foto'), $namaFile);

            $pengaduan->foto = $namaFile;
            $fotoPath = public_path('foto/' . $namaFile);
        }

        if ($request->status === 'Tidak Terselesaikan') {
            $pengaduan->alasan = $request->alasan;
        } else {
            $pengaduan->alasan = null;
        }

        $pengaduan->status = $request->status;

        // Auto disconnect chat if status is Selesai or Tidak Terselesaikan
        if (in_array($request->status, ['Selesai', 'Tidak Terselesaikan'])) {
            if ($pengaduan->is_connected == 1) {
                // Notifikasi ke bot untuk memutus chat
                try {
                    Http::post('http://localhost:3000/disconnect-chat', [
                        'chat_id'   => $pengaduan->id_chat,
                        'id_laporan' => $pengaduan->id_laporan
                    ]);
                } catch (\Exception $e) {
                    Log::error('Gagal mengirim disconnect chat ke bot: ' . $e->getMessage());
                }
            }
            $pengaduan->is_connected = 0;
        }

        $pengaduan->save();

        try {
            $statusTerkirim = $pengaduan->status;
            if ($pengaduan->status === 'Tidak Terselesaikan') {
                $statusTerkirim .= ' (Alasan: ' . $request->alasan . ')';
            }

            $pendingRequest = Http::asMultipart();

            if ($fotoPath && file_exists($fotoPath)) {
                $pendingRequest->attach(
                    'foto',
                    file_get_contents($fotoPath),
                    basename($fotoPath)
                );
            }

            $pendingRequest->post('http://localhost:3000/send-status', [
                'id_laporan' => $pengaduan->id_laporan,
                'status'     => $statusTerkirim
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim status ke WhatsApp: ' . $e->getMessage());
        }

        return back()->with('success', 'Status berhasil diperbarui dan dikirim ke WhatsApp.');
    }

    public function connectChat($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $response = Http::post('http://localhost:3000/connect-chat', [
            'chat_id'   => $pengaduan->id_chat,
            'id_laporan' => $pengaduan->id_laporan
        ]);

        if ($response->successful()) {
            $pengaduan->update(['is_connected' => 1]);
            return back()->with('success', 'Chat berhasil dihubungkan ke petugas');
        }

        return back()->with('error', 'Gagal menghubungkan chat');
    }

    public function disconnectChat($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $response = Http::post('http://localhost:3000/disconnect-chat', [
            'chat_id'   => $pengaduan->id_chat,
            'id_laporan' => $pengaduan->id_laporan
        ]);

        if ($response->successful()) {
            $pengaduan->update(['is_connected' => 0]);
            return back()->with('success', 'Chat berhasil diputus');
        }

        return back()->with('error', 'Gagal memutus chat');
    }

    public function sendChat(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $namaPetugas = Auth::user()->name;

        HistoryChat::create([
            'id_laporan'   => $pengaduan->id_laporan,
            'user_chat'    => null,
            'petugas_chat' => $request->pesan,
            'nama_petugas' => $namaPetugas,
            'user'         => 0,
        ]);

        Http::post('http://localhost:3000/send-petugas-chat', [
            'chat_id'       => $pengaduan->id_chat,
            'pesan'         => $request->pesan,
            'id_laporan'    => $pengaduan->id_laporan,
            'nama_petugas'  => $namaPetugas
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    public function printPdf(Request $request)
    {
        $ids = json_decode($request->ids, true);

        if (!$ids || count($ids) === 0) {
            return back()->with('error', 'Tidak ada data untuk dicetak');
        }

        $pengaduan = Pengaduan::whereIn('id', $ids)->get();

        File::ensureDirectoryExists(public_path('temp'));

        foreach ($pengaduan as $p) {

            if ($p->gambar) {
                $filename = basename($p->gambar);
                $tempPath = public_path('temp/' . $filename);

                if (!file_exists($tempPath)) {
                    $nodeUrl = "http://localhost:3000/uploads/" . $filename;
                    $image = @file_get_contents($nodeUrl);

                    if ($image) {
                        file_put_contents($tempPath, $image);
                    }
                }

                if (file_exists($tempPath)) {
                    $type = pathinfo($tempPath, PATHINFO_EXTENSION);
                    $data = file_get_contents($tempPath);
                    $p->gambar_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                } else {
                    $p->gambar_base64 = null;
                }
            } else {
                $p->gambar_base64 = null;
            }

            if ($p->foto) {
                $fotoPath = public_path('foto/' . $p->foto);

                if (file_exists($fotoPath)) {
                    $type = pathinfo($fotoPath, PATHINFO_EXTENSION);
                    $data = file_get_contents($fotoPath);
                    $p->foto_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                } else {
                    $p->foto_base64 = null;
                }
            } else {
                $p->foto_base64 = null;
            }
        }

        $pdf = Pdf::loadView('reports.print_pengaduan', compact('pengaduan'))
            ->setPaper('A4', 'landscape')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return $pdf->download('laporan-pengaduan.pdf');
    }
}
