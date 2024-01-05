<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Karyawan::create([
            'nomor_induk' => 'IP06001',
            'nama' => 'John Doe',
            'alamat' => 'Jl. Contoh No. 123',
            'tanggal_lahir' => '1990-01-01',
            'tanggal_bergabung' => '2024-01-01',
        ]);

        Karyawan::create([
            'nomor_induk' => 'IP06002',
            'nama' => 'Jane Doe',
            'alamat' => 'Jl. Contoh No. 456',
            'tanggal_lahir' => '1992-05-15',
            'tanggal_bergabung' => '2024-01-01',
        ]);
    }
}
