<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    use HasFactory;

    protected $table = 'kuesioner';
    protected $primaryKey = 'id_kuesioner';
    protected $fillable = [
        'id_kuesioner',
        'judul_kuesioner', 
        'deskripsi_kuesioner', 
        'tgl_kuesioner'
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_kuesioner');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_kuesioner');
    }
}
