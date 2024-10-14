<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MoviesController;

Route::get('/',[MoviesController::class,'index'] )->name('movies.index');
Route::get('/movies/{id}',[MoviesController::class,'show'] )->name('movies.show');
Route::get('/search', [MoviesController::class, 'search'])->name('movies.search');
Route::post('/movies/rate/{id}', [MoviesController::class, 'rate'])->name('movies.rate');
// Route::get('/genre', [MoviesController::class, 'genre'])->name('genre.search');
// Login----------------------------------------------------------------------------------
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('register',[AuthController::class,'store'])->name('auth.register');
Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('login.action');
Route::get('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// Admin--------------------------------------------------------------------------------------
Route::get('create',[MoviesController::class,'create'])->name('movies.create');
Route::post('store',[MoviesController::class,'store'])->name('movies.store');
Route::delete('delete/{id}',[MoviesController::class,'destroy'])->name('movies.delete');
Route::get('edit/{id}',[MoviesController::class,'edit'])->name('movies.edit');
Route::put('update/{id}',[MoviesController::class,'update'])->name('movies.update');
// Actor-------------- ---------------------------------------------------------------------------
// Route::get('/actors/{pkey}', [ActorController::class, 'getActors']);