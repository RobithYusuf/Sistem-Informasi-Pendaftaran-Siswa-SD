<?php

namespace App\Models;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengumuman extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pengumuman';

    // public function pendaftaran()
    // {
    //     return $this->belongsTo(Pendaftaran::class);
    // }
}
