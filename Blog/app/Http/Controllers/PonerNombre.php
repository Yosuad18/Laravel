<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PonerNombre extends Controller
{
    public function Nombre()
    {
        return "Hola, Yosuad";
    }
    public function Apellido($apellido)
    {
        return "Con que tu apellido es $apellido!";
    }
    public function Genero($genero)
    {
        return "Tu genero es: $genero!";
    }
}
