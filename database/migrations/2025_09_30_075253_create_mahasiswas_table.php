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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('angkatan_id')->references('id')->on('angkatans')->onDelete('cascade');
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreignId('semester_id')->references('id')->on('semesters')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->enum('gender',['pria','wanita']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
