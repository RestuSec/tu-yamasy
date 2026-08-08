<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_bank',
        'no_rekening',
        'atas_nama',
        'qris_image',
        'no_telepon',
        'nama_kontak',
    ];
}