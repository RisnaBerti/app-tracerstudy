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
        Schema::create('pertanyaan', function (Blueprint $table) {
            $table->id('id_pertanyaan');
            $table->string('pertanyaan', 100);
            $table->string('tipe_pertanyaan', 100);
            $table->unsignedBigInteger('id_kuesioner'); // asumsikan tipe data id_user adalah bigInteger
            $table->foreign('id_kuesioner')->references('id_kuesioner')->on('kuesioner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
        //drop id_kuesioner
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->dropForeign(['id_kuesioner']);
            $table->dropColumn('id_kuesioner');
        });
    }
};
