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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('nip'); // id_user
            $table->string('nama_pegawai');
            $table->string('jenis_kelamin');
            $table->string('no_hp_pegawai');
            $table->string('alamat_pegawai');
            $table->string('email_pegawai')->unique();
            $table->string('foto_pegawai');
            $table->unsignedBigInteger('user_id'); // asumsikan tipe data id_user adalah bigInteger
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
        //hapus relasi tabel users
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
};
