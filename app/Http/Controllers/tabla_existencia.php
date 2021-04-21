<?php

namespace App\Http\Controllers;
use App\Imports\tabla_programacion;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class tabla_existencia extends Controller
{
    public function import(Request $request){
    Excel::import(new tabla_programacion,  $request->file('select_file'));

    $pedido_completo =  \DB::select('call mostrar_pedido');  

    return view('import_excel')->with('success', 'Importación realizada con éxito!')->with('pedido_completo', $pedido_completo);

   
    } 
}
