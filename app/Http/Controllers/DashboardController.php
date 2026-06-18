<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $jumlahMasuk   = Pengaduan::where('status', 'Masuk')->count();
        $jumlahProses  = Pengaduan::where('status', 'Proses')->count();
        $jumlahSelesai = Pengaduan::where('status', 'Selesai')->count();

        $totalPengaduan = Pengaduan::count();

        return view('dashboard', compact(
            'jumlahMasuk',
            'jumlahProses',
            'jumlahSelesai',
            'totalPengaduan'
        ));
    }
}
