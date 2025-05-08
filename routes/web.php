<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::redirect('/', '/login');

// Route::get('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/', [NewsController::class, 'index']);
Route::get('/load-news/{kategori}', [NewsController::class, 'loadMoreNews']);
Route::get('/detail', [NewsController::class, 'show'])->name('detail');
