<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $status_pendaftaran = ['menunggu', 'diterima', 'ditolak'];

        for ($i = 0; $i < 15; $i++) {
            Pendaftaran::create([
                'nik'               => $faker->unique()->numerify('###############'),
                'nama'              => $faker->name,
                'jenis_kelamin'     => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'             => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
                'tempat_lahir'      => $faker->city,
                'tanggal_lahir'     => $faker->date,
                'alamat'            => $faker->address,
                'jumlah_saudara'    => $faker->numberBetween(1, 5),
                'anak_ke'           => $faker->numberBetween(1, 5),
                'nama_wali'         => $faker->name,
                'tanggal_lahir_wali' => $faker->date,
                'email'             => $faker->safeEmail,
                'no_hp'             => $faker->e164PhoneNumber,
                'pekerjaan_wali'    => $faker->jobTitle,
                'alamat_wali'       => $faker->address,
                'status_pendaftaran'            => $faker->randomElement($status_pendaftaran),
            ]);
        }
    }
}
