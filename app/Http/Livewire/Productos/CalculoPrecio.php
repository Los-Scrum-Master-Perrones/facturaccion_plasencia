<?php

namespace App\Http\Livewire\Productos;

use App\Models\CatalogoItemDatoCalculo;
use App\Models\CatalogoMarcasPrecio;
use App\Models\vitola_producto;
use Livewire\Component;

class CalculoPrecio extends Component
{
    public CatalogoItemDatoCalculo $precio_nuevo;
    public $idMarcaPrecio;
    public $idVitola;
    public $fecha;
    public $salarioDirecto;
    public $salarioEmpaque;
    public $porcentajeCostoSocial;
    public $porcentajeSalarioIndirecto;
    public $capaLbs;
    public $capaLbsCosto;
    public $bandaLbs;
    public $bandaLbsCosto;
    public $tripaLbs;
    public $tripaLbsCosto;
    public $porcentajeGastoAdmin;
    public $porcentajeUtilidad;

    protected $rules = [
        'precio_nuevo.id_marca_precio' => 'required',
        'precio_nuevo.id_vitola' => 'required',
        'precio_nuevo.salario_directo' => 'number',
        'precio_nuevo.salario_empaque' => 'number',
        'precio_nuevo.costos_indirectos' => 'number',
        'precio_nuevo.material_empaque' => 'number',
        'precio_nuevo.porcentaje_costo_social' => 'number',
        'precio_nuevo.porcentaje_salario_indirecto' => 'number',
        'precio_nuevo.capa_lbs' => 'number',
        'precio_nuevo.capa_lbs_costo' => 'number',
        'precio_nuevo.banda_lbs' => 'number',
        'precio_nuevo.banda_lbs_costo' => 'number',
        'precio_nuevo.tripa_lbs' => 'number',
        'precio_nuevo.tripa_lbs_costo' => 'number',
        'precio_nuevo.porcentaje_utilidad' => 'number',
        'precio_nuevo.porcentaje_gasto_admin' => 'number',
        'precio_nuevo.id_catalogo_precio_item' => 'number',
    ];

    public function mount(){
        $precio = CatalogoItemDatoCalculo::where('id_catalogo_precio_item','=',null)->get();

        if($precio->count()==0){
            $precio2 =  new CatalogoItemDatoCalculo();
            $precio2->id_marca_precio = 1;
            $precio2->id_vitola = 1;
            $precio2->save();
            $this->precio_nuevo = CatalogoItemDatoCalculo::find($precio2->id);
        }else{
            $this->precio_nuevo = CatalogoItemDatoCalculo::find($precio[0]->id);
        }

    }

    public function render()
    {
        $this->precio_nuevo->save();
        return view('livewire.productos.calculo-precio',[
            'marcas' => CatalogoMarcasPrecio::all(),
            'vitolas' => vitola_producto::all()
        ]);
    }


}
