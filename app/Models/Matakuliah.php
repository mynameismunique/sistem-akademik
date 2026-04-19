<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'id_matakuliah';  // Custom PK
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = ['nama_matakuliah', 'sks', 'id_jurusan'];
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}