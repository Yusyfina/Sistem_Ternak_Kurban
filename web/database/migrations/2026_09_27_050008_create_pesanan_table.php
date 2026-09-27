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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('no_pesanan')->unique();

            $table->foreignId('pembeli_id')
                ->constrained('pembeli')
                ->restrictOnDelete();

            $table->foreignId('kategori_harga_id')
                ->constrained('kategori_harga')
                ->restrictOnDelete();

            $table->decimal('harga', 15, 2);

            $table->enum('status', [
                'menunggu_pemasangan',
                'terpasang',
                'dibatalkan'
            ])->default('menunggu_pemasangan');

            $table->foreignId('ternak_id')
                ->nullable()
                ->constrained('ternak')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
