<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jenis_kelamin',
        'no_hp_pegawai',
        'alamat_pegawai',
        'email_pegawai',
        'foto_pegawai',
        'id_user'
    ];

    //relasi dengan jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }

    //relasi dengan kategori

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    //relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
