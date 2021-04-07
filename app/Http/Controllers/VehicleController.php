<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\VehiclesImport;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{    
 
    public function import(Request $request){


        
        (new VehiclesImport)->import($request->select_file);

        return redirect('/import_excel')->with('success', 'File imported successfully!');
    }

}
