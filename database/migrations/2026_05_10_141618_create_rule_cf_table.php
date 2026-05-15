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
        Schema::create('rule_cf', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pilihan_kriteria_id') ->constrained('pilihan_kriteria') ->onDelete('cascade');
            $table->foreignId('grade_id') ->constrained('grade_kualitas') ->onDelete('cascade');
            $table->decimal('nilai_cf', 4, 2);
            $table->timestamps();
        });
    }

        /**
        * Reverse the migrations.
        */
    public function down(): void
    {
        Schema::dropIfExists('rule_cf');
    }
};
