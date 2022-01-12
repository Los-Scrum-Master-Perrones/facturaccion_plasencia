<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class programacion extends Controller
{
    function index()
    {

        
    return view('programacion');
    }


    function imprimir_programa(Request $request)
    {

        $vista = view('imprimir_programacion',['fecha'=>$request->fecha])
    ->with('depros', $request->depros);

    $pdf = \PDF::loadView( $vista);
    return $pdf->stream('documentname.pdf');
    }
    
}
