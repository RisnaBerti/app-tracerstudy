<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = ['id_pertanyaan', 'nisn', 'id_tahun_lulus', 'id_kategori', 'jawaban'];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'nisn');
    }

    //relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    //relasi dengan tahun lulus
    public function tahunLulus()
    {
        return $this->belongsTo(TahunLulus::class, 'id_tahun_lulus');
    }
}
