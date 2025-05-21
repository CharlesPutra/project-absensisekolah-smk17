<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporans';
    protected $primaryKey = 'id_absensi';
    protected $fillable = ['id_anggota','waktu_absen'];

      public function guru()
    {
        return $this->belongsTo(Guru::class,'id_anggota','id'); // Pastikan 'anggota_id' sesuai
    }
}
