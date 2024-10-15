<?php

use App\Livewire\Login;
use App\Livewire\PostCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');

Route::get('/posts', PostCrud::class)
    ->middleware('auth')
    ->name('sua.rota.protegida');

