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
        Schema::create('kranis', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('asisten_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('npk');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kranis');
    }
};
