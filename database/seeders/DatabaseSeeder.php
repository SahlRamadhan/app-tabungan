<?php

namespace Database\Seeders;

use App\Models\JenisPembayaran;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = new User;
        $admin->name = "admin";
        $admin->email = "admin@example.com";
        $admin->uuid = '1234567890'; 
        $admin->password = Hash::make('admin1234');
        $admin->role = "admin";
        $admin->status = "active";
        $admin->save();

        $jenisPembayaran = new JenisPembayaran();
        $jenisPembayaran->name = 'Cash';
        $jenisPembayaran->keterangan = 'Pembayaran secara tunai';
        $jenisPembayaran->save();

        $jenisPembayaran = new JenisPembayaran();
        $jenisPembayaran->name = 'Transfer';
        $jenisPembayaran->keterangan = 'Pembayaran secara transfer';
        $jenisPembayaran->save();
    }
}
