<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CajasImport;
use App\Imports\InventarioCajasImport;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class CajasController extends Controller
{

    function index_importar()  {    
    $cajas = DB::table('cajas')->get();         
    return view('import_cajas')->with('cajas', $cajas);   
    }

    function index_inventario()  {     
    return view('inventario_cajas');  
    }

    function index_lista()  {    
        
    $listacajas = DB::table('lista_cajas')->get();         
    return view('lista_cajas')->with('listacajas', $listacajas);     
    }
var $nombre;
    function buscar_lista_cajas(Request $request)  {   
if($request->nombre== null){
   $nombre = "";
}else{
    $nombre = $request->nombre;
}

        $listacajas = \DB::select('call buscar_lista_cajas(:nombre)',
[ 'nombre' => $nombre]);        
              
        return view('lista_cajas')->with('listacajas', $listacajas);     
        }








      
    function import(Request $request)  {    

(new CajasImport)->import($request->select_file);

  $cajas = DB::table('cajas')->get();         
        return view('import_cajas')->with('cajas', $cajas);   

    }

    function importinvcajas(Request $request)  {   
    (new InventarioCajasImport)->import($request->select_file);        
        $cajas = DB::table('cajas')->get();         
            return view('import_cajas')->with('cajas', $cajas);          
        }



   
}
