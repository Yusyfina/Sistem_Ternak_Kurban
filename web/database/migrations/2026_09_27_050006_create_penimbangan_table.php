<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/xxxx_create_penimbangan_table.php
return new class extends Migration {
    public function up(): void
    {
        Schema::create('penimbangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ternak_id')->constrained('ternak')->cascadeOnDelete();
            $table->decimal('bobot', 6, 1);
            $table->enum('metode', ['manual', 'estimasi', 'otomatis_iot'])->default('manual');
            $table->enum('sumber', ['manual_entry', 'otomatis_iot', 'data_manajemen', 'tidak_ada_data'])->default('manual_entry');
            $table->foreignId('operator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status_verifikasi', ['menunggu', 'valid', 'kurang_akurat', 'tidak_valid'])->default('menunggu');
            $table->text('catatan_verifikasi')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diverifikasi_at')->nullable();
            $table->timestamp('ditimbang_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penimbangan');
    }
};
