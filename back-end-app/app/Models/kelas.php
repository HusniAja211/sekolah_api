<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model {
    use HasFactory;
    
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas', 'id_wali_kelas'];

    public function waliKelas() {
        return $this->belongsTo(Guru::class, 'id_wali_kelas');
    }

    public function siswa() {
        return $this->hasMany(Siswa::class, 'kelas_id_kelas');
    }

    public function jadwal_pelajaran() {
        return $this->hasMany(jadwal_pelajaran::class, 'kelas_id_kelas');
    }
}
