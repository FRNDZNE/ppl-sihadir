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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreignId('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');
            $table->foreignId('dosen_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->foreignId('matkul_id')->references('id')->on('matkuls')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
