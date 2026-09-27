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
        Schema::create('kategori_harga', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->enum('spesies', ['domba', 'sapi']);
            $table->decimal('bobot_min', 6, 1);
            $table->decimal('bobot_max', 6, 1);
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_harga');
    }
};
