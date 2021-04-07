<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Imports\capaImport;

use App\Imports\nombreImport;
use App\Imports\vitolaImport;
use App\Imports\marcaImport;
use App\Imports\ordenImport;

use Maatwebsite\Excel\Facades\Excel;

class CapaProductoController extends Controller
{
    public function import(Request $request){
        $file = $request->select_file;
        
        (new capaImport)->import($file);
        (new vitolaImport)->import($file);
        (new marcaImport)->import($file);
        (new ordenImport)->import($file);
        (new nombreImport)->import($file);


        return redirect('/importar_pedido')->with('success', 'File imported successfully!');
    }
}
