<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pet/{petId}', [PetController::class, 'show']);
Route::post('/pet', [PetController::class, 'add']);
Route::put('/pet/{petId}/edit', [PetController::class, 'edit']);
Route::post('/pet/{petId}/update', [PetController::class, 'update']);
Route::delete('/pet/{petId}', [PetController::class, 'delete']);
Route::post('/pet/{petId}/uploadImage', [PetController::class, 'uploadImage'])->name('uploadImage');
Route::get('/pet/find/by/status', [PetController::class, 'findByStatus'])->name('findByStatus');

Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
Route::get('/pets/{pet}', [PetController::class, 'spec'])->name('pets.spec');
Route::get('/pets/{pet}/edit', [PetController::class, 'editView'])->name('pets.edit');
Route::get('/pets/{pet}/update', [PetController::class, 'updateView'])->name('pets.update');
Route::get('/pets/{pet}/upload', [PetController::class, 'upload'])->name('pets.upload');
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/find/by/status', [PetController::class, 'showFindByStatusForm'])->name('pets.findByStatusForm');
