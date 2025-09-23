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

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('user_id', 'LIKE', '%' . $keyword . '%')
                ->orWhere('amount', 'LIKE', '%' . $keyword . '%')
                ->orWhere('status', 'LIKE', '%' . $keyword . '%')
                ->orWhere('type', 'LIKE', '%' . $keyword . '%')
                ->orWhere('created_at', 'LIKE', '%' . $keyword . '%');
            $q->orWhereHas('user', function ($userQuery) use ($keyword) {
                $userQuery->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%');
            });
            $q->orWhereHas('jenisPembayaran', function ($jpQuery) use ($keyword) {
                $jpQuery->where('name', 'LIKE', '%' . $keyword . '%');
            });
        });
    }
}
