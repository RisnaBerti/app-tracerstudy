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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id('nisn'); // id_user
            $table->string('nama_alumni');
            $table->string('jenis_kelamin');
            $table->string('no_hp_alumni');
            $table->string('alamat_alumni');
            $table->string('email_alumni')->unique();
            $table->string('foto_alumni');
            $table->unsignedBigInteger('id_user'); // asumsikan tipe data id_user adalah bigInteger
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
        //hapus relasi tabel users
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
};
