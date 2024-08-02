<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/',[UserController::class,'index'])->name('user');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'postRegister'])->name('postRegister');



Route::middleware('auth')->group(function () {

    Route::get('/show', [UserController::class, 'show'])->name('show');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');

    Route::get('change_password', [UserController::class, 'change_password'])->name('change_password');
    Route::post('change_password', [UserController::class, 'updatePassword'])->name('updatePassword');

});
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('list_user');
        Route::patch('/toggle_active/{user}', [AdminController::class, 'toggleActive'])->name('toggleActive');

});