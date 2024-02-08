<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'informasi';

    protected $fillable = ['kegiatan', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai','jenis'];


    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];
}
