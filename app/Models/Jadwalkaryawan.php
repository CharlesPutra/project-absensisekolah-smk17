<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalkaryawan extends Model
{
    use HasFactory;

    protected $table = 'jadwalkaryawans';
    protected $primaryKey = 'id';
    protected $fillable = ['no_jadwal','hari','masuk','pulang','keterlambatan','keterangan'];

    public function guru()
    {
        return $this->hasMany(Guru::class,'id_jadwalkaryawan','id');
    }
}
