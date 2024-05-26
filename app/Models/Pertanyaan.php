<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $fillable = ['id_kuesioner', 'pertanyaan', 'tipe_pertanyaan', 'id_kategori' ];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
    }

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiPertanyaan::class, 'id_pertanyaan');
    }

    //relasi model jawaban
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan');
    }

    //relasi model kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // public function opsiJawaban()
    // {
    //     return $this->hasMany(OpsiJawaban::class, 'id_pertanyaan');
    // }
}
