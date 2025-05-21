<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
     protected $table = 'gurus';
       protected $primaryKey = 'id';
       protected $fillable = ['no_guru','nama_guru','jenis_kelamin', 'karyawan','id_jadwalkaryawan','id_jurusan','id_jadwalguru'];
      
       public function jurusan()    
       {
           return $this->belongsTo(Jurusan::class,'id_jurusan', 'id');
       }
       public function jadwalgr()
       {
           return $this->belongsTo(Jadwalguru::class,'id_jadwalguru', 'id');
       }
       public function jadwalkr()
       {
           return $this->belongsTo(Jadwalkaryawan::class,'id_jadwalkaryawan', 'id');
       }
       public function ijin()
       {
        return $this->hasMany(Ijin::class,'id_nama','id');
       }

     public function laporan()
       {
           return $this->belongsTo(Laporan::class,'id_anggota','id'); // Pastikan 'anggota_id' sesuai
       }
}
