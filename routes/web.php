<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
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
    if(!Auth::check()){
        return view('auth.login');
    }else{
        if (\Illuminate\Support\Facades\Auth::user()->is_admin == 1) {
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('home');
        }
    }
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('admin/', [AdminPanelController::class, 'index'])->name('admin.home')->middleware('is_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
