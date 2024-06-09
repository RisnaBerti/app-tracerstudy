<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';
    protected $primaryKey = 'nisn';
    protected $fillable = [
        'nisn',
        'nama_alumni',
        'jenis_kelamin',
        'no_hp_alumni',
        'alamat_alumni',
        'email_alumni',
        'foto_alumni',
        'id_jurusan',
        'id_kategori',
        'id_tahun_lulus',
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

    //relasi dengan tahun lulus
    public function tahun_lulus()
    {
        return $this->belongsTo(TahunLulus::class, 'id_tahun_lulus', 'id_tahun_lulus');
    }

    // Hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    //relasi dengan jawaban
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'nisn', 'nisn');
    }
}
