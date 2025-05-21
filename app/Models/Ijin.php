<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ijin extends Model
{
    use HasFactory;
    protected $table = 'ijins';
    protected $primaryKey = 'id';
    protected $fillable = ['id_nama','tanggal_mulai','tanggal_berakhir','keterangan'];

    public function guru()
    {
        return $this->belongsTo(Guru::class,'id_nama','id');
    }
}
