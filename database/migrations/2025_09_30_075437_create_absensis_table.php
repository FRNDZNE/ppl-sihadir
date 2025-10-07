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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade');
            $table->foreignId('week_id')->references('id')->on('weeks')->onDelete('cascade');
            $table->foreignId('jam_id')->references('id')->on('jams')->onDelete('cascade');
            $table->enum('status',['s','i','a','h']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
