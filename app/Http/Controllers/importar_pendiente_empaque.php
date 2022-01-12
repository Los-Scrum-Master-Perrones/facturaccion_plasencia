<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use App\Imports\Actualizar_Cajitas;
use Maatwebsite\Excel\Facades\Excel;


class importar_pendiente_empaque extends Controller
{
  

    public function import_pendiente(Request $request)
    {

      (new Actualizar_Cajitas)->import($request->select_file);
        return view('import_excel');
      }
}
