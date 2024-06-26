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
        Schema::table('jawaban', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_kategori')->nullable();
            // $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('set null');

            $table->unsignedBigInteger('id_kuesioner')->after('id_jawaban')->nullable();
            $table->foreign('id_kuesioner')->references('id_kuesioner')->on('kuesioner')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban', function (Blueprint $table) {
            $table->dropForeign(['id_kuesioner']);
            $table->dropColumn('id_kuesioner');
        });
    }
};
