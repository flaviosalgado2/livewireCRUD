<?php

use App\Livewire\PostCrud;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', PostCrud::class);
