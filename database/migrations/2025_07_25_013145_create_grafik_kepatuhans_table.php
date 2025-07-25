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
        Schema::create('grafik_kepatuhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemanen_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('mandor_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keluar_buah');
            $table->string('alas_karung_brondol');
            $table->string('panen_blok_17');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grafik_kepatuhans');
    }
};
