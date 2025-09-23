<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balances extends Model
{
    protected $casts = [
        'approved_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'jenispembayaran_id',
        'amount',
        'bukti_pembayaran',
        'status',
        'approved_by_id',
        'approved_at',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenispembayaran_id', 'id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
}
