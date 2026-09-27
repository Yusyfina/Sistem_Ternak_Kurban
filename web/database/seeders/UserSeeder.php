<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@contoh.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'aktif',
            'lokasi_id' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Admin Pusat
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin Pusat 1',
            'email' => 'pusat@contoh.id',
            'password' => Hash::make('password'),
            'role' => 'admin_pusat',
            'status' => 'aktif',
            'lokasi_id' => null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Admin Lokasi
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Admin Lokasi A',
            'email' => 'lokasi.a@contoh.id',
            'password' => Hash::make('password'),
            'role' => 'admin_lokasi',
            'lokasi_id' => 1,
            'status' => 'aktif',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Operator
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Operator 1',
            'kode' => 'OP-01',
            'email' => 'op1@contoh.id',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'lokasi_id' => 1,
            'status' => 'aktif',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Mandor
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Mandor 1',
            'kode' => 'MD-01',
            'email' => 'md1@contoh.id',
            'password' => Hash::make('password'),
            'role' => 'mandor',
            'lokasi_id' => 1,
            'status' => 'aktif',
        ]);
    }
}