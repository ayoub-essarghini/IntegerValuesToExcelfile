<?php

use App\Http\Controllers\FindCombinController;
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



Route::get('/',[FindCombinController::class,'index'])->name('index');

Route::post('/findcombo',[FindCombinController::class,'findCombin'])->name('find.combination');
Route::get('/export-file',[FindCombinController::class,'export'])->name('file.export');
Route::get('/delete-file/{id}',[FindCombinController::class,'delete'])->name('delete.file');
