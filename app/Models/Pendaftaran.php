<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pendaftaran';

    // public function pengumuman()
    // {
    //     return $this->hasOne(Pengumuman::class,'pendaftaran_id');
    // }

    public function berkas()
    {
        return $this->hasOne(Berkas::class,'pendaftaran_id');
    }
}
