<?php

namespace Database\Seeders;

use App\Models\JenisTernak;
use Illuminate\Database\Seeder;

class JenisTernakSeeder extends Seeder
{
    public function run(): void
    {
        JenisTernak::create([
            'spesies' => 'domba',
            'nama_jenis' => 'Domba Garut',
        ]);

        JenisTernak::create([
            'spesies' => 'domba',
            'nama_jenis' => 'Domba Batur',
        ]);

        JenisTernak::create([
            'spesies' => 'sapi',
            'nama_jenis' => 'Sapi Jawa',
        ]);

        JenisTernak::create([
            'spesies' => 'sapi',
            'nama_jenis' => 'Sapi Bali',
        ]);

        JenisTernak::create([
            'spesies' => 'sapi',
            'nama_jenis' => 'Sapi Limousin',
        ]);
    }
}