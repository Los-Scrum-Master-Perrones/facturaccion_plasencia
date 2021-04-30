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

    function index_bodega()  {     
    return view('bodega');  
    }

    function index_lista()  {    
        
    $listacajas = DB::table('lista_cajas')->get();         
    return view('lista_cajas')->with('listacajas', $listacajas);     
    }

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



        function editaryeliminarlista(Request $request)  { 
            if($request->ajax())
    	{
    		if($request->action == 'edit')
    		{
    			$data = array(
    				'codigo'	=>	$request->codigo,
    				'productoServicio'		=>	$request->productoServicio,
    				'marca'		=>	$request->marca
    			);
    			DB::table('lista_cajas')
    				->where('id', $request->id)
    				->update($data);
    		}

    		if($request->action == 'delete')
    		{
    			DB::table('lista_cajas')
    				->where('id', $request->id)
    				->delete();
    		}
			
    		return response()->json($request);
    	}
    }
        
        

        function agregar_lista_caja(Request $request)  {      
            $caja = \DB::select('call agregar_lista_caja(:a,:b,:c)',
            [ 'a' => $request->codigo,
            'b' =>$request->producto,
            'c' => $request->marca]);
            
            $listacajas = DB::table('lista_cajas')->get();         
    return view('lista_cajas')->with('listacajas', $listacajas);     
        }  

        


   


        function anadir_inventario(Request $request)  {      
             
            $listacajas = DB::table('lista_cajas')->get(); 

            $c = count($listacajas);

            for( $i=0;$i<$c;$i++ )
            {
                $nuevoinventario[]= [
                    'codigo'        => $codigo[$i],
                    'descripcion'          => $descripcion[$i],
                    'lote_origen'          => $lote_origen[$i],
                    'lote_destino'          => $lote_destino[$i],
                    'cantidad'          => $cantidad[$i],
                    'costo_u'          => $costo_u[$i],
                    'subtotal'          => $subtotal[$i],
                ];
            }

            HorariosNew::create($nuevoinventario);

                  
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
