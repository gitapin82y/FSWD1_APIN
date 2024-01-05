<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cuti::create([
            'nomor_induk' => 'IP06001',
            'tanggal_cuti' => '2024-01-01',
            'lama_cuti' => 1,
            'keterangan' => 'Cuti tahunan',
        ]);

        Cuti::create([
            'nomor_induk' => 'IP06002',
            'tanggal_cuti' => '2024-01-02',
            'lama_cuti' => 1,
            'keterangan' => 'Cuti sakit',
        ]);
    }
}
