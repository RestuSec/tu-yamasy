<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
    'siswa_id', 'jenis', 'nominal', 'bulan', 'tahun_ajaran', 'tanggal', 'status'
];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}