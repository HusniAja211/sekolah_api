<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model {
    use HasFactory;
    
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['nama_mapel', 'tingkat_kesulitan'];

    public function jadwal_pelajaran() {
        return $this->hasMany(jadwal_pelajaran::class, 'mapel_id_mapel');
    }
}

