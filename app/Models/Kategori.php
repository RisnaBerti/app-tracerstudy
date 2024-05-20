<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'no_urut_tampil'
    ];

    //relasi dengan alumni
    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_kategori', 'id_kategori');
    }

    //relasi dengan jurusan
    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'id_kategori', 'id');
    }

    //relasi dengan pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_kategori', 'id');
    }

    //relasi dengan tahun lulus
    public function tahunLulus()
    {
        return $this->hasMany(TahunLulus::class, 'id_kategori', 'id');
    }
}
