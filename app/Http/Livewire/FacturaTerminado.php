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
    public $total_saldo;
    public $total_pendiente;
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




    public function render()
    {
        $this->total_cantidad_bultos = 0;
        $this->total_total_puros = 0;
        $this->total_peso_bruto = 0;
        $this->total_peso_neto = 0;
        $this->total_valor = 0;
        $this->total_saldo = 0;
        $this->total_pendiente = 0;


        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));

        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;

        $this->datos_pendiente = DB::select(
            'call buscar_pendiente_factura(:orden_sistema,:fechade,:item,:orden)',
            [
                'orden' => $this->hon,
                'fechade' =>  $this->fede,
                'item' =>  $this->item,
                'orden_sistema' =>  $this->orden,
            ]
        );



        $this->detalles_venta = DB::select('call mostrar_detalle_factura(?)',[$this->aereo]);

        if ($this->nom != "" || $this->fede != "" || $this->fecha != "" || $this->item != "" || $this->orden != "" || $this->hon != "") {
            $this->dispatchBrowserEvent("pendiente");
        }

        $this->num_factura_sistema = DB::select('call traer_num_factura()')[0]->factura_interna;

        $this->detalles_produtos = DB::select('CALL `mostrar_detalles_productos`()');

        for ($i = 0; $i < count($this->datos_pendiente); $i++) {
            $this->total_saldo += $this->datos_pendiente[$i]->saldo;
            $this->total_pendiente += $this->datos_pendiente[$i]->pendiente;
        }


        for ($i = 0; $i < count($this->detalles_venta); $i++) {
            $this->total_cantidad_bultos += $this->detalles_venta[$i]->cantidad_puros;
            $this->total_total_puros += $this->detalles_venta[$i]->total_tabacos;
            $this->total_peso_bruto += $this->detalles_venta[$i]->total_bruto;
            $this->total_peso_neto += $this->detalles_venta[$i]->total_neto;
            $this->total_valor += $this->detalles_venta[$i]->valor_total;
        }

        return view('livewire.factura-terminado')->extends('principal')->section('content');
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


        $sampler = DB::select('SELECT sampler,descripcion_sampler
        FROM clase_productos
        WHERE  clase_productos.item = (select item from pendiente where id_pendiente =
                                            (select id_pendiente from detalle_factura where id_detalle = ?)


                                        );', [$id]);

        if ($sampler[0]->sampler == "si") {

            $detalles_item = DB::select('select id_pendiente from detalle_factura  where id_detalle = ?',[$id]);

            $detalles = DB::select('select item, orden from pendiente where id_pendiente = ?',[$detalles_item[0]->id_pendiente]);


            $valores_extras = DB::select('select id_pendiente, (select id_detalle from detalle_factura  where detalle_factura.id_pendiente = pendiente.id_pendiente) as id_detalle from pendiente where item = ? and orden = ?',[$detalles[0]->item, $detalles[0]->orden]);

            DB::delete('call eliminar_detalle_factura(:id)', ['id' => $id]);

            for($i = 1; $i < count($valores_extras);$i++){
                DB::delete('call eliminar_detalle_factura(:id)', ['id' => $valores_extras[$i]->id_detalle]);

            }


        } else {
            DB::delete('call eliminar_detalle_factura(:id)', ['id' => $id]);
        }



        $this->dispatchBrowserEvent("cerrar_modal_borrar");
    }

    public function abrir_modal($id_pendiente)
    {

        $sampler = DB::select('SELECT sampler,descripcion_sampler,(select tipo_empaque_ingles from tipo_empaques where id_tipo_empaque =  (select tipo_empaque from pendiente where id_pendiente = ?)) as empaque
                                FROM clase_productos
                                WHERE  clase_productos.item = (select item from pendiente where id_pendiente = ?);', [$id_pendiente, $id_pendiente]);

        if ($sampler[0]->descripcion_sampler != null) {

            $this->descripcion_producto = strtoupper($sampler[0]->empaque . " " . $sampler[0]->descripcion_sampler);
        } else {
            $pendiente = DB::select(
                ' CALL `traer_descripcion_factura`(:id)',
                [
                    'id' => $id_pendiente
                ]
            );

            $this->descripcion_producto = $pendiente[0]->producto;
        }



        $this->id_pendiente =  $id_pendiente;
        $this->dispatchBrowserEvent("abrir");
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

        $this->total_saldo = 0;
        $this->total_pendiente = 0;

        $this->editar_descripcion_producto =  "";
        $this->editar_cantidad_bultos = 0;
        $this->editar_unidades_bultos =  0;
        $this->editar_unidades_cajon =  0;
        $this->editar_peso_bruto =  0;
        $this->editar_peso_neto =  0;

        $this->fecha_factura = Carbon::now()->format("Y-m-d");

        $this->aereo =  "RP";
    }

    public function insertar_detalle_factura(Request $request)
    {


        $sampler = DB::select('SELECT sampler,descripcion_sampler
                                FROM clase_productos
                                WHERE  clase_productos.item = (select item from pendiente where id_pendiente = ?);', [$request->id_pendi]);



            $datos_pendiente = DB::select('SELECT item, orden, saldo FROM pendiente WHERE id_pendiente = ?', [$request->id_pendi]);

            $conteo = DB::select('SELECT * FROM pendiente WHERE orden = ? AND item = ?', [$datos_pendiente[0]->orden,  $datos_pendiente[0]->item]);

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

                    "id_pendiente" => $conteo[$i]->id_pendiente, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto,
                     "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos,
                     "pa_unidad" => $request->unidades_bultos, "pa_observaciones" => "Sin Facturar"
                    ,"para" =>  $request->para, "anterior" => ($datos_pendiente[0]->saldo - ($request->unidades_bultos*$request->cantidad_bultos))
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

                "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto, "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos, "pa_observaciones" => "Sin Facturar",
                "para" =>  $request->para, "anterior" =>  ($datos_pendiente[0]->saldo - ($request->unidades_bultos*$request->cantidad_bultos))
            ]);
        }




        return redirect()->route('f_terminado');
    }

    public function actualizar_detalle_factura(Request $request)
    {
        $sampler = DB::select('SELECT sampler,descripcion_sampler
        FROM clase_productos
        WHERE  clase_productos.item = (select item from pendiente where id_pendiente =
                                            (select id_pendiente from detalle_factura where id_detalle = ?)


                                        );', [$request->id_pendi]);




            $datos_pendiente = DB::select('SELECT item, orden, saldo FROM pendiente WHERE id_pendiente =
                                        (select id_pendiente from detalle_factura where id_detalle = ?)', [$request->id_pendi]);


        if ($sampler[0]->sampler == "si") {

            $detalles_item = DB::select('select id_pendiente from detalle_factura  where id_detalle = ?',[$request->id_pendi]);

            $detalles = DB::select('select item, orden from pendiente where id_pendiente = ?',[$detalles_item[0]->id_pendiente]);


            DB::select('call actualizar_detalle_factura(
                :id_pendiente
                ,:pa_cantidad_cajas
                ,:pa_peso_bruto
                ,:pa_peso_neto
                ,:pa_cantidad_puros
                ,:pa_unidad,
                :anterior)', [

             "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto,
             "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos,
             "anterior" =>  ($datos_pendiente[0]->saldo - ($request->unidades_bultos*$request->cantidad_bultos))
            ]);

            $conteo = count(DB::select('select * from detalle_clase_productos where item = ?', [$detalles[0]->item]));

            $id_detalle_fa = $request->id_pendi + 1;

            for($i = 1 ; $i < $conteo ; $i++){
                DB::select('call actualizar_detalle_factura(
                    :id_pendiente
                    ,:pa_cantidad_cajas
                    ,:pa_peso_bruto
                    ,:pa_peso_neto
                    ,:pa_cantidad_puros
                    ,:pa_unidad,
                    :anterior)', [

                "id_pendiente" =>   $id_detalle_fa , "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => 0,
                 "pa_peso_neto" => 0, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos,
                 "anterior" =>  ($datos_pendiente[0]->saldo - ($request->unidades_bultos*$request->cantidad_bultos))
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

        return redirect()->route('f_terminado');
    }


    public function insertar_factura()
    {
        if ($this->cliente != null && $this->contenedor != null) {

            $this->detalles_venta = DB::select(
                'call mostrar_detalle_factura(:ordenes)',
                [
                    'ordenes' => $this->aereo
                ]
            );

            for ($i = 0; $i < count($this->detalles_venta); $i++) {
                DB::select('call `actualizar_pendiente_saldo_factura`(
                :id_pendiente,
                :pa_saldo)', [
                    "id_pendiente" => $this->detalles_venta[$i]->id_pendiente,
                    "pa_saldo" => $this->detalles_venta[$i]->total_tabacos
                ]);
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
                :pa_fecha_factura)', [

                "orden_sufijo" =>  $this->aereo,
                "pa_cliente" => $this->cliente,
                "pa_numero_factura" => $this->num_factura_sistema,
                "pa_contenedor" => $this->contenedor,
                "pa_cantidad_bultos" => $this->total_cantidad_bultos,
                "pa_total_puros" => $this->total_total_puros,
                "pa_total_peso_bruto" => $this->total_peso_bruto,
                "pa_total_peso_neto" => $this->total_peso_bruto,
                "pa_fecha_factura" => $this->fecha_factura
            ]);

            //return Excel::download(new FacturaExport($this->num_factura_sistema), 'Pendiente.xlsx');
            return Excel::download(new FacturaExportView($this->num_factura_sistema), 'Factura.xlsx');
        } else {
            $this->dispatchBrowserEvent("advertencia_mensaje");
        }
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
