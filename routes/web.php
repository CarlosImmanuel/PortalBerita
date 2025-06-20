<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

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

Route::get('/auth-google-redirect', [RegisterController::class, 'google_redirect']);
Route::get('/auth-google-callback', [RegisterController::class, 'google_callback']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/load-news/{kategori}', [NewsController::class, 'loadMoreNews']);


Route::get('/detail/{id}', [BeritaController::class, 'detail'])->name('detail');

// Route::get('/berita/{id}', [BeritaController::class, 'detail'])->name('berita.detail');

Route::middleware(['auth'])->group(function () {
    Route::post('/komentar', [KomentarController::class, 'store'])->name('comment.store');
    Route::put('/komentar/{id}', [KomentarController::class, 'update'])->name('comment.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('comment.destroy');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::resource('comments', CommentController::class);

    Route::patch('/users/{id}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::patch('/users/{id}/unban', [UserController::class, 'unban'])->name('users.unban');
});



// Forgot password
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
