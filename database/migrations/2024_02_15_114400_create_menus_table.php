<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->references('id')->on('jenis')->cascadeOnDelete();
            $table->string('nama_menu');
            $table->double('harga');
            $table->string('image');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
