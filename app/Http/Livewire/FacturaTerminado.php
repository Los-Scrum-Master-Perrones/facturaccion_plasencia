<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;

use App\Exports\FacturaExport;
use App\Exports\FacturaExportView;
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
    public $marcas_p;
    public $nombre_p;
    public $vitolas_p;
    public $capas_p;
    public $empaques_p;
    public $mes_p;
    public $items_p;
    public $ordenes_p;
    public $hons_p;

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


    public $ventanas = 1;

    public function cambio($num){
          $this->ventanas = $num;
    }

    public function render()
    {
        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));


        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;

        $this->items_p = DB::select('call buscar_pendiente_item()');
        /*Procedimientos de busquedas de la tabla pendiente*/
        $this->marcas_p = DB::select(
            'call buscar_marca_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->nombre_p = DB::select(
            'call buscar_nombre_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->vitolas_p = DB::select(
            'call buscar_vitola_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->capas_p = DB::select(
            'call buscar_capa_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->empaques_p = DB::select(
            'call buscar_tipo_empaque_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );


        $this->mes_p = DB::select(
            'call buscar_fechas_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->items_p = DB::select(
            'call buscar_item_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->ordenes_p = DB::select(
            'call buscar_ordenes_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );
        $this->hons_p = DB::select(
            'call buscar_hons_pendiente(:uno,:dos,:tres,:cuatro)',
            [
                'uno' =>  $this->r_uno,
                'dos' =>  $this->r_dos,
                'tres' =>  $this->r_tres,
                'cuatro' =>  $this->r_cuatro
            ]
        );

        $this->capas = DB::select('call buscar_capa("")');
        $this->marcas = DB::select('call buscar_marca("")');
        $this->nombres = DB::select('call buscar_nombre("")');
        $this->vitolas = DB::select('call buscar_vitola("")');
        $this->tipo_empaques = DB::select('call buscar_tipo_empaque("")');



        $this->tuplas_conteo = count(DB::select(
            'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
        :pa_items,:pa_orden_sist,:pa_ordenes,
        :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
        :pa_empaques,:pa_meses)',
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
                'pa_ordenes' =>  $this->busqueda_hons_p
            ]
        ));

        if ($this->todos == 1) {
            $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
            :pa_items,:pa_orden_sist,:pa_ordenes,
            :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
            :pa_empaques,:pa_meses)',
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
                    'pa_ordenes' =>  $this->busqueda_hons_p
                ]
            );
        } else {
            $this->datos_pendiente = DB::select(
                'call buscar_pendiente(:uno,:dos,:tres,:cuatro,:pres,:seis,:siete,:paginacion,
                :pa_items,:pa_orden_sist,:pa_ordenes,
                :pa_marcas,:pa_vitolas,:pa_nombre,:pa_capas,
                :pa_empaques,:pa_meses)',
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
                    'pa_ordenes' =>  $this->busqueda_hons_p
                ]
            );
        }
        $this->detalles_venta = DB::select('call mostrar_detalle_factura(?)', [$this->aereo]);

        $this->num_factura_sistema = DB::select('call traer_num_factura()')[0]->factura_interna;

        $this->detalles_produtos = DB::select('CALL `mostrar_detalles_productos`()');

        return view('livewire.factura-terminado')->extends('principal')->section('content');
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

                $valores_extras = DB::select('select id_pendiente, (select id_detalle from detalle_factura  where detalle_factura.id_pendiente = pendiente.id_pendiente) as id_detalle from pendiente where item = ? and orden = ?', [$detalles[0]->item, $detalles[0]->orden]);

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
        $this->busqueda_nombres = [];
        $this->busqueda_capas = [];
        $this->busqueda_tipo_empaques = [];
        $this->busqueda_meses = [];


        $this->datos_pendiente = [];

        $this->paginacion = 0;
        $this->fecha = "";
        $this->borrar = [];
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

    public function actualizar_detalle_factura(Request $request)
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

    public function imprimir()
    {

        $this->detalles_venta = DB::select('call mostrar_detalle_factura(?)', [$this->aereo]);

        $vista =  view('Exports.factura-terminado-exports-simple', [
            'detalles_venta' => $this->detalles_venta
        ]);
        return Excel::download(new FacturaExportView($vista), 'Factura.xlsx');
    }

    public function imprimir_formato_largo()
    {

        $this->detalles_venta = DB::select('call mostrar_detalle_factura(?)', [$this->aereo]);

        $vista =  view('Exports.factura-terminado-exports', [
            'detalles_venta' => $this->detalles_venta
        ]);

        return Excel::download(new FacturaExportView($vista), 'FacturaDetallada.xlsx');
    }





    public function insertar_factura()
    {
        DB::transaction(function () {


            if ($this->cliente != null && $this->contenedor != null) {


                $detalles = DB::select('call mostrar_detalle_factura(?)', [$this->aereo]);


                for ($i = 0; $i < count($detalles); $i++) {

                    $sampler = DB::select('SELECT sampler FROM clase_productos where item = (SELECT item FROM pendiente WHERE id_pendiente = ? )', [$detalles[$i]->id_pendiente]);
                    $cantidad_sampler = DB::select('SELECT COUNT(*) as conteo FROM detalle_clase_productos where item = (SELECT item FROM pendiente WHERE id_pendiente = ? )', [$detalles[$i]->id_pendiente]);

                    $total_pendiete = $detalles[$i]->total_tabacos;

                    if ($sampler[0]->sampler == "si") {
                        $total_pendiete  = ($detalles[$i]->total_tabacos) / $cantidad_sampler[0]->conteo;
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

                DB::select('
            insert into precios_historial(id_detalle_factura,precio) (SELECT detalle_factura.id_detalle AS id_detalle_factura,
            ( if((SELECT clase_productos.sampler FROM clase_productos WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) = "si",
            (SELECT pendiente.precio FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)
            ,
            (SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item =
            (SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))
            )
            )
             AS precio
            FROM detalle_factura,factura_terminados
            WHERE factura_terminados.id = detalle_factura.id_venta and factura_terminados.numero_factura = ?)
            ', [$this->num_factura_sistema]);

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
}
