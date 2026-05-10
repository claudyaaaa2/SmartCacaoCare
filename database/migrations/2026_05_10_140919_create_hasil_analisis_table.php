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
        Schema::create('hasil_analisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('grade_id')->constrained('grade_kualitas')->onDelete('cascade');
            $table->double('persentase'); // Hasil akhir CF (misal 0.85 untuk 85%)
            $table->text('pilihan_user'); // Simpan pilihan user dalam format JSON untuk riwayat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_analisis');
    }
};
