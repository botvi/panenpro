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
        Schema::create('absensi_berkalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemanen_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mandor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('blok');
            $table->string('baris');
            $table->enum('arah_masuk', ['Barat', 'Timur']);
            $table->string('jam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_berkalas');
    }
};
