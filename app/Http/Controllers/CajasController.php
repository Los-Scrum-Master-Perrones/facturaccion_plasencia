<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CajasImport;
use App\Exports\CajasExport;
use App\Imports\InventarioCajasImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CajasController extends Controller
{
    function index_codigobarra(){
        $cajas = DB::table('cajas')->get();
        return view('codigobarra')->with('cajas', $cajas);
    }

    function index_importar(){

        $cajas = DB::table('cajas')->where('oculto', 'N')->get();
        return view('import_cajas')->with('cajas', $cajas);
    }

    function index_lista(){
        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->get();
        $mostrar_lista_cajas = DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }

    function buscar_lista_cajas(Request $request){

        if ($request->nombre == null) {
            $nombre = "";
        } else {
            $nombre = $request->nombre;
        }

        $mostrar_lista_cajas = DB::select('call mostrar_lista_cajas');
        $listacajas = DB::select(
            'call buscar_lista_cajas(:nombre)',
            ['nombre' => $nombre]
        );

        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas)
        ->with('busca', $nombre);
    }

    function exportCajas()
    {
        return Excel::download(new CajasExport(), 'InventarioCajas.xlsx');
    }




    function agregar_lista_caja(Request $request)
    {
        $caja = DB::select(
            'call agregar_lista_caja(:a,:b,:c,:d)',
            [
                'a' => $request->codigo,
                'b' => $request->producto,
                'c' => $request->marca,
                'd' => $request->existencia
            ]
        );

        $listacajas = DB::table('lista_cajas')->orderBy('existencia', 'desc')->paginate('50');
        $mostrar_lista_cajas = DB::select('call mostrar_lista_cajas');
        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas);
    }



    function editar_existencia(Request $request){

        DB::select(
            'call editar_existencia(:a,:b)',
            [
                'a' => $request->id_cajaE,
                'b' => $request->existencia_cajaE
            ]
        );

        if ($request->busca == null) {
            $nombre = "";
        } else {
            $nombre = $request->busca;
        }

        $mostrar_lista_cajas = DB::select('call mostrar_lista_cajas');
        $listacajas = DB::select(
            'call buscar_lista_cajas(:nombre)',
            ['nombre' => $nombre]
        );

        return view('lista_cajas')->with('listacajas', $listacajas)->with('mostrar_lista_cajas', $mostrar_lista_cajas)
        ->with('busca', $nombre);
    }


    function import(Request $request){
        Excel::import(new CajasImport, $request->file('select_file')->store('temp'));
        return redirect()->route('index_importar_cajas');
    }






    function vaciar_import_tabla(){
        DB::table('cajas')->where('oculto', 'N')->delete();
        return redirect()->route('index_importar_cajas');
    }





    function anadir_inventario(Request $request){

        $cajasinsertar = DB::table('cajas')->where('oculto', 'N')->get();

        foreach($cajasinsertar as $caja){
            $pa_codigo = $caja->codigo;
            $pa_cantidad = $caja->cantidad;

            $no_existe = DB::select('select * from lista_cajas where codigo = ?', [$pa_codigo]);

            if(!isset($no_existe[0])){
                DB::insert("INSERT INTO `lista_cajas` (`codigo`, `productoServicio`, `marca`, `tipo_empaque`, `existencia`)
                VALUES (?, ?, ?, ?, ?);", [$caja->codigo, $caja->descripcion,'',0,0]);
            }

            DB::select('call anadir_cajas_a_inventario(:pa_codigo, :pa_cantidad,:pa_remision)', [
                'pa_codigo' => $pa_codigo,
                'pa_cantidad' => $pa_cantidad,
                'pa_remision' => $request->input('remision')
                ]);

            DB::update('update cajas set oculto = "S" where id_cajas = ?', [$caja->id_cajas]);
            DB::update('update cajas set remision = ? where id_cajas = ?', [$request->input('remision'),$caja->id_cajas]);


        }

        return redirect()->route('inventario_cajas');
    }





//solo se hizo una vez, para ingresar el inventario general
    function importinvcajas(Request $request)
    {
        (new InventarioCajasImport)->import($request->select_file);
        $cajas = DB::table('cajas')->get();
        return view('import_cajas')->with('cajas', $cajas);
    }
}
