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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail'); // Simpan path untuk gambar thumbnail
            $table->string('title');
            $table->string('director');
            $table->string('rating')->nullable();
            $table->year('release_year'); // Simpan tahun rilis menggunakan tipe 'year'
            $table->json('genre');
            $table->string('link');
            $table->text('synopsis');
            $table->integer('duration'); // Simpan durasi dalam satuan menit atau detik
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
