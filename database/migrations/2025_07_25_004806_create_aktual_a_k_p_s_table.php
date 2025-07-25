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
        Schema::create('aktual_a_k_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mandor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_blok');
            $table->string('satuan_per_hektar');
            $table->string('jumlah_janjang');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktual_a_k_p_s');
    }
};
