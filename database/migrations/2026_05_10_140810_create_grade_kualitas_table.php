<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grade_kualitas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_grade');
            $table->string('nama_grade');
            $table->decimal('cf_min', 4, 2);
            $table->decimal('cf_max', 4, 2);
            $table->text('deskripsi');
            $table->text('rekomendasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grade_kualitas');
    }
};