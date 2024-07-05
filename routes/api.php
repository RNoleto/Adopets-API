<?php

use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreedsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\AnimalsImagesController;
use App\Http\Controllers\MedicinesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Cadastro de users
Route::post('register', RegisterController::class);
Route::get('register', [RegisterController::class, 'index']);

//Login de users
Route::post('login', [AuthController::class, 'login']);

//Rotas para usuarios
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users/{id}/animals', [UserController::class, 'animals']);

//Cadastro de species
Route::get('/species', [SpeciesController::class, 'index']);
Route::post('/species', [SpeciesController::class, 'store']);
//Upload de imagens aqui
Route::post('/files', [FileController::class, 'upload']);
Route::get('/files/{file}', [FileController::class, 'download']);
Route::get('/files', [FileController::class, 'index']);


//Cadastro de breeds
Route::get('/breeds', [BreedsController::class, 'index']);
Route::get('/breeds/{id}', [BreedsController::class, 'show']);
Route::post('/breeds', [BreedsController::class, 'store']);

//Cadastro de animals
Route::get('/animals', [AnimalsController::class, 'index']);
Route::get('/animals/{id}', [AnimalsController::class, 'show']);
Route::post('/animals', [AnimalsController::class, 'store']);
Route::post('/animalsimage', [AnimalsImagesController::class, 'upload']);
Route::get('/animalsimage/{file}', [AnimalsImagesController::class, 'download']);
Route::get('/animalsimage', [AnimalsImagesController::class, 'index']);


//Vacinas
Route::post('/vaccines', [VaccinesController::class, 'store']); // Cadastrar Vacina
Route::get('/vaccines/{id}', [VaccinesController::class, 'show']); // Mostrar lista de todas as vacinas do banco
Route::get('/vaccines/pet/{petId}', [VaccinesController::class, 'getByPetId']); // Retornar vacina para um respectivo pet
Route::get('/vaccines', [VaccinesController::class, 'index']); // Mostrar todas as vacinas
Route::put('/vaccines/{id}', [VaccinesController::class, 'update']); // Atualizar uma determinada vacina
Route::delete('/vaccines/{id}', [VaccinesController::class, 'destroy']); // Apagar uma vacina (deleted_at)


//Medicamentos
Route::post('/medicines', [MedicinesController::class, 'store']); 
Route::get('/medicines/{id}', [MedicinesController::class, 'show']);
Route::get('/medicines/pet/{petId}', [MedicinesController::class, 'getByPetId']);
Route::get('/medicines', [MedicinesController::class, 'index']);
Route::put('/medicines/{id}', [MedicinesController::class, 'update']);
Route::delete('/medicines/{id}', [MedicinesController::class, 'destroy']);