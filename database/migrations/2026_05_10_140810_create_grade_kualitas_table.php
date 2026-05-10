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
        Schema::create('grade_kualitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_grade');
            $table->text('deskripsi');
            $table->text('saran_penanganan'); // Pastikan baris ini ADA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_kualitas');
    }
};
