<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';  // Custom PK
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = ['nim', 'nama', 'id_jurusan'];
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}