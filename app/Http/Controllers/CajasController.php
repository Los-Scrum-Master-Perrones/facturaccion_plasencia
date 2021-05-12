<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CajasImport;
use App\Imports\InventarioCajasImport;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class CajasController extends Controller
{

    function index_importar(){
        $cajas = DB::table('cajas')->get();
        return view('import_cajas')->with('cajas', $cajas);
    }
    


    function index_lista(){
        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->paginate('50');
        $mostrar_lista_cajas = \DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }


    

    function buscar_lista_cajas(Request $request){

        if ($request->nombre == null) {
            $nombre = "";
        } else {
            $nombre = $request->nombre;
        }

        $listacajas = \DB::select(
            'call buscar_lista_cajas(:nombre)',
            ['nombre' => $nombre]
        );

        return view('lista_cajas')->with('listacajas', $listacajas);
    }




    function agregar_lista_caja(Request $request)
    {
        $caja = \DB::select(
            'call agregar_lista_caja(:a,:b,:c,:d)',
            [
                'a' => $request->codigo,
                'b' => $request->producto,
                'c' => $request->marca,
                'd' => $request->existencia
            ]
        );

        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->paginate('50');
        $mostrar_lista_cajas = \DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }

    

    function editar_existencia(Request $request){
        $editar_existenciaP = \DB::select(
            'call editar_existencia(:a,:b)',
            [
                'a' => $request->id_cajaE,
                'b' => $request->existencia_cajaE
            ]
        );

        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->paginate('50');
        $mostrar_lista_cajas = \DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }


    function import(Request $request){
        (new CajasImport)->import($request->select_file);
        $cajas = DB::table('cajas')->get();
        return view('import_cajas')->with('cajas', $cajas);
    }






    function anadir_inventario(Request $request){   

        $cajasinsertar = DB::table('cajas')->get();
        foreach($cajasinsertar as $caja){
            $pa_codigo = $caja->codigo;
            $pa_cantidad = $caja->cantidad;   
            
            $procedimiento = \DB::select('call anadir_cajas_a_inventario(:pa_codigo, :pa_cantidad)', [
                'pa_codigo' => $pa_codigo,
                'pa_cantidad' => $pa_cantidad
                ]);
        }     

        $cajasborrar = DB::table('cajas')->delete();

        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->paginate('50');
        $mostrar_lista_cajas = \DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }











//solo se hizo una vez, para ingresar el inventario general
    function importinvcajas(Request $request)
    {
        (new InventarioCajasImport)->import($request->select_file);
        $cajas = DB::table('cajas')->get();
        return view('import_cajas')->with('cajas', $cajas);
    }
}
