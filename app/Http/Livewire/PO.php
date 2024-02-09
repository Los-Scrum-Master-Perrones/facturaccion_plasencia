<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\POimport;
use App\Models\clase_producto;
use App\Models\detalle_clase_producto;
use App\Models\pedido;

class PO extends Component
{

    public $Po;
    public $b_item;

    public $b_orden;

    public $b_marca;
    public $b_nombre;
    public $b_vitola;
    public $b_capa;
    public $b_tipo_empaque;

    public $hondelete;

    public function mount() {
        $this->b_item ='';
        $this->b_orden ='';
        $this->b_marca ='';
        $this->b_nombre ='';
        $this->b_vitola ='';
        $this->b_capa ='';
        $this->b_tipo_empaque ='';
    }

    public function render(Request $request)
    {
        $this->Po = DB::select("CALL `mostra_po`(?,?,?,?,?,?,?)", [$this->b_item,
                                                                   $this->b_orden,
                                                                   $this->b_marca,
                                                                   $this->b_nombre,
                                                                   $this->b_vitola,
                                                                   $this->b_capa,
                                                                   $this->b_tipo_empaque]);
        return view('livewire.importPO')->extends('principal')->section('content');
    }

    public function importPO(Request $request)
    {
        $hon= $request->file('select_file')->getClientOriginalName();
        Excel::import(new POimport($hon), $request->select_file);
        return redirect('/poimport');
    }

    public function deletePO(){

        if ($this->hondelete!=null) {
            DB::table('po')->where('hon', '=', $this->hondelete)->delete();
        $this->dispatchBrowserEvent('exito');
        }else{
            DB::table('po')->truncate();
        $this->dispatchBrowserEvent('exito');
        }
    }

    public function pasarPedido(){

        $Po = DB::select("CALL `mostra_po`('','','','','','','')");

        foreach ($Po as $key => $value) {
            $sampler = clase_producto::where("item", "=", $value->item)->first();

            if (isset($sampler->sampler) ) {
                if ($sampler->sampler == 'si') {
                    $detalles_sampler = detalle_clase_producto::where("item", "=", $value->item)->get();
                    foreach ($detalles_sampler as $key => $value2) {
                        $pedio =  new pedido([
                            'item' => $value->item,
                            'cant_paquetes' => ($value->cantidad*$value->por_caja)/count($detalles_sampler),
                            'unidades' => 1,
                            'numero_orden' => $value->hon,
                            'categoria' => "1",
                        ]);
                        $pedio->save();
                    }
                } else {
                    $pedio =  new pedido([
                        'item' =>$value->item,
                        'cant_paquetes' => $value->por_caja,
                        'unidades' => $value->cantidad,
                        'numero_orden' => $value->hon,
                        'categoria' => "1",
                    ]);
                    $pedio->save();
                }
            } else {

                $pedio =  new pedido([
                    'item' => $value->item,
                    'cant_paquetes' => $value->por_caja,
                    'unidades' => $value->cantidad,
                    'numero_orden' => $value->hon,
                    'categoria' => "1",
                ]);
                $pedio->save();
            }
        }
        return redirect()->route('import_excel');
    }
}
