<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () { return view('welcome'); });

Route::get('/messages/user/{rid}', [HomeController::class, 'messages'])->name('messages');

Route::post('/message', [HomeController::class, 'message'])->name('message');

Route::get('/users', [HomeController::class, 'users'])->name('users');

// use App\Events\GotMessage;

// Route::get('/test-broadcast', function () {
//     broadcast(new GotMessage([
//         'id' => 1,
//         'user' => 'Test User',
//         'content' => 'Test message'
//     ]));
//     return 'Broadcasted!';
// });
