<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryChat extends Model
{
    protected $table = 'history_chat';

    protected $fillable = [
        'id_laporan',
        'user_chat',
        'petugas_chat',
        'user',
        'nama_petugas',
        'waktu'
    ];

    public $timestamps = false;

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_laporan', 'id_laporan');
    }
}
