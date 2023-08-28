<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/alunos', [AlunoController::class, 'insertAluno']);
Route::get('/alunos', [AlunoController::class, 'getAluno']);
Route::get('/alunos/{id}',[AlunoController::class, 'getAlunoById']);
Route::delete('/alunos/{id}',[AlunoController::class, 'deleteAluno']);
Route::put('/alunos/{id}',[AlunoController::class, 'updateAluno']);

