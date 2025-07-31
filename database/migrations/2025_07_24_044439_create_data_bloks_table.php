<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_bloks', function (Blueprint $table) {
            $table->id();
            $table->string('blok');
            $table->string('estate');
            $table->string('adfeling');
            $table->integer('tt');
            $table->integer('luas');
            $table->integer('bjr');
            $table->integer('sph');
            $table->integer('jumlah_pokok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_bloks');
    }
};
