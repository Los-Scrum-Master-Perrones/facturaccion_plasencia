<?php

namespace App\Http\Livewire\Produccion;

use App\Exports\ProduccionReporteExport;
use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\ProduccionPendiente as ModelsProduccionPendiente;
use App\Models\ProduccionPendienteSalida;
use App\Models\vitola_producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class ProduccionPendiente extends Component
{
    use WithPagination;
    public $select_file;

    protected $paginationTheme = 'bootstrap';

    public $b_fechas = '';
    public $b_ordenes = '';
    public $b_presentacion = '';
    public $b_codigos = '';
    public $b_marcas = '';
    public $b_nombres = '';
    public $b_vitolas = '';
    public $b_capas = '';
    public $b_mes = '';
    public $tipo1 = "Puros Tripa Larga";
    public $tipo2 = "Puros Tripa Corta";
    public $tipo3 = "Puros Sandwich";
    public $tipo4 = "Puros Brocha";
    public $b_color = '';

    public ModelsProduccionPendiente $produc_pendiente;

    protected $rules = [
        'produc_pendiente.id_producto' => 'required',
        'produc_pendiente.orden_sistema' => 'required',
        'produc_pendiente.fecha_recibido' => 'required|date',
        'produc_pendiente.cantidad' => 'required|integer|min:0',
    ];

    public $presentacionn = "";
    public $marcas_nuevo = "";
    public $capas_nuevo = "";
    public $vitolas_nuevo = "";
    public $nombres_nuevo = "";
    public $orden_sistema = "";
    public $observacion = "";
    public $fecha_orden = "";
    public $cantidad_pendiente = "";

    public $fechas = [];
    public $ordenes = [];
    public $presentacion = [];
    public $codigos = [];
    public $marcas = [];
    public $nombres = [];
    public $vitolas = [];
    public $capas = [];
    public $mes = [];
    public $colores = [];

    public $por_pagina = 50;
    public $total = 0;

    public function mount() {

        $this->produc_pendiente = new ModelsProduccionPendiente([
            `id_producto` =>  0,
            `orden_sistema` =>  0,
            `fecha_recibido` =>  Carbon::now()->format('Y-m-d'),
            `cantidad` =>  0
        ]);

        $da = DB::select('CALL `buscar_produccion_pendiente_detalles`()');

        if (count($da) > 0) {

            $this->fechas = [];
            $this->mes = [];
            $this->ordenes = [];
            $this->presentacion = [];
            $this->codigos = [];
            $this->marcas = [];
            $this->nombres = [];
            $this->vitolas = [];
            $this->capas = [];
            $this->colores = [];

            foreach ($da as $detalles) {
                array_push($this->fechas, $detalles->fecha_recibido);
                array_push($this->mes, $detalles->mes);
                array_push($this->ordenes, $detalles->orden_sistema);
                array_push($this->presentacion, $detalles->presentacion);
                array_push($this->codigos, $detalles->codigo);
                array_push($this->marcas, $detalles->marca);
                array_push($this->nombres, $detalles->nombre);
                array_push($this->vitolas, $detalles->vitola);
                array_push($this->capas, $detalles->capa);
                array_push($this->colores, $detalles->color);
            }

            $this->fechas = array_unique($this->fechas);
            $this->mes = array_unique($this->mes);
            $this->ordenes = array_unique($this->ordenes);
            $this->presentacion = array_unique($this->presentacion);
            $this->codigos = array_unique($this->codigos);
            $this->marcas = array_unique($this->marcas);
            $this->nombres = array_unique($this->nombres);
            $this->vitolas = array_unique($this->vitolas);
            $this->capas = array_unique($this->capas);
            $this->colores = array_unique($this->colores);
        }
    }
    public function render()
    {
        $start = ($this->page - 1) * $this->por_pagina;

        $var1 = $this->tipo1?$this->tipo1:'';
        $var2 = $this->tipo2?$this->tipo2:'';
        $var3 = $this->tipo3?$this->tipo3:'';
        $var4 = $this->tipo4?$this->tipo4:'';

        $da = DB::select(
            'CALL `buscar_produccion_pendiente`(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)',
            [
                $this->b_ordenes,
                $this->b_fechas,
                $this->b_codigos,
                $this->b_marcas,
                $this->b_nombres,
                $this->b_vitolas,
                $this->b_capas,
                $start,
                $this->por_pagina,
                $var1.$var2.$var3.$var4.'Sin Presentacion',
                $this->b_color,
            ]
        );

        $this->total = DB::select(
            'CALL `buscar_produccion_pendiente_conteo`(?, ?, ?, ?, ?, ?, ?,?,?)',
            [
                $this->b_ordenes,
                $this->b_fechas,
                $this->b_codigos,
                $this->b_marcas,
                $this->b_nombres,
                $this->b_vitolas,
                $this->b_capas,
                $var1.$var2.$var3.$var4.'Sin Presentacion',
                $this->b_color,
            ]
        )[0]->total;


        $usos = ProduccionPendienteSalida::all(['id_produccion_pendiente','destino','cantidad','fecha_salida']);

        $usosArray2 = [];
        foreach ($usos as $uso) {
            $usosArray2[$uso->id_produccion_pendiente][] =  $uso;
        }

        return view('livewire.produccion.produccion-pendiente', [
            'historial' => $usosArray2,
            'pendiente' => new LengthAwarePaginator($da,  $this->total , $this->por_pagina)
        ])->extends('layouts.produccion.produccion-menu')->section('contenido');
    }


    public function enviar_produccion($datos) {

        ProduccionPendienteSalida::create([
            'id_produccion_pendiente' => $datos[0],
            'destino' => $datos[1],
            'cantidad' => $datos[2],
            'fecha_salida' => $datos[3],
        ]);

        $this->dispatchBrowserEvent('notificacionEnvioExitoso');
    }

    public function buscarProducto($codigo) {

        $produc = Produccion::where("codigo","=",$codigo)->first();

        $this->produc_pendiente->id_producto = $produc->id;
        $this->presentacionn = $produc->presentacion;
        $this->marcas_nuevo = marca_producto::find($produc->id_marca)->marca;
        $this->capas_nuevo = capa_producto::find($produc->id_capa)->capa;
        $this->vitolas_nuevo = vitola_producto::find($produc->id_vitola)->vitola;
        $this->nombres_nuevo = nombre_producto::find($produc->id_nombre)->nombre;

    }

    public function nuevo_pendiente() {
        $this->produc_pendiente = new ModelsProduccionPendiente([
            `id_producto` =>  0,
            `orden_sistema` =>  0,
            `fecha_recibido` =>  Carbon::now()->format('Y-m-d'),
            `cantidad` =>  0
        ]);
    }

    public function registrar_pendiente() {

        $this->produc_pendiente->save();
        $this->dispatchBrowserEvent('notificacionRegistroExitoso');
    }

    public function editar_pendiente(ModelsProduccionPendiente $pendiente) {
        $this->produc_pendiente = $pendiente;
    }

    public function imprimir_reporte_diario(Request $request) {
        $datos = DB::select('call reporte_produccion_mensual(?)',[$request->input('fecha')]);

        return Excel::download(new ProduccionReporteExport($datos), 'Reporte Diario Produccion '.$request->input('fecha').'.xlsx');
    }
}
