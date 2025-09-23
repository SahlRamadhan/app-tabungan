<?php

namespace App\Console\Commands;

use App\Models\Balances;
use App\Models\JenisPembayaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoTabunganCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-tabungan-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Carbon::setTestNow(Carbon::parse('2025-11-01'));

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth   = Carbon::now()->endOfMonth();

        $cash = JenisPembayaran::firstOrCreate([
            'name' => 'Cash'
        ], [
            'name' => 'Cash'
        ]);

        // ambil semua user
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {

            if ($user->created_at >= $startOfMonth) {
                continue;
            }

            $jumlahTransaksi = Balances::where('user_id', $user->id)->count();

            if ($jumlahTransaksi < 2) {
                // kalau masih kurang dari 2 transaksi, skip
                continue;
            }
            // cek apakah user sudah ada transaksi bulan ini
            $alreadyDeposited = Balances::where('user_id', $user->id)
                ->where('type', 'deposit')
                ->where('status', 'in')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->exists();

            if (! $alreadyDeposited) {
                // ambil saldo bulan lalu
                $totalIn = Balances::where('user_id', $user->id)
                    ->where('type', 'deposit')
                    ->where('status', 'in')
                    ->where('created_at', '<', $startOfMonth)
                    ->sum('amount');

                $totalOut = Balances::where('user_id', $user->id)
                    ->where('type', 'withdraw')
                    ->where('status', 'in')
                    ->where('created_at', '<', $startOfMonth)
                    ->sum('amount');

                $saldoBulanLalu = $totalIn - $totalOut;

                // gunakan simpan_pokok dari user
                $autoAmount = ($user->simpan_pokok ?? 0);

                // buat transaksi otomatis
                Balances::create([
                    'user_id'            => $user->id,
                    'jenispembayaran_id' => $cash->id,
                    'amount'             => $autoAmount,
                    'type'               => 'deposit',
                    'status'             => 'in',
                    'approved_by_id'     => 1, // system admin
                    'approved_at'        => now(),
                ]);

                $this->info("Auto tabungan dibuat untuk user dengan ID {$user->id} {$user->name} sebesar {$autoAmount} (Saldo bulan lalu: {$saldoBulanLalu})");
            }
        }

        // kembalikan waktu ke real sekarang setelah test
        // Carbon::setTestNow();
    }
}
