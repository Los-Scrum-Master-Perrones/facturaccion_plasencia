<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\capaImport;

use App\Imports\nombreImport;
use App\Imports\vitolaImport;
use App\Imports\marcaImport;
use App\Imports\ordenImport;
use App\Imports\celloImport;
use App\Imports\tipo_empaqueImport;
use App\Imports\clase_productoImport;
use Maatwebsite\Excel\Facades\Excel;

class CapaProductoController extends Controller
{
    public function import(Request $request){
       
           // Excel::import(new capaImport,  $request->file('select_file'));
           //  Excel::import(new vitolaImport,  $request->file('select_file') );
           //Excel::import(new marcaImport,  $request->file('select_file'));
           //Excel::import(new ordenImport,  $request->file('select_file'));
           //Excel::import(new nombreImport,  $request->file('select_file'));
           //Excel::import(new CelloImport,  $request->file('select_file'));
           // Excel::import(new tipo_empaqueImport,  $request->file('select_file'));
            Excel::import(new clase_productoImport,  $request->file('select_file'));

        return view('import_excel')->with('success', 'File imported successfully!');
    }
}





