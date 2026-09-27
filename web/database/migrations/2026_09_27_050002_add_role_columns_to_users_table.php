<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kode', 10)->nullable()->after('name');

            $table->enum('role', [
                'super_admin',
                'admin_pusat',
                'admin_lokasi',
                'operator',
                'mandor'
            ])->default('operator');

            $table->foreignId('lokasi_id')
                ->nullable()
                ->constrained('lokasi_peternakan')
                ->nullOnDelete();

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
