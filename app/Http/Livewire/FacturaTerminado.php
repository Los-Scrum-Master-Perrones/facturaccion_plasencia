<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\Component;

use App\Exports\FacturaExport;
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

    public $id_eliminar;
    public $id_editar;



    public function render()
    {
        $this->total_cantidad_bultos = 0;
        $this->total_total_puros = 0;
        $this->total_peso_bruto = 0;
        $this->total_peso_neto = 0;

        setlocale(LC_TIME, "spanish");
        $Nueva_Fecha = date("d-m-Y", strtotime($this->fecha_factura));

        $this->titulo_mes = strftime("%B", strtotime($Nueva_Fecha));
        $this->titulo_cliente = $this->cliente;

        $this->datos_pendiente = DB::select(
            'call buscar_pendiente_factura(:orden,:nombre,:fechade,:fechahasta)',
            [
                'orden' => $this->tipo_factura,
                'nombre' =>  $this->nom,
                'fechade' =>  $this->fede,
                'fechahasta' => $this->fecha
            ]
        );


        $this->detalles_venta = DB::select(
            'call mostrar_detalle_factura(:ordenes)',
            [
                'ordenes' => $this->tipo_factura
            ]
        );

        if ($this->nom != "" || $this->fede != "" || $this->fecha != "") {
            $this->dispatchBrowserEvent("pendiente");
        }

        $this->num_factura_sistema = DB::select('call traer_num_factura()')[0]->factura_interna;


        for ($i = 0; $i < count($this->detalles_venta); $i++) {
            $this->total_cantidad_bultos += $this->detalles_venta[$i]->cantidad_puros;
            $this->total_total_puros += $this->detalles_venta[$i]->total_tabacos;
            $this->total_peso_bruto += $this->detalles_venta[$i]->total_bruto;
            $this->total_peso_neto += $this->detalles_venta[$i]->total_neto;
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
        DB::delete('call eliminar_detalle_factura(:id)', ['id' => $id]);
        $this->dispatchBrowserEvent("cerrar_modal_borrar");
    }

    public function abrir_modal($id_pendiente)
    {

        $pendiente = DB::select(
            ' CALL `traer_descripcion_factura`(:id)',
            [
                'id' => $id_pendiente
            ]
        );

        $this->id_pendiente =  $id_pendiente;
        $this->descripcion_producto = $pendiente[0]->producto;
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

        $this->editar_descripcion_producto =  "";
        $this->editar_cantidad_bultos = 0;
        $this->editar_unidades_bultos =  0;
        $this->editar_unidades_cajon =  0;
        $this->editar_peso_bruto =  0;
        $this->editar_peso_neto =  0;

        $this->fecha_factura = Carbon::now()->format("Y-m-d");
    }

    public function insertar_detalle_factura(Request $request)
    {

        DB::select('call insertar_detalle_factura(
                 :id_pendiente
                ,:pa_cantidad_cajas
                ,:pa_peso_bruto
                ,:pa_peso_neto
                ,:pa_cantidad_puros
                ,:pa_unidad
                ,:pa_observaciones)', [

            "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto, "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos, "pa_observaciones" => "Sin Facturar"
        ]);

        return redirect()->route('f_terminado');
    }

    public function actualizar_detalle_factura(Request $request)
    {

        DB::select('call actualizar_detalle_factura(
                 :id_pendiente
                ,:pa_cantidad_cajas
                ,:pa_peso_bruto
                ,:pa_peso_neto
                ,:pa_cantidad_puros
                ,:pa_unidad)', [

            "id_pendiente" => $request->id_pendi, "pa_cantidad_cajas" => $request->unidades_cajon, "pa_peso_bruto" => $request->peso_bruto, "pa_peso_neto" => $request->peso_neto, "pa_cantidad_puros" => $request->cantidad_bultos, "pa_unidad" => $request->unidades_bultos
        ]);

        return redirect()->route('f_terminado');
    }


    public function insertar_factura()
    {
        if ($this->cliente != null && $this->contenedor != null) {

            $this->detalles_venta = DB::select(
                'call mostrar_detalle_factura(:ordenes)',
                [
                    'ordenes' => $this->tipo_factura
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

                "orden_sufijo" =>  $this->tipo_factura,
                "pa_cliente" => $this->cliente,
                "pa_numero_factura" => $this->num_factura_sistema,
                "pa_contenedor" => $this->contenedor,
                "pa_cantidad_bultos" => $this->total_cantidad_bultos,
                "pa_total_puros" => $this->total_total_puros,
                "pa_total_peso_bruto" => $this->total_peso_bruto,
                "pa_total_peso_neto" => $this->total_peso_bruto,
                "pa_fecha_factura" => $this->fecha_factura
            ]);

            return Excel::download(new FacturaExport($this->num_factura_sistema), 'Pendiente.xlsx');
        }else{
            $this->dispatchBrowserEvent("advertencia_mensaje");
        }
    }
}
