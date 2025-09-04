<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Users\Auth\Login;
use App\Livewire\Users\Auth\Register;
use App\Livewire\Users\Dashboard\Dashboard as DashboardDashboard;
use App\Livewire\Users\Home\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get(
    '/logout',
    function () {
        Auth::logout();
        return redirect()->route('login');
    }
)->name('logout');



// route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
// route::get('/dashboard', DashboardDashboard::class)->name('dashboard');

//middleware
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
});
Route::middleware(['auth', IsUser::class])->group(function () {
    Route::get('/dashboard', DashboardDashboard::class)->name('dashboard');
});
