<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = [
        'keterangan', 'nominal', 'kategori', 'admin_id', 'tgl_pengeluaran'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}