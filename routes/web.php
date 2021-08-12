<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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

Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::post('add_user', [AdminController::class, 'addUser'])->name('addUser');

Route::get('/{code}', [HomeController::class, 'index'])->name('home')->middleware('invited');
Route::post('submit', [HomeController::class, 'submit'])->name('submit');
