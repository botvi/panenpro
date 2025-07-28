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
        Schema::create('data_panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemanen_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_blok');
            $table->string('no_tph');
            $table->integer('ripe');
            $table->integer('over_ripe');
            $table->integer('under_ripe');
            $table->integer('eb');
            $table->integer('brondolan');
            $table->integer('jumlah_buah_per_blok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_panens');
    }
};
