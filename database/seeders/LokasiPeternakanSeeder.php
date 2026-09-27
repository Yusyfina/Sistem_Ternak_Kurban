<?php

namespace Database\Seeders;

use App\Models\LokasiPeternakan;
use Illuminate\Database\Seeder;

class LokasiPeternakanSeeder extends Seeder
{
    public function run(): void
    {
        LokasiPeternakan::create([
            'kode' => 'A',
            'nama' => 'Kampung Ternak A',
            'alamat' => 'Bandung Barat',
            'status' => 'aktif',
        ]);

        LokasiPeternakan::create([
            'kode' => 'B',
            'nama' => 'Kampung Ternak B',
            'alamat' => 'Bandung',
            'status' => 'aktif',
        ]);

        LokasiPeternakan::create([
            'kode' => 'C',
            'nama' => 'Kampung Ternak C',
            'alamat' => 'Sumedang',
            'status' => 'aktif',
        ]);
    }
}