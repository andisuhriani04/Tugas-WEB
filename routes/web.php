<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ScrumptiousController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])
    ->name('register')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');
Route::post('/register', [AuthController::class, 'store'])
    ->name('verified');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/', [ScrumptiousController::class, 'index'])->name('home');

Route::resource('/admin', MenuController::class)->parameters([
    'admin' => 'menu',
])->middleware('auth');
