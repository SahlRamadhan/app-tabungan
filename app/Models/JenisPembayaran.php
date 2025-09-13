<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    public function balances()
    {
        return $this->hasMany(Balances::class, 'jenispembayaran_id', 'id');
    }
}
