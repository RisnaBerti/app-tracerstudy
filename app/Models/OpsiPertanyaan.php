<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsiPertanyaan extends Model
{
    use HasFactory;

    protected $table = 'opsi_jawaban';
    protected $primaryKey = 'id_opsi';
    protected $fillable = ['id_opsi', 'id_pertanyaan', 'opsi'];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }
    
    
}
