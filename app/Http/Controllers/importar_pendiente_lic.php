<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




use Illuminate\Support\Facades\DB;
use App\Imports\PendienteImport;
use Maatwebsite\Excel\Facades\Excel;


class importar_pendiente_lic extends Controller
{

   
    public function import_pendiente(Request $request)
    {
       
        (new PendienteImport)->import($request->select_file);
        return view('import_excel');
    }
}
