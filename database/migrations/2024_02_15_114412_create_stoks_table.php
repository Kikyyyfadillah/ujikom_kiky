<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->references('id')->on('menu')->cascadeOnDelete();
            $table->unsignedBigInteger('jumlah');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('stok');
    }
};
