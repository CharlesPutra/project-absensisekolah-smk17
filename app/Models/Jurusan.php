<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusans';
    protected $primaryKey = 'id';
    protected $fillable = ['no_jurusan', 'jurusan'];

    public function jadwalguru()
    {
        return $this->hasMany(Jadwalguru::class,'id_jurusan', 'id');
    }

    public function guru()
    {
        return $this->hasMany(Guru::class,'id_jurusan', 'id');
    }
}
