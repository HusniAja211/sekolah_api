<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model {
    use HasFactory;
    
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable = ['nama_siswa', 'alamat', 'tanggal_lahir', 'kelas_id_kelas'];

    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id_kelas');
    }
}
