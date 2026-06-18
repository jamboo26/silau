<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: middle;
        }

        th {
            background: #eee;
            text-align: center;
        }

        img {
            width: 80px;
            max-height: 80px;
            object-fit: contain;
        }

        .status-title {
            background-color: #0b5ed7;
            color: white;
            padding: 8px;
            margin-top: 20px;
            margin-bottom: 0;
            display: inline-block;
            border-radius: 4px 4px 0 0;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center;">LAPORAN DATA PENGADUAN</h2>
    <h4 style="text-align:center;">DINAS PERHUBUNGAN KABUPATEN SUMEDANG</h4>

    @php
        // Mengelompokkan laporan berdasarkan statusnya
        $groupedPengaduan = $pengaduan->groupBy('status');
    @endphp

    @foreach($groupedPengaduan as $status => $items)
        <div class="status-title">Status: {{ $status }}</div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Gambar</th>
                    <th>Waktu</th>
                    @if($status == 'Tidak Terselesaikan')
                    <th>Alasan Tidak Selesai</th>
                    @else
                    <th>Foto Selesai</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach($items as $index => $p)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $p->id_laporan }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->jenis_pengaduan }}</td>
                    <td>{{ $p->deskripsi }}</td>

                    <td>
                        {{ $p->latitude }}, {{ $p->longitude }}
                    </td>

                    <td style="text-align: center;">
                        @if($p->gambar_base64)
                        <img src="{{ $p->gambar_base64 }}">
                        @endif
                    </td>

                    <td>{{ $p->waktu }}</td>

                    @if($status == 'Tidak Terselesaikan')
                    <td>{{ $p->alasan ?? '-' }}</td>
                    @else
                    <td style="text-align: center;">
                        @if($p->foto_base64)
                        <img src="{{ $p->foto_base64 }}">
                        @else
                        -
                        @endif
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

</body>

</html>