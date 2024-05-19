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
        Schema::table('alumni', function (Blueprint $table) {
            // Pastikan kolom yang akan dijadikan foreign key sudah ada di tabel
            $table->unsignedBigInteger('id_kategori')->after('foto_alumni')->nullable(); // Menjadikannya nullable sementara jika diperlukan
            $table->unsignedBigInteger('id_jurusan')->after('id_kategori')->nullable();
            $table->unsignedBigInteger('id_tahun_lulus')->after('id_jurusan')->nullable();

            // Tambahkan foreign key constraints
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade');
            $table->foreign('id_tahun_lulus')->references('id_tahun_lulus')->on('tahun_lulus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('id_kategori');
            $table->dropForeign(['id_jurusan']);
            $table->dropColumn('id_jurusan');
            $table->dropForeign(['id_tahun_lulus']);
            $table->dropColumn('id_tahun_lulus');
        });
    }
};
