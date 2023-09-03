<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Misalkan Anda ingin menyisipkan 5 data untuk pengumuman yang berelasi dengan pendaftaran dimulai dari ID 16
        for ($i = 20; $i <= 30; $i++) {
            DB::table('pengumuman')->insert([
                'pendaftaran_id' => $i,
                'tanggal_pengumuman' => Carbon::now()->format('Y-m-d'),
                'keterangan' => 'Keterangan untuk pendaftaran dengan ID ' . $i, // Anda bisa mengganti ini sesuai kebutuhan
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
