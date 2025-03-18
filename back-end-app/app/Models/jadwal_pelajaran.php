<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_pelajaran extends Model {
    use HasFactory;
    
    protected $table = 'jadwal_pelajaran';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = ['hari', 'jam_mulai', 'jam_selesai', 'guru_id_guru', 'kelas_id_kelas', 'mapel_id_mapel'];

    public function guru() {
        return $this->belongsTo(Guru::class, 'guru_id_guru');
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id_kelas');
    }

    public function mapel() {
        return $this->belongsTo(Mapel::class, 'mapel_id_mapel');
    }
}

