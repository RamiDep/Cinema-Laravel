<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;

Route::get('/', function () {
    return view('auth.Login');
});

Route::resource('pelicula', PeliculaController::class)->middleware('auth');

Auth::routes(['reset'=>false,]);

Route::get('/home', [PeliculaController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
});