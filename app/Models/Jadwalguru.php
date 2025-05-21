<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalguru extends Model
{
    use HasFactory;
    protected $table = 'jadwalgurus';
    protected $primaryKey = 'id';
    protected $fillable = ['no_jadwalguru','masuk','pulang', 'keterlambatan','id_jurusan','keterangan', 'hari' ];

   public function jurusan()
   {
    return $this->belongsTo(Jurusan::class,'id_jurusan','id');
   }

   public function guru()
   {
    return $this->hasMany(Guru::class,'id_jadwalguru','id');
   }
}
