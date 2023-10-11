<?php

namespace App\Http\Livewire;

use App\Exports\SamplerFaltantes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Pedido extends Component
{

    public $pedido_completo;
    public $verificar;
    public $total_puros = 0;


    public $b_categoria;
    public $b_item;
    public $b_orden;
    public $comparativos = [];
    public $nuevos;

    public function render()
    {
        $this->comparativo();
        $this->nuevos = DB::select('select * from item_faltantes');

        $this->total_puros = 0;
        $this->verificar = DB::select('call verificar_item_clase');

        $this->pedido_completo = DB::select('call buscar_pedidos(:item,:categoria,:orden)', [
            "item" => $this->b_item,
            "categoria" => $this->b_categoria,
            "orden" => $this->b_orden
        ]);


        $todosLosDetalles = DB::select('call traer_numero_detalles_productos_datos()');


        $cantidad_detalle_sampler = 0;
        $detalles = 0;
        $valores = [];

        foreach ($todosLosDetalles as $key => $value) {
            $valores[$value->item][] = $value;
        }

        for ($i = 0; $i < count($this->pedido_completo); $i++) {
            if (is_numeric($this->pedido_completo[$i]->unidades) && is_numeric($this->pedido_completo[$i]->cant_paquetes)) {
                $this->total_puros += $this->pedido_completo[$i]->unidades * $this->pedido_completo[$i]->cant_paquetes;
            } else {
                $this->total_puros += 0;
            }

            if ($this->pedido_completo[$i]->sampler == 'si') {

                if ($cantidad_detalle_sampler == 0 && $detalles == 0) {
                    $cantidad_detalle_sampler = $this->pedido_completo[$i]->can_sampler;
                }

                $val = $valores[$this->pedido_completo[$i]->item];

                $this->pedido_completo[$i]->descripcion = $this->pedido_completo[$i]->descripcion_sampler . " " . $val[$detalles]->marca . " " . $val[$detalles]->nombre . " " . $val[$detalles]->capa . " " . $val[$detalles]->vitola;
                $this->pedido_completo[$i]->codigo_p = $val[$detalles]->codigo_producto;
                $detalles++;

                if ($detalles == $cantidad_detalle_sampler) {
                    $detalles = 0;
                    $cantidad_detalle_sampler = 0;
                }
            }
        }

        return view('livewire.pedido')->extends('principal')->section('content');
    }

    public function modal_productos_nuevos()
    {
        $this->dispatchBrowserEvent('abrir_faltalte');
    }

    public function agregar_productos()
    {
        return redirect()->route('productos');
    }

    public function agregar_productos_exporta()
    {
        $this->dispatchBrowserEvent('cerrar_faltalte');
        return Excel::download(new SamplerFaltantes(), "Faltantes-" . Carbon::now()->format("Ymdgis") . ".xls");
    }

    public function mount()
    {
        $this->b_categoria = "";
        $this->b_item = "";
        $this->b_orden = "";
        $this->total_puros = 0;
        $this->verificar = [];
        $this->pedido_completo = [];
    }

    function vaciar_import_excel()
    {
        DB::table('item_faltantes')->delete();
        DB::statement('alter table item_faltantes AUTO_INCREMENT=1;');
        DB::table('pedidos')->delete();
        DB::statement('alter table pedidos AUTO_INCREMENT=1;');
        $this->verificar = DB::select('call verificar_item_clase');
        $this->pedido_completo = DB::select('call mostrar_pedido');
    }

    function comparativo()
    {
        $pedido = DB::table('pedidos')
            ->select(
                'item',
                'numero_orden as hon',
                DB::raw('concat(item, numero_orden) as conca'),
                DB::raw('sum(cant_paquetes*unidades) as cantidad')
            )
            ->groupByRaw('item, numero_orden')->get();

        $po = DB::table('po')->select(
            'po.item',
            'hon',
            DB::raw('sum(cantidad*tipo_empaques.por_caja) as cantidad'),
            DB::raw('concat(po.item, hon) as conca'),
        )
            ->join('clase_productos', 'clase_productos.item', 'po.item')
            ->join('tipo_empaques', 'tipo_empaques.id_tipo_empaque', 'clase_productos.id_tipo_empaque')
            ->groupByRaw('po.item, hon')
            ->get();

        foreach ($pedido as $o) {
            $arreglo = array_column($po->toArray(), 'conca');
            $res = array_search($o->conca, $arreglo);
            if ($res !== false) {
                $existencia[] = [
                    'item' => $o->item, 'hon' => $o->hon,
                    'individual' => $po[$res]->cantidad, 'global' => $o->cantidad,
                    'diferencia' => $o->cantidad - $po[$res]->cantidad
                ];
            } else {
                $existencia[] = [
                    'item' => $o->item, 'hon' => $o->hon,
                    'individual' => 0, 'global' => $o->cantidad,
                    'diferencia' => $o->cantidad
                ];
            }
        }
        foreach ($po as $o) {
            $res = array_search($o->conca, array_column($pedido->toArray(), 'conca'));
            if ($res !== false) {
            } else {
                $existencia[] = [
                    'item' => $o->item, 'hon' => $o->hon,
                    'individual' => $o->cantidad, 'global' => 0,
                    'diferencia' => $o->cantidad
                ];
            }
        }
        $this->comparativos = collect($existencia);
    }
}
