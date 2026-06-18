<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'id_laporan',
        'nomor_hp',
        'nama',
        'jenis_pengaduan',
        'deskripsi',
        'teks',
        'gambar',
        'latitude',
        'longitude',
        'waktu',
        'status',
        'foto',
        'is_connected',
    ];

    public $timestamps = false;
}
