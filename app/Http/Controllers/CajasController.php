<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CajasImport;
use App\Imports\InventarioCajasImport;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class CajasController extends Controller
{

      
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



    function index()  {    
        $cajas = DB::table('cajas')->get();         
        return view('import_cajas')->with('cajas', $cajas);   
       }
}
