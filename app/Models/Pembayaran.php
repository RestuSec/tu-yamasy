<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'tagihan_id', 'metode', 'bukti', 'status', 'verified_by', 'tgl_bayar'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}