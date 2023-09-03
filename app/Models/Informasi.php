<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'informasi';

    protected $dates = ['tanggal', 'tanggal_mulai', 'tanggal_selesai', 'tanggal_pengumuman', 'tanggal_daftar_ulang'];

    protected $casts = [
        'tanggal'=> 'datetime',
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'tanggal_pengumuman' => 'datetime',
        'tanggal_daftar_ulang' => 'datetime',
    ];
}
