<?php

use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreedsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpeciesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Cadastro de users
Route::post('register', RegisterController::class);
Route::get('register', [RegisterController::class, 'index']);

//Login de users
Route::post('login', [AuthController::class, 'login']);

//Cadastro de species
Route::get('/species', [SpeciesController::class, 'index']);
Route::post('/species', [SpeciesController::class, 'store']);
//Upload de imagens aqui
Route::post('/files', [FileController::class, 'upload']);
Route::get('/files/{file}', [FileController::class, 'download']);
Route::get('/files', [FileController::class, 'index']);


//Cadastro de breeds
Route::get('/breeds', [BreedsController::class, 'index']);
Route::post('/breeds', [BreedsController::class, 'store']);

//Cadastro de animals
Route::get('/animals', [AnimalsController::class, 'index']);
Route::post('/animals', [AnimalsController::class, 'store']);
