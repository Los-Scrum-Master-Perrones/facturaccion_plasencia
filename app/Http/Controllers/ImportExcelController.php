<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Imports\ArchivoProductosTerminados;

class ImportExcelController extends Controller
{
    function index()    {
     $data = DB::table('vitola_productos')->get();
     $pedido_completo =  \DB::select('call mostrar_pedido');    
     $verificar = \DB::select('call verificar_item_clase');
     return view('import_excel', compact('data'))->with('pedido_completo', $pedido_completo)->with('verificar', $verificar);
    }

    function index_lista_productos(){
        
        $listaproductos = \DB::select('call mostrar_lista_inventario');   
        $listaproductoseditar =   \DB::select('call mostrar_lista_productos_terminados');   

        $capas= \DB::select('call buscar_capa("")');
        $marcas=\DB::select('call buscar_marca("")');
        $nombres= \DB::select('call buscar_nombre("")');
        $vitolas= \DB::select('call buscar_vitola("")');
        $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
        $productos = DB::table('archivo_producto_terminados')->get();

        return view('lista_productos_terminados')->with('listaproductos', $listaproductos)->with('listaproductoseditar', $listaproductoseditar)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);

        
    }
    
    function editar_existencia_producto(Request $request){

       $procedimiento = \DB::select('call editar_existencia_producto(:a,:b)', [
            'a' => $request->id_productoE,
            'b' => $request->existencia_productoE,
            ]);
        
            $capas= \DB::select('call buscar_capa("")');
            $marcas=\DB::select('call buscar_marca("")');
            $nombres= \DB::select('call buscar_nombre("")');
            $vitolas= \DB::select('call buscar_vitola("")');
            $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
            $productos = DB::table('archivo_producto_terminados')->get();
        $listaproductos = \DB::select('call mostrar_lista_inventario');   
        $listaproductoseditar =   \DB::select('call mostrar_lista_productos_terminados');   
        return view('lista_productos_terminados')->with('listaproductos', $listaproductos)->with('listaproductoseditar', $listaproductoseditar)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);
    }



    

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::import($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'CustomerName'  => $row['customer_name'],
         'Gender'   => $row['gender'],
         'Address'   => $row['address'],
         'City'    => $row['city'],
         'PostalCode'  => $row['postal_code'],
         'Country'   => $row['country']
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('tbl_customer')->insert($insert_data);
      }
     }

   
     return back()->with('success', 'Excel Data Imported successfully.');
    }


    function importar_archivoproductos_terminados(Request $request)
    {
        (new ArchivoProductosTerminados)->import($request->select_file);

        $productos = DB::table('archivo_producto_terminados')->get();
        $capas= \DB::select('call buscar_capa("")');
        $marcas=\DB::select('call buscar_marca("")');
        $nombres= \DB::select('call buscar_nombre("")');
        $vitolas= \DB::select('call buscar_vitola("")');
        $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
        $productos = DB::table('archivo_producto_terminados')->get();
        return view('importar_producto_terminado_mes')->with('productos', $productos)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);

    }

    function importar_productos_terminado(){
        $productos = DB::table('archivo_producto_terminados')->get();
        $marcas=\DB::select('call buscar_marca("")');
        $nombres= \DB::select('call buscar_nombre("")');
        $vitolas= \DB::select('call buscar_vitola("")');
        $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
        $productos = DB::table('archivo_producto_terminados')->get();
        return view('importar_producto_terminado_mes')->with('productos', $productos)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);

       }

       function reemplazar_productos_terminado(){

     
        $borrarinventario_producto_terminados = DB::table('inventario_productos_terminados')->delete();
      
        $productosA = DB::table('archivo_producto_terminados')->get();
       foreach($productosA as $producto){
           $pa_lote = $producto->Lote;
           $pa_marca = $producto->Marca;  
           $pa_nombre = $producto->Alias_vitola;
           $pa_vitola = $producto->Vitola;  
           $pa_capa = $producto->Nombre_capa;
           $pa_existencia = $producto->Existencia_total;
           
           $procedimiento = \DB::select('call insertar_productos_terminados(:a,:b,:c,:d,:e,:f)', [
               'a' => $pa_lote,
               'b' => $pa_marca,
               'c' => $pa_nombre,
               'd' => $pa_vitola,
               'e' => $pa_capa,
               'f' => $pa_existencia
               ]);
       }
       $borrararchivo_producto_terminados = DB::table('archivo_producto_terminados')->delete();

          $productos = DB::table('archivo_producto_terminados')->get();

          $capas= \DB::select('call buscar_capa("")');
          $marcas=\DB::select('call buscar_marca("")');
          $nombres= \DB::select('call buscar_nombre("")');
          $vitolas= \DB::select('call buscar_vitola("")');
          $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
  
        return view('importar_producto_terminado_mes')->with('productos', $productos)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);


     }

     function nuevo_pro_terminado(Request $request){

        $capas= \DB::select('call buscar_capa("")');
        $marcas=\DB::select('call buscar_marca("")');
        $nombres= \DB::select('call buscar_nombre("")');
        $vitolas= \DB::select('call buscar_vitola("")');
        $tipo_empaques= \DB::select('call buscar_tipo_empaque("")');
        $productos = DB::table('archivo_producto_terminados')->get();

        $insertar_pro_terminado = DB::select('call insertar_pro_terminado(:lote,:marca,:nombre,:vitola,:capa,:existencia)',[
            'lote'=>$request->lote,
            'marca'=>$request->marca,
            'nombre'=>$request->nombre,
            'vitola'=>$request->vitola,
            'capa'=>$request->capa,
            'existencia'=>$request->existencia
        ]);

      

        return view('lista_productos_terminados')->with('productos', $productos)->with('capas', $capas)->with('marcas', $marcas)->with('nombres', $nombres)
        ->with('vitolas', $vitolas)->with('tipo_empaques', $tipo_empaques);

     }

     

 
}