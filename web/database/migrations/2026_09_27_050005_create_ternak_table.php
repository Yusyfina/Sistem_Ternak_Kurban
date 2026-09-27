<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ternak', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ternak', 10); // D-1, S-1, dst (unik per lokasi)
            $table->foreignId('jenis_ternak_id')->constrained('jenis_ternak')->restrictOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasi_peternakan')->restrictOnDelete();
            $table->string('kode_rfid')->nullable();
            $table->enum('status', ['tersedia', 'dipesan', 'terkirim', 'disembelih'])->default('tersedia');
            $table->decimal('bobot_terakhir', 6, 1)->nullable();
            $table->timestamps();

            $table->unique(['lokasi_id', 'kode_ternak']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ternak');
    }
};
