<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman'; // <-- UBAH MENJADI INI

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function angsurans()
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id', 'id');
    }
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenispembayaran_id', 'id');
    }
    
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }
    public function scopeFilter($query, $filters)
    {
        $query->with(['user', 'jenisPembayaran']);

        if (!empty($filters['bulan'])) {
            $query->whereMonth('created_at', $filters['bulan']);
        }

        if (!empty($filters['tahun'])) {
            $query->whereYear('created_at', $filters['tahun']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['jenisPembayaran'])) {
            $query->where('jenis_pembayaran_id', $filters['jenisPembayaran']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['range'])) {
            switch ($filters['range']) {
                case 'today':
                    $query->whereDate('created_at', now());
                    break;
                case 'last_week':
                    $query->whereBetween('created_at', [
                        now()->subWeek()->startOfWeek(),
                        now()->subWeek()->endOfWeek()
                    ]);
                    break;
                case 'last_month':
                    $query->whereMonth('created_at', now()->subMonth()->month)
                        ->whereYear('created_at', now()->subMonth()->year);
                    break;
                case 'this_year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        return $query;
    }
}
