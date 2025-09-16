<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\JenisPembayaran\JenisPembayaran;
use App\Livewire\Admin\Transaksi\Peminjaman;
use App\Livewire\Admin\Transaksi\Tabungan;
use App\Livewire\Admin\Users\Index;
use App\Livewire\Admin\Users\Tambah;
use App\Livewire\Users\Auth\Login;
use App\Livewire\Users\Auth\Register;
use App\Livewire\Users\Dashboard\Dashboard as DashboardDashboard;
use App\Livewire\Users\Transaksi\AddTabungan;
use App\Livewire\Users\Transaksi\PeminjamanUsers;
use App\Livewire\Users\Transaksi\TabunganUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get(
    '/logout',
    function () {
        Auth::logout();
        return redirect()->route('login');
    }
)->name('logout');


//middleware
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/users', Index::class)->name('admin.users.index');
    Route::get('/admin/tambah', Tambah::class)->name('admin.users.tambah');
    Route::get('/admin/tabungan', Tabungan::class)->name('admin.transaksi.tabungan');
    Route::get('/admin/peminjaman', Peminjaman::class)->name('admin.transaksi.peminjaman');
    Route::get('/admin/jenis-pembayaran', JenisPembayaran::class)->name('admin.jenis-pembayaran');
});
Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', DashboardDashboard::class)->name('dashboard');
    Route::get('/tabungan', TabunganUsers::class)->name('tabungan');
    Route::get('/peminjaman', PeminjamanUsers::class)->name('peminjaman');
    Route::get('/add-tabungan', AddTabungan::class)->name('add-tabungan');
});
