<?php
use App\Http\Controllers\OperacionesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/suma/{a}/{b}', [OperacionesController::class, 'sumar']);
Route::get('/ecuacion-cuadratica/{a}/{b}/{c}', [OperacionesController::class, 'EcuacionCuadratica']);
