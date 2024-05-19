<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $fillable = ['id_kuesioner', 'pertanyaan', 'tipe_pertanyaan'];

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan');
    }
}
