<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nis', 'nama', 'kelas', 'tahun_ajaran', 'nama_ortu', 'nama_ibu', 'no_hp'
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
}