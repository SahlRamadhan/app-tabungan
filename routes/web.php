<?php

use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Users\Auth\Login;
use App\Livewire\Users\Auth\Register;
use App\Livewire\Users\Home\Home;
use Illuminate\Support\Facades\Route;

route::get('/', Home::class)->name('home');
route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
route::get('/login', Login::class)->name('login');
route::get('/register', Register::class)->name('register');