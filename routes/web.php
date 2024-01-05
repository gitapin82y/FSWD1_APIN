<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboard');
    });
    
    Route::get('/karyawan', function () {
        return view('pages.karyawan.index');
    });
    
    Route::get('/cuti', function () {
        return view('pages.cuti.index');
    });

    Route::get('/karyawan-pertama', function () {
        return view('pages.karyawan.pertama-gabung');
    });

    Route::get('karyawan/sisa-cuti', function () {
        return view('pages.karyawan.sisa-cuti');
    });
});
