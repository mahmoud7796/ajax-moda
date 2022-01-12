<?php

use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',[RegisterController::class,'index']);
Route::post('/register-create',[RegisterController::class,'store'])->name('register.create');
Route::get('/register-edit/{id}',[RegisterController::class,'edit'])->name('register.edit');
Route::post('/register-update/{id}',[RegisterController::class,'update'])->name('register.update');
