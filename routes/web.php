<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CheckListController;
use App\Http\Controllers\Admin\VehicleController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'authenticate']);

//Route::get('register', [RegisterController::class, 'index'])->name('register');
//Route::post('register', [RegisterController::class, 'register']);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('users', 'App\Http\Controllers\Admin\UserController');

Route::get('profile', 'App\Http\Controllers\Admin\ProfileController@index')->name('profile');
Route::put('profilesave', 'App\Http\Controllers\Admin\ProfileController@save')->name('profile.save');

Route::get('checklist', [CheckListController::class, 'index'])->name('checklist');

Route::resource('vehicle', 'App\Http\Controllers\Admin\VehicleController');