<?php

namespace App\Http\Livewire;

use App\Exports\FacturaExportView;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class HistorialVentas extends Component
{
    public $factura_mes;
    public $fecha_mes;
    public $detalles_venta;
    public $id_venta;
    public $num_factura_sistema;
    public $busqueda;

    public $id_factura_editar;
    public $num_factura_editar;
    public $cliente_editar;
    public $contenedor_editar;


    
    public function render()
    {
        $this->factura_mes = DB::select('CALL `traer_ventas_historial`(:fecha,:busqueda)',
                        ["fecha"=> $this->fecha_mes, "busqueda"=> $this->busqueda]);

        $this->detalles_venta = DB::select(
            'CALL `traer_detalles_historial_factura`(:id)',
            [
                'id' => $this->id_venta
            ]
        );

        return view('livewire.facturas-busqueda-productos')->extends('principal')->section('content');
    }


    public function mount()
    {
        $this->factura_mes = [];
        $this->fecha_mes = Carbon::now();
        $this->detalles_venta = [];
        $this->id_venta = -1;
        $this->num_factura_sistema = "";

        $this->busqueda="";
    }

    public function detalles_ventas($id,$num_factura_sistema){
        $this->id_venta = $id;
        $this->num_factura_sistema = $num_factura_sistema;
    }

    public function exportar_factura(){
        return Excel::download(new FacturaExportView($this->num_factura_sistema), 'Factura.xlsx');
    }

    public function editar_factura($id){
        
        $pendiente = DB::select(
            ' CALL `traer_factura_datos`(:id)',
            [
                'id' => $id
            ]
        );

        $this->id_factura_editar =  $id;
        $this->num_factura_editar=$pendiente[0]->numero_factura;
        $this->cliente_editar=$pendiente[0]->cliente;
        $this->contenedor_editar=$pendiente[0]->contenedor;

        $this->dispatchBrowserEvent("abrir");
    }


    public function update_factura(Request $request){

        DB::select(' CALL `actualizar_factura_venta`(:num_factura,:cliente,:contenedor,:id)',
            [
                'num_factura' => $request->num_factura,
                'cliente' => $request->cliente,
                'contenedor' => $request->contenedor,
                'id' => $request->id_venta,
            ]
        );

        return redirect()->route('historial_factura');
    }
       
}
