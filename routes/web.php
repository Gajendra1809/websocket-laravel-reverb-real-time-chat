<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () { return view('welcome'); });

Route::get('/messages', [HomeController::class, 'messages'])->name('messages');

Route::post('/message', [HomeController::class, 'message'])->name('message');
