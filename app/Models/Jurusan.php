<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = ['id_jurusan', 'nama_jurusan'];

    //relasi dengan alumni
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_jurusan', 'id');
    }

    //relasi dengan pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jurusan', 'id');
    }

    //relasi dengan tahun lulus
    public function tahunLulus()
    {
        return $this->hasMany(TahunLulus::class, 'id_jurusan', 'id');
    }

    //relasi dengan kategori
    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'id_jurusan', 'id');
    }
}
