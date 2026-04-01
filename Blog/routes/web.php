<?php
use App\Http\Controllers\OperacionesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PonerNombre;

Route::get('/', function () {
    return view('welcome to the home page');
});

Route::get('/suma/{a}/{b}', [OperacionesController::class, 'sumar']);
Route::get('/ecuacion-cuadratica/{a}/{b}/{c}', [OperacionesController::class, 'EcuacionCuadratica']);
Route::get('/nombre',[PonerNombre::class, 'Nombre']); 
Route::get('/home',[PonerNombre::class]); 
