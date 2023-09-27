<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;

use App\Exports\FacturaExport;
use App\Exports\FacturaExportView;
use App\Exports\FacturaExportViewFamily;
use App\Models\CatalogoHistorialPrecio;
use App\Models\CatalogoItemsPrecio;
use App\Models\CatalogoMarcasPrecio;
use App\Models\clase_producto;
use App\Models\detalle_clase_producto;
use App\Models\pendiente;
use Maatwebsite\Excel\Facades\Excel;

class FacturaTerminado extends Component
{

    public $actual_ventan = true;

    public $titulo_factura;
    public $mes;
    public $titulo_mes;
    public $titulo_cliente;
    public $num_factura_sistema;
    public $cliente;
    public $numero_factura;
    public $contenedor;
    public $total_cantidad_bultos;
    public $total_total_puros;
    public $total_peso_bruto;
    public $total_peso_neto;
    public $total_valor;
    public $total_factura_precio;
    public $fecha_factura;
    public $detalles_venta;
    public $totaltotales;
    public $totalcosto;
    public $datos_pendiente;
    public $tipo_factura;
    public $id_pendiente;

    public $descripcion_producto;
    public $cantidad_bultos;
    public $unidades_bultos;
    public $unidades_cajon;
    public $peso_bruto;
    public $peso_neto;

    public $editar_descripcion_producto;
    public $editar_cantidad_bultos;
    public $editar_unidades_bultos;
    public $editar_unidades_cajon;
    public $editar_peso_bruto;
    public $editar_peso_neto;
    public $id_pendiente_detalle;

    public $nom;
    public $fede;
    public $fecha;

    public $item;
    public $orden;
    public $hon;

    public $id_eliminar;
    public $id_editar;


    public $detalles_produtos;
    public $aereo;
    public $formatos_impresiones = '4';

    //TODO Busqueda pendiente factura
    public $items;
    public $orden_sistemas;
    public $orden_pedidos;
    public $marcas_busqueda;
    public $busqueda_vitolas;
    public $busqueda_nombre;
    public $busqueda_capas;
    public $busqueda_tipo_empaques;
    public $busqueda_meses;
    //TODO Busqueda pendiente factura


    public $insertar_unidades_cajon;
    public $insertar_peso_bruto;
    public $insertar_peso_neto;
    public $insertar_cantidad_bultos;
    public $insertar_unidades_bultos;
    public $insertar_para;



    /* procedimientos almacanedos busquedas pendiente*/
    public $marcas_p = [];
    public $nombre_p = [];
    public $vitolas_p = [];
    public $capas_p = [];
    public $empaques_p = [];
    public $mes_p = [];
    public $items_p = [];
    public $ordenes_p = [];
    public $hons_p = [];
    public $series_p = [];
    public $precios = [];
    public $marcas_precio = [];

    public $busqueda_marcas_p;
    public $busqueda_nombre_p;
    public $busqueda_vitolas_p;
    public $busqueda_capas_p;
    public $busqueda_empaques_p;
    public $busqueda_mes_p;
    public $busqueda_items_p;
    public $busqueda_ordenes_p;
    public $busqueda_hons_p;
    public $todos;


    public $capas_nuevo;
    public $marcas_nuevo;
    public $nombres_nuevo;
    public $vitolas_nuevo;
    public $tipo_empaques_nuevo;
    public $presentacion;
    public $codigo_precio_nuevo;
    public $precio_precio;
    public $codigo_n = '';
    public $precio_n = '';
    public $marca_n = '';
    public $nombre_n = '';
    public $vitola_n = '';
    public $capa_n = '';
    public $empaque_n = '';
    public $id_pendiente_precio = 0;
    public $id_clase_producto = 0;

    public $tuplas_conteo;
    public $paginacion;

    public $codigo_item;

    // variables del wire  model para la busqueda
    public $r_uno = "1";
    public $r_dos = "2";
    public $r_tres = "3";
    public $r_cuatro = "4";
    public $r_cinco = "Puros Tripa Larga";
    public $r_seis = "Puros Tripa Corta";
    public $r_siete = "Puros Sandwich";
    public $r_mill = "Puros Brocha";

    public $ventanas = 1;

    public $items_b;
    public $ordens_b;
    public $t_empaque_b;
    public $codigo_b;

    public $items_f;
    public $ordens_f;
    public $t_empaque_f;
    public $codigo_f;

    public function cambio($num){
          $this->ventanas = $num;
    }

    public function cambio_formatos()  {

        switch ($this->aereo) {
            case 'RP':
                $this->formatos_impresiones = '4';
                break;
            case 'Aerea':
                $this->formatos_impresiones = '6';
                break;
            case 'FM':
                $this->formatos_impresiones = '3';
                break;
            case 'AereaFamily':
                $this->formatos_impresiones = '7';
                break;
            case 'WH':
                $this->formatos_impresiones = '1';
                break;
            default:
                $this->formatos_impresiones = '4';
                break;
        }
    }

    public function render()
    {
        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));


        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;

        $usosArray = [];
        $usosArray2 = [];
        $precio_catalogo = [];
        $this->tuplas_conteo =0;
        $this->datos_pendiente =[];
        $this->series_p = [];
        $this->detalles_venta = [];

        if($this->ventanas == 1){
            $precio1= DB::table('clase_productos')
            ->select('codigo_precio')->distinct()->get();

            $precio2=DB::table('detalle_clase_productos')
            ->select('otra_descripcion as codigo_precio')->distinct()->get();

            $this->series_p = $precio1->concat($precio2);



            $this->detalles_venta = DB::select('call mostrar_detalle_factura(?,?,?,?,?)',[
                $this->aereo, $this->items_b, $this->ordens_b, $this->codigo_b, $this->t_empaque_b
            ]);

            $this->num_factura_sistema = DB::select('call traer_num_factura()')[0]->factura_interna;


            $usos = DB::select('call mostrar_precios_factura()');


            $precio_catalogo = DB::select('call mostrar_precios_factura_catalogo()');


            foreach ($usos as $uso) {
                $usosArray[$uso->codigo.'-'.$uso->anio] =  $uso;
                $usosArray2[$uso->codigo.'-'.$uso->anio][] =  $uso;
            }
        }else{

            $pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
            :pa_items,:pa_orden_sist,:pa_ordenes,
            :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
            :pa_empaques,:pa_meses,:r_mill)',
                [
                    'uno' =>  $this->r_uno,
                    'dos' =>  $this->r_dos,
                    'tres' =>  $this->r_tres,
                    'cuatro' =>  $this->r_cuatro,
                    'pres' =>  $this->r_cinco,
                    'seis' =>  $this->r_seis,
                    'siete' =>  $this->r_siete,
                    'paginacion' =>  -1,
                    'pa_marcas' =>  $this->busqueda_marcas_p,
                    'pa_nombre' =>  $this->busqueda_nombre_p,
                    'pa_vitolas' =>  $this->busqueda_vitolas_p,
                    'pa_capas' =>  $this->busqueda_capas_p,
                    'pa_empaques' =>  $this->busqueda_empaques_p,
                    'pa_meses' =>  $this->busqueda_mes_p,
                    'pa_items' =>  $this->busqueda_items_p,
                    'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                    'pa_ordenes' =>  $this->busqueda_hons_p,
        'r_mill' =>  $this->r_mill
                ]
                );
            $this->tuplas_conteo = count($pendiente);

            if ($this->todos == 1) {
                $this->datos_pendiente = $pendiente;
            } else {
                $this->datos_pendiente = DB::select(
                    'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                    :pa_items,:pa_orden_sist,:pa_ordenes,
                    :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                    :pa_empaques,:pa_meses,:r_mill)',
                    [
                        'uno' =>  $this->r_uno,
                        'dos' =>  $this->r_dos,
                        'tres' =>  $this->r_tres,
                        'cuatro' =>  $this->r_cuatro,
                        'pres' =>  $this->r_cinco,
                        'seis' =>  $this->r_seis,
                        'siete' =>  $this->r_siete,
                        'paginacion' =>  $this->paginacion,
                        'pa_marcas' =>  $this->busqueda_marcas_p,
                        'pa_nombre' =>  $this->busqueda_nombre_p,
                        'pa_vitolas' =>  $this->busqueda_vitolas_p,
                        'pa_capas' =>  $this->busqueda_capas_p,
                        'pa_empaques' =>  $this->busqueda_empaques_p,
                        'pa_meses' =>  $this->busqueda_mes_p,
                        'pa_items' =>  $this->busqueda_items_p,
                        'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                        'pa_ordenes' =>  $this->busqueda_hons_p,
            'r_mill' =>  $this->r_mill
                    ]
                );
            }
        }






        return view('livewire.factura-terminado',
                    ['precio_sugerido' => $usosArray,
                     'precio_historial' => $usosArray2,
                     'precio_catalogo' => $precio_catalogo])->extends('principal')->section('content');
    }

    public function cambiar_vista()
    {
        $this->actual_ventan = !($this->actual_ventan);
    }



    public function editar_detalles($id)
    {
        $detalles_valores = DB::select('CALL `traer_detalles_editar_factura`(:id)', ['id' => $id]);
        $this->id_editar = $id;
        $this->editar_descripcion_producto =  $detalles_valores[0]->producto;
        $this->editar_cantidad_bultos =  $detalles_valores[0]->cantidad_puros;
        $this->editar_unidades_bultos =  $detalles_valores[0]->unidad;
        $this->editar_unidades_cajon =  $detalles_valores[0]->cantidad_por_caja;
        $this->editar_peso_bruto =  $detalles_valores[0]->total_bruto / $detalles_valores[0]->cantidad_puros;
        $this->editar_peso_neto =  $detalles_valores[0]->total_neto / $detalles_valores[0]->cantidad_puros;

        $this->dispatchBrowserEvent("editar_detalless");
    }

    public function borrar_detalles($id)
    {
        $this->id_eliminar = $id;
        $this->dispatchBrowserEvent("borrar");
    }

    public function borrar_detalles_datos($id)
    {
        DB::transaction(function () use ($id) {


            $sampler = DB::select('SELECT sampler,descripcion_sampler
        FROM clase_productos
        WHERE  clase_productos.item = (select item from pendiente where id_pendiente =
                                            (select id_pendiente from detalle_factura where id_detalle = ?)
                                        );', [$id]);

            if ($sampler[0]->sampler == "si") {

                $detalles_item = DB::select('select id_pendiente from detalle_factura  where id_detalle = ?', [$id]);

                $detalles = DB::select('select item, orden from pendiente where id_pendiente = ?', [$detalles_item[0]->id_pendiente]);

                $valores_extras = DB::select('select id_pendiente, (select id_detalle from detalle_factura where detalle_factura.id_pendiente = pendiente.id_pendiente) as id_detalle from pendiente where item = ? and orden = ?', [$detalles[0]->item, $detalles[0]->orden]);

                DB::delete('call eliminar_detalle_factura(:id)', ['id' => $id]);

                for ($i = 1; $i < count($valores_extras); $i++) {
                    DB::delete('call eliminar_detalle_factura(:id)', ['id' => $valores_extras[$i]->id_detalle]);
                }
            } else {
                DB::delete('call eliminar_detalle_factura(:id)', ['id' => $id]);
            }

            $this->dispatchBrowserEvent("cerrar_modal_borrar");
        });
    }

    public function cerrar_modal()
    {
        $this->dispatchBrowserEvent("cerrar");
    }

    public function mount()
    {

        $this->nom = "";
        $this->fede = "";
        $this->fecha = "";
        $this->item = "";
        $this->orden = "";
        $this->hon = "";

        $this->titulo_factura = "Factura";
        $this->num_factura_sistema = "FA-00-00000000";
        $this->tipo_factura = "HON";

        setlocale(LC_TIME, "spanish");

        $this->titulo_mes = strftime("%B", $this->mes);
        $this->titulo_cliente = "";

        $this->contenedor = "";
        $this->total_cantidad_bultos = 0;
        $this->total_total_puros = 0;
        $this->total_peso_bruto = 0;
        $this->total_peso_neto = 0;
        $this->total_valor = 0;


        $this->editar_descripcion_producto =  "";
        $this->editar_cantidad_bultos = 0;
        $this->editar_unidades_bultos =  0;
        $this->editar_unidades_cajon =  0;
        $this->editar_peso_bruto =  0;
        $this->editar_peso_neto =  0;

        $this->items = [];
        $this->orden_sistemas = [];
        $this->orden_pedidos = [];
        $this->marcas_busqueda = [];
        $this->busqueda_vitolas = [];
        $this->busqueda_capas = [];
        $this->busqueda_tipo_empaques = [];
        $this->busqueda_meses = [];


        $this->datos_pendiente = [];

        $this->paginacion = 0;
        $this->fecha = "";
        $this->busqueda_marcas_p = "";
        $this->busqueda_nombre_p = "";
        $this->busqueda_vitolas_p = "";
        $this->busqueda_capas_p = "";
        $this->busqueda_empaques_p = "";
        $this->busqueda_mes_p = "";
        $this->busqueda_items_p = "";
        $this->busqueda_ordenes_p = "";
        $this->busqueda_hons_p = "";


        $this->fecha_factura = Carbon::now()->format("Y-m-d");

        $this->aereo =  "RP";
        $this->items_b =  "";
        $this->ordens_b =  "";
        $this->t_empaque_b =  "";
        $this->codigo_b =  "";


        $this->codigo_n = CatalogoMarcasPrecio::orderBy('id', 'desc')->first()->codigo + 1000;
        $this->marcas_precio = CatalogoMarcasPrecio::all('marca');


        $datos = DB::select(
            'call buscar_pendiente_conteo(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses,:r_mill )',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro,
                'pres' =>  $this->r_cinco,
                'seis' =>  $this->r_seis,
                'siete' =>  $this->r_siete,
                'paginacion' =>  -1,
                'pa_marcas' =>  $this->busqueda_marcas_p,
                'pa_nombre' =>  $this->busqueda_nombre_p,
                'pa_vitolas' =>  $this->busqueda_vitolas_p,
                'pa_capas' =>  $this->busqueda_capas_p,
                'pa_empaques' =>  $this->busqueda_empaques_p,
                'pa_meses' =>  $this->busqueda_mes_p,
                'pa_items' =>  $this->busqueda_items_p,
                'pa_orden_sist' =>  $this->busqueda_ordenes_p,
                'pa_ordenes' =>  $this->busqueda_hons_p,
        'r_mill' =>  $this->r_mill

            ]
        );

        if (count($datos) > 0) {

            $this->items_p = [];
            $this->marcas_p = [];
            $this->nombre_p = [];
            $this->vitolas_p = [];
            $this->capas_p = [];
            $this->empaques_p = [];
            $this->mes_p = [];
            $this->items_p = [];
            $this->ordenes_p = [];
            $this->hons_p = [];
            $this->precios = [];

            foreach ($datos as $detalles) {
                array_push($this->items_p, $detalles->item);
                array_push($this->marcas_p, $detalles->marca);
                array_push($this->nombre_p, $detalles->nombre);
                array_push($this->vitolas_p, $detalles->vitola);
                array_push($this->capas_p, $detalles->capa);
                array_push($this->empaques_p, $detalles->tipo_empaque);
                array_push($this->mes_p, $detalles->mes);
                array_push($this->ordenes_p, $detalles->orden_del_sitema);
                array_push($this->hons_p, $detalles->orden);

            }

            $this->marcas_p = array_unique($this->marcas_p);
            $this->nombre_p = array_unique($this->nombre_p);
            $this->vitolas_p = array_unique($this->vitolas_p);
            $this->capas_p = array_unique($this->capas_p);
            $this->empaques_p = array_unique($this->empaques_p);
            $this->mes_p = array_unique($this->mes_p);
            $this->items_p = array_unique($this->items_p);
            $this->ordenes_p = array_unique($this->ordenes_p);
            $this->hons_p = array_unique($this->hons_p);
        }
    }

    public function paginacion_numerica($numero)
    {
        $this->paginacion = $numero;
    }

    public function mostrar_todo($todo)
    {
        $this->todos = $todo;
    }


    public function insertar_detalle_factura(
        $insertar_unidades_cajon,
        $insertar_peso_bruto,
        $insertar_peso_neto,
        $insertar_cantidad_bultos,
        $insertar_unidades_bultos
    ) {

        $sampler = DB::select('SELECT sampler,descripcion_sampler
                                FROM clase_productos
                                WHERE  clase_productos.item = (select item from pendiente where id_pendiente = ?);', [$this->id_pendiente_detalle]);


        $datos_pendiente = DB::select('SELECT item, orden, saldo,mes FROM pendiente WHERE id_pendiente = ?', [$this->id_pendiente_detalle]);

        $conteo = DB::select('SELECT * FROM pendiente WHERE orden = ? AND item = ? AND mes = ?', [$datos_pendiente[0]->orden,  $datos_pendiente[0]->item, $datos_pendiente[0]->mes]);

        if ($sampler[0]->sampler == "si") {

            for ($i = 0; $i < count($conteo); $i++) {
                DB::select('call insertar_detalle_factura(
                    :id_pendiente
                   ,:pa_cantidad_cajas
                   ,:pa_peso_bruto
                   ,:pa_peso_neto
                   ,:pa_cantidad_puros
                   ,:pa_unidad
                   ,:pa_observaciones,
                   :para,
                   :anterior)', [

                    "id_pendiente" => $conteo[$i]->id_pendiente, "pa_cantidad_cajas" => $insertar_unidades_cajon, "pa_peso_bruto" => $insertar_peso_bruto,
                    "pa_peso_neto" => $insertar_peso_neto, "pa_cantidad_puros" => $insertar_cantidad_bultos,
                    "pa_unidad" => $insertar_unidades_bultos, "pa_observaciones" => "Sin Facturar", "para" =>  $this->aereo, "anterior" => ($datos_pendiente[0]->saldo - ($insertar_unidades_bultos * $insertar_cantidad_bultos))
                ]);
            }
        } else {
            DB::select('call insertar_detalle_factura(
                :id_pendiente
               ,:pa_cantidad_cajas
               ,:pa_peso_bruto
               ,:pa_peso_neto
               ,:pa_cantidad_puros
               ,:pa_unidad
               ,:pa_observaciones,
               :para,
               :anterior)', [

                "id_pendiente" => $this->id_pendiente_detalle, "pa_cantidad_cajas" => $insertar_unidades_cajon, "pa_peso_bruto" => $insertar_peso_bruto, "pa_peso_neto" => $insertar_peso_neto, "pa_cantidad_puros" => $insertar_cantidad_bultos, "pa_unidad" => $insertar_unidades_bultos, "pa_observaciones" => "Sin Facturar",
                "para" =>  $this->aereo, "anterior" => ($datos_pendiente[0]->saldo - ($insertar_unidades_bultos * $insertar_cantidad_bultos))
            ]);
        }
        $this->ventanas = 1;
    }

    public function actualizar_detalle_factura()
    {
        DB::transaction(function () use ($request) {
            $sampler = DB::select('SELECT sampler,descripcion_sampler
                        FROM clase_productos
                        WHERE  clase_productos.item = (select item from pendiente where id_pendiente =
                                                            (select id_pendiente from detalle_factura where id_detalle = ?)
                                                        );', [$request->id_pendi]);




            $datos_pendiente = DB::select('SELECT item, orden, saldo, mes FROM pendiente WHERE id_pendiente =
                                        (select id_pendiente from detalle_factura where id_detalle = ?)', [$request->id_pendi]);


            if ($sampler[0]->sampler == "si") {

                $detalles_item = DB::select('select id_pendiente from detalle_factura  where id_detalle = ?', [$request->id_pendi]);

                $detalles = DB::select('select item, orden from pendiente where id_pendiente = ?', [$detalles_item[0]->id_pendiente]);


                DB::select('call actualizar_detalle_factura(
                :id_pendiente
                ,:pa_cantidad_cajas
                ,:pa_peso_bruto
                ,:pa_peso_neto
                ,:pa_cantidad_puros
                ,:pa_unidad)', [

                    "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto,
                    "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos,

                ]);

                $conteo = count(DB::select('select * from detalle_clase_productos where item = ?', [$detalles[0]->item]));

                $id_detalle_fa = $request->id_pendi + 1;

                for ($i = 1; $i < $conteo; $i++) {
                    DB::select('call actualizar_detalle_factura(
                    :id_pendiente
                    ,:pa_cantidad_cajas
                    ,:pa_peso_bruto
                    ,:pa_peso_neto
                    ,:pa_cantidad_puros
                    ,:pa_unidad
                    )', [

                        "id_pendiente" =>   $id_detalle_fa, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => 0,
                        "pa_peso_neto" => 0, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos,

                    ]);
                    $id_detalle_fa++;
                }
            } else {
                DB::select('call actualizar_detalle_factura(
                    :id_pendiente
                    ,:pa_cantidad_cajas
                    ,:pa_peso_bruto
                    ,:pa_peso_neto
                    ,:pa_cantidad_puros
                    ,:pa_unidad)', [

                    "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto, "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos
                ]);
            }
        });
        return redirect()->route('f_terminado');
    }

    public function imprimir_formatos()
    {
        $vista_html = ['1'=>['vista'=>'Exports.factura-terminado-exports-warehouse','encabezado'=>[0=>'A18:P18',1=>'A19:P19']],
                       '2'=>['vista'=>'Exports.factura-terminado-exports','encabezado'=>[0=>'A18:P18',1=>'A19:P19']],
                       '3'=>['vista'=>'Exports.factura-terminado-exports-family','encabezado'=>[0=>'A16:R16',1=>'A17:R17']],
                       '4'=>['vista'=>'Exports.factura-terminado-exports','encabezado'=>[0=>'A18:P18',1=>'A19:P19']],
                       '5'=>['vista'=>'Exports.factura-terminado-exports-simple','encabezado'=>[1=>'A18:P18',1=>'A19:P19']],
                       '6'=>['vista'=>'Exports.factura-terminado-exports-aerea','encabezado'=>[0=>'A18:R18',1=>'A19:R19']],
                       '7'=>['vista'=>'Exports.factura-terminado-exports-family-aerea','encabezado'=>[0=>'A18:R18',1=>'A19:R19']],
                       '8'=>['vista'=>'Exports.factura-terminado-exports-lion-leaf','encabezado'=>[0=>'A19:K19',1=>'A20:K20']],
                       '9'=>['vista'=>'Exports.factura-terminado-exports-bandido','encabezado'=>[0=>'A15:N15',1=>'A16:N16']],
                       '10'=>['vista'=>'Exports.factura-terminado-exports-coyote','encabezado'=>[0=>'A18:L18',1=>'A19:L19']],];

        $this->detalles_venta = DB::select('call mostrar_detalle_factura(?,?,?,?,?)',[
            $this->aereo, $this->items_b, $this->ordens_b, $this->codigo_b, $this->t_empaque_b
        ]);

        $vista =  view($vista_html[$this->formatos_impresiones]['vista'], [
            'detalles_venta' => $this->detalles_venta
        ]);

        return Excel::download(new FacturaExportView($vista,$vista_html[$this->formatos_impresiones]['encabezado']), 'FacturaDetallada.xlsx');
    }

    public function insertar_factura()
    {
        DB::transaction(function () {


            if ($this->cliente != null && $this->contenedor != null) {


                $detalles = DB::select('call mostrar_detalle_factura(?,?,?,?,?)',[
                    $this->aereo, $this->items_b, $this->ordens_b, $this->codigo_b, $this->t_empaque_b
                ]);


                for ($i = 0; $i < count($detalles); $i++) {

                    $sampler = DB::select('SELECT sampler FROM clase_productos where item = (SELECT item FROM pendiente WHERE id_pendiente = ? )', [$detalles[$i]->id_pendiente]);
                    $cantidad_sampler = DB::select('SELECT COUNT(*) as conteo FROM detalle_clase_productos where item = (SELECT item FROM pendiente WHERE id_pendiente = ? )', [$detalles[$i]->id_pendiente]);

                    $total_pendiete = $detalles[$i]->total_tabacos;

                    if ($sampler[0]->sampler == "si") {
                        if($detalles[$i]->codigo_item == '10499010'){
                            if($detalles[$i]->cod_prod == 'P-22419' || $detalles[$i]->cod_prod==''){
                                $total_pendiete  = (($detalles[$i]->total_tabacos) / 30) * 8;
                            }else{
                                $total_pendiete  = (($detalles[$i]->total_tabacos) / 30) * 7;
                            }

                        }else{
                        $total_pendiete  = ($detalles[$i]->total_tabacos) / $cantidad_sampler[0]->conteo;
                        }
                    }

                    DB::select('call `actualizar_pendiente_saldo_factura`(
                    :id_pendiente,
                    :pa_saldo)', [
                        "id_pendiente" => $detalles[$i]->id_pendiente,
                        "pa_saldo" =>  $total_pendiete
                    ]);

                    $pendiente_actual = DB::select('SELECT orden,mes,item FROM pendiente WHERE id_pendiente = ?', [$detalles[$i]->id_pendiente]);

                    $pendiente = DB::select('SELECT sum(saldo) AS total FROM pendiente WHERE orden = ? and mes = ? and item = ?', [
                        $pendiente_actual[0]->orden,
                        $pendiente_actual[0]->mes,
                        $pendiente_actual[0]->item
                    ]);

                    if (intval($pendiente[0]->total) > 0) {
                        if ($sampler[0]->sampler == "si") {
                            DB::update('UPDATE pendiente SET procesado = "N" WHERE orden = ? and mes = ? and item = ?', [
                                $pendiente_actual[0]->orden,
                                $pendiente_actual[0]->mes,
                                $pendiente_actual[0]->item
                            ]);
                        } else {
                            DB::update('UPDATE pendiente SET procesado = "N" WHERE id_pendiente = ?', [$detalles[$i]->id_pendiente]);
                        }
                    } else {
                        if ($sampler[0]->sampler == "si") {
                            DB::update('UPDATE pendiente SET procesado = "S" WHERE orden = ? and mes = ? and item = ?', [
                                $pendiente_actual[0]->orden,
                                $pendiente_actual[0]->mes,
                                $pendiente_actual[0]->item
                            ]);
                        } else {
                            DB::update('UPDATE pendiente SET procesado = "S" WHERE id_pendiente = ?', [$detalles[$i]->id_pendiente]);
                        }
                    }
                }

                DB::select('call `insertar_factura_terminado`(
                :orden_sufijo,
                :pa_cliente,
                :pa_numero_factura,
                :pa_contenedor,
                :pa_cantidad_bultos,
                :pa_total_puros,
                :pa_total_peso_bruto,
                :pa_total_peso_neto,
                :pa_fecha_factura,
                :pa_total_precio)', [

                    "orden_sufijo" =>  $this->aereo,
                    "pa_cliente" => $this->cliente,
                    "pa_numero_factura" => $this->num_factura_sistema,
                    "pa_contenedor" => $this->contenedor,
                    "pa_cantidad_bultos" => $this->total_cantidad_bultos,
                    "pa_total_puros" => $this->total_total_puros,
                    "pa_total_peso_bruto" => $this->total_peso_bruto,
                    "pa_total_peso_neto" => $this->total_peso_bruto,
                    "pa_fecha_factura" => $this->fecha_factura,
                    "pa_total_precio" => $this->total_factura_precio
                ]);

                $this->titulo_cliente = "";
                $this->titulo_factura = "";
            } else {
                $this->dispatchBrowserEvent("advertencia_mensaje");
            }
        });
    }

    public function historial()
    {
        return redirect()->route('historial_factura');
    }

    public function actualizar_precio_catalogo(clase_producto $clase,$precio,$sampler,$codigo)
    {
        if($sampler == 'si'){
            detalle_clase_producto::where('otra_descripcion','=', $codigo)->update(['precio' => $precio]);
            pendiente::where('serie_precio','=', $codigo)->where('saldo','>', 0)->update(['precio' => $precio]);
        }else{
            $clase->precio = $precio;
            $clase->save();
        }

    }

    public function incrementar_precio_catalogo(clase_producto $clase,$cantidad,$sampler,$codigo,$precio)
    {
        if($sampler == 'si'){
            detalle_clase_producto::where('otra_descripcion','=', $codigo)->update(['precio' => ($precio+$cantidad)]);
            pendiente::where('serie_precio','=', $codigo)->where('saldo','>', 0)->update(['precio' => ($precio+$cantidad)]);
        }else{

            $clase->precio += $cantidad;
            $clase->save();
        }
    }

    public function insertar_precio_catalogo(clase_producto $clase,pendiente $pendiente,$codigo,$precio)
    {
        if($clase->sampler == 'si'){
            detalle_clase_producto::where('item','=',  $pendiente->item)
                                  ->where('id_capa','=',  $pendiente->capa)
                                  ->where('id_vitola','=', $pendiente->vitola)
                                  ->where('id_nombre','=', $pendiente->nombre)
                                  ->where('id_marca','=', $pendiente->marca)
                                  ->where('id_tipo_empaque','=', $pendiente->tipo_empaque)
                                  ->update(['otra_descripcion' => $codigo,'precio' => $precio]);

            pendiente::where('codigo_productos','=', $pendiente->codigo_productos)
                     ->where('item','=', $pendiente->item)
                     ->where('saldo','>', 0)
                     ->update(['serie_precio' => $codigo, 'precio' => $precio]);
        }else{
            $pendiente->precio = $precio;
            $pendiente->serie_precio = $codigo;
            $pendiente->save();

            $clase->precio = $precio;
            $clase->codigo_precio = $codigo;
            $clase->save();
        }

        $this->dispatchBrowserEvent('cerrar_modal_precio');

    }

    public function eliminar_precio_catalogo(clase_producto $clase,pendiente $pendiente)
    {
        if($clase->sampler == 'si'){
            detalle_clase_producto::where('item','=',  $pendiente->item)
                                  ->where('id_capa','=',  $pendiente->capa)
                                  ->where('id_vitola','=', $pendiente->vitola)
                                  ->where('id_nombre','=', $pendiente->nombre)
                                  ->where('id_marca','=', $pendiente->marca)
                                  ->where('id_tipo_empaque','=', $pendiente->tipo_empaque)
                                  ->update(['otra_descripcion' => '','precio' => '0.0']);

            pendiente::where('codigo_productos','=', $pendiente->codigo_productos)
                     ->where('item','=', $pendiente->item)
                     ->where('saldo','>', 0)
                     ->update(['serie_precio' => '', 'precio' => '0.0']);
        }else{
            $pendiente->precio = '0.0';
            $pendiente->serie_precio = '';
            $pendiente->save();

            $clase->precio = 0.0;
            $clase->codigo_precio = '';
            $clase->save();
        }
    }

    public function actualizar_Datos_sampler()
    {

        $datos_sampler_pendiente = DB::select('SELECT * FROM pendiente WHERE
        (SELECT clase_productos.sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)= "si"
        ORDER BY 1 asc');

        $conteo_detallesc = 0;
        $secuencia_de_detalles = 0;

        for ($i = 0; $i < count($datos_sampler_pendiente); $i++) {

            $conteo_detallesc = DB::select('SELECT * FROM detalle_clase_productos WHERE detalle_clase_productos.item = :item
            ORDER BY 1 ASC
            LIMIT :tupla, 1;', ['item' => $datos_sampler_pendiente[$i]->item, 'tupla' => $conteo_detallesc]);
        }
    }

    public function eliminar_detalle_olvidado($id)
    {
        DB::delete('delete from detalle_factura where id_detalle = ?', [$id]);
        $this->da = "hola";
    }


    //Funcion insertar nuevo precio

    public function imprimir_reporte()
    {
        $vista =  view('Exports.producto-precio', [
            'prodcutosPrecio' => DB::select(
                'call mostrar_catalogo_precios_busqueda_historial(?,?,?,?,?,?,?,?)',
                [
                    $this->codigo,
                    $this->marca,
                    $this->nombre,
                    $this->vitola,
                    $this->capa,
                    $this->empaque,
                    $this->precio_menor == '' ? 0 : $this->precio_menor,
                    $this->precio_mayor == '' ? 0 : $this->precio_mayor,
                ]
            )
        ]);

        return Excel::download(new CatalogoPrecioExport($vista), 'Catalogo Precios.xlsx');
    }

    public function save()
    {
        try {
            DB::beginTransaction();

            $marca_precio =  CatalogoMarcasPrecio::firstOrCreate(
                ['marca' => $this->marca_n],
                ['codigo' => $this->codigo_n]
            );

            $codigo_precio_n = intval($marca_precio->codigo);
            $codigo_precio = CatalogoItemsPrecio::where('id_catalogo_marca_precio', '=', $marca_precio->id)->orderBy('id', 'desc')->first();
            if ($codigo_precio) {
                $codigo_precio_n = $codigo_precio->codigo + 1;
            } else {
                $codigo_precio_n++;
            }

            $precio =  CatalogoItemsPrecio::firstOrCreate(
                [
                    'id_catalogo_marca_precio' => $marca_precio->id,
                    'nombre' => $this->nombre_n,
                    'vitola' => $this->vitola_n,
                    'capa' => $this->capa_n,
                    'tipo_empaque' => $this->empaque_n
                ],
                ['codigo' => $codigo_precio_n, 'fecha' => Carbon::now()->format('Y-m-d')]
            );

            CatalogoHistorialPrecio::updateOrCreate(
                [
                    'id_catalogo_items_precio' => $precio->id,
                    'anio' => Carbon::now()->format('Y')
                ],
                ['precio' => $this->precio_n, 'porcentaje_incremento' => 0]
            );

            $this->insertar_precio_catalogo(clase_producto::find($this->id_clase_producto),pendiente::find($this->id_pendiente_precio),$precio->codigo,$this->precio_n);


            $this->dispatchBrowserEvent('RegistradoConExito');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

}
