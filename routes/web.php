<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KomentarController;

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

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::redirect('/', '/news');

Route::get('/register', [RegisterController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/load-news/{kategori}', [NewsController::class, 'loadMoreNews']);


Route::get('/detail/{id}', [BeritaController::class, 'detail'])->name('detail');

// Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');

Route::post('/komentar', [KomentarController::class, 'store'])->name('comment.store');
Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('comment.update');
Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('comment.destroy');

