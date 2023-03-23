<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClubController::class, 'index'])->name('index');
Route::post('/', [ClubController::class, 'addClub']);

Route::get('/tambah-skor', [ScoreController::class, 'index'])->name('score');
Route::post('/tambah-skor', [ScoreController::class, 'addScore'])->name('score.add');

Route::get('/tambah-multi-skor', [ScoreController::class, 'multipleScore'])->name('multiscore');
Route::post('/tambah-multi-skor', [ScoreController::class, 'addMultipleScore'])->name('multiscore.add');


Route::get('/klasemen', [ScoreController::class, 'pointKlasemen']);





