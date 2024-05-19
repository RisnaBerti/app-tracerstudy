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
        Schema::create('opsi_jawaban', function (Blueprint $table) {
            $table->id('id_opsi');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->string('opsi', 50);
            $table->timestamps();

            $table->foreign('id_pertanyaan')
                ->references('id_pertanyaan')
                ->on('pertanyaan')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('opsi_jawaban', function (Blueprint $table) {
            $table->dropForeign(['id_pertanyaan']);
        });
        Schema::dropIfExists('opsi_jawaban');
    }
};
