<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CampoController;
use App\Http\Controllers\UsuarioController;


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


// Rota de Usuarios
Route::post('/usuario',[UsuarioController::class, 'create']);
Route::get('/usuario',[UsuarioController::class, 'store']);
Route::get('/usuario/{id}',[UsuarioController::class, 'storeById']);
Route::put('/usuario/{id}',[UsuarioController::class, 'update']);


// Rota de Campo
Route::post('/campo',[CampoController::class, 'create']);
Route::get('/campo',[CampoController::class, 'store']);
