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
        Schema::table('kuesioner', function (Blueprint $table) {
            $table->string('tahun_lulus_awal')->nullable()->after('tgl_kuesioner');
            $table->string('tahun_lulus_akhir')->nullable()->after('tahun_lulus_awal');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuesioner', function (Blueprint $table) {
            //
        });
    }
};
