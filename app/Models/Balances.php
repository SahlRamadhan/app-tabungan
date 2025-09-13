<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balances extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenispembayaran_id', 'id');
    }
}
