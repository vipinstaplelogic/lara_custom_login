<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('login-new',[App\Http\Controllers\LoginController::class,'login'])->name('custom-login');

Route::group(['middleware' => ['web', 'custom_auth']], function () {
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class,'index'])->name('profile.index');
});