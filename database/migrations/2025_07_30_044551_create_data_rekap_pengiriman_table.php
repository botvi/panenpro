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
        Schema::create('data_rekap_pengirimen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('blok_id')->constrained('data_bloks')->onDelete('cascade')->onUpdate('cascade');
            $table->string('no_tph');
            $table->string('kode_panen');
            $table->string('ripe');
            $table->string('over');
            $table->string('ur');
            $table->string('udr');
            $table->string('total');
            $table->string('brd');
            $table->string('bs');
            $table->string('bjr');
            $table->string('sph');
            $table->string('akp_actual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_rekap_pengirimen');
    }
};
