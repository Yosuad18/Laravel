<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperacionesController extends Controller
{
    public function sumar($num1, $num2)
    {
        $resultado = $num1 + $num2;
        return "La suma de $num1 y $num2 es: $resultado";
    }

    public function EcuacionCuadratica($a, $b, $c)
    {
        $paso1 =($b**2) - (4*$a*$c);
        if ($paso1 < 0) {
            return "La ecuacion no tiene solucion reales, ya que el discriminante es negativo.";
        }
        $paso2 = sqrt($paso1);   

        $ecu1_total = (-$b + $paso2) / (2 * $a);
        $ecu2_total = (-$b - $paso2) / (2 * $a);

        return "La formula cuadratica es: -$b +- sqrt($b^2 - 4*$a*$c) / (2*$a)
        RESULTADOS: La solucion x1= $ecu1_total y la solucion x2= $ecu2_total";
    }
}
