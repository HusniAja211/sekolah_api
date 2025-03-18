<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model {
    use HasFactory;
    
    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    protected $fillable = [
        'nama_guru',
        'spesialisasi',
        'nomor_hp'
    ];

    public function kelas() {
        return $this->hasMany(Kelas::class, 'id_wali_kelas');
    }

    public function jadwal_pelajaran() {
        return $this->hasMany(jadwal_pelajaran::class, 'guru_id_guru');
    }
}
