<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunLulus extends Model
{
    use HasFactory;

    protected $table = 'tahun_lulus';
    protected $primaryKey = 'id_tahun_lulus';
    protected $fillable = ['id_tahun_lulus', 'tahun_lulus'];

    public function alumni()
    {
        return $this->hasMany(Alumni::class, 'id_tahun_lulus');
    }
}
