<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\AutoTabunganCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AutoTabunganCommand::class,
    ];

    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule)
    {
        // Jalankan tiap awal bulan jam 1 pagi
        $schedule->command('app:auto-tabungan-command')->monthlyOn(1, '01:00');
    }

    protected function commands()
    {
        // no-op
    }
}
