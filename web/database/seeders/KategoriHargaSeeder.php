<?php

namespace Database\Seeders;

use App\Models\KategoriHarga;
use Illuminate\Database\Seeder;

class KategoriHargaSeeder extends Seeder
{
    public function run(): void
    {
        KategoriHarga::create([
            'kategori' => 'Domba A',
            'spesies' => 'domba',
            'bobot_min' => 20,
            'bobot_max' => 30,
            'harga' => 2400000,
            'status' => 'aktif',
        ]);

        KategoriHarga::create([
            'kategori' => 'Domba B',
            'spesies' => 'domba',
            'bobot_min' => 30,
            'bobot_max' => 40,
            'harga' => 3200000,
            'status' => 'aktif',
        ]);

        KategoriHarga::create([
            'kategori' => 'Sapi C',
            'spesies' => 'sapi',
            'bobot_min' => 300,
            'bobot_max' => 400,
            'harga' => 21000000,
            'status' => 'aktif',
        ]);
    }
}