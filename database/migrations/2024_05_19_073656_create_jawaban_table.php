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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->unsignedBigInteger('nisn');
            $table->unsignedBigInteger('id_tahun_lulus');
            $table->unsignedBigInteger('id_kategori');
            $table->string('jawaban', 100);
            $table->timestamps();

            // Tambahkan foreign key constraints
            $table->foreign('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaan')->onDelete('cascade');
            $table->foreign('nisn')->references('nisn')->on('alumni')->onDelete('cascade');
            $table->foreign('id_tahun_lulus')->references('id_tahun_lulus')->on('tahun_lulus')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {
            $table->dropForeign(['id_pertanyaan']);
            $table->dropForeign(['nisn']);
            $table->dropForeign(['id_tahun_lulus']);
            $table->dropForeign(['id_kategori']);
        });

        Schema::dropIfExists('jawaban');
    }
};
