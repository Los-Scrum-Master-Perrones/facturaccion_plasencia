<?php

namespace App\Http\Livewire;

use App\Imports\DatosProductosImport;
use Livewire\Component;
use DB;
use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\vitola_producto;
use App\Models\tipo_empaque;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\WithFileUploads;



use Maatwebsite\Excel\Facades\Excel;

class DatosProductos extends Component
{

   use WithPagination;
   public $hola;
   public $productos;
   public $capas;
   public $marcas;
   public $vitolas;
   public $nombres;
   public $tipos;
   public $busqueda;
   public $cc = 1;
   public $select_file;



   public $id_editar_marca;
   public $id_editar_capa;
   public $id_editar_vitola;
   public $id_editar_empaque;
   public $id_editar_nombre;
   public $editar_nombre_marca;
   public $editar_nombre_capa;
   public $editar_nombre_vitola;
   public $editar_nombre_empaque;
   public $editar_nombre_nombre;



   public function render()
   {


      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);


      return view('livewire.datos-productos',)->extends('principal')->section('content');
   }

   public function buscaras()
   {
      $this->cc++;
   }

   public function mount()
   {

      $this->productos = [];
      $this->marcas = [];
      $this->capas = [];
      $this->vitolas = [];
      $this->nombres = [];
      $this->tipos = [];
      $this->busqueda = "";

      $this->capas = capa_producto::all();
      $this->marcas = marca_producto::all();
      $this->nombres = nombre_producto::all();
      $this->vitolas = vitola_producto::all();
      $this->tipos = tipo_empaque::all();
   }





   public function insertar_marca(Request $request)
   {
      $marcas_in =  \DB::SELECT('call insertar_marca(:marca)', ['marca' => $request->marcam]);
      return redirect()->route('datos_producto');
   }

   public function cargar_marca_editar($id)
   {
       $detalles_marca = DB::select('CALL `traer_detalles_editar_marca`(:id)', ['id' => $id]);
       $this->id_editar_marca = $id;
       $this->editar_nombre_marca =  $detalles_marca[0]->marca;
       $this->dispatchBrowserEvent("editar_marcascript");
   }

   public function editar_marca(Request $request)
   {
      $marcas_ac =  \DB::SELECT('call actualizar_marca(:id,:marca)', ['id' => $request->id_marcaE,'marca' => $request->marcae]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }








   public function insertar_capa(Request $request)
   {
      $marcas_in =  \DB::SELECT('call insertar_capa(:capa)', ['capa' => $request->capam]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }
   public function cargar_capa_editar($id)
   {
       $detalles_capa = DB::select('CALL `traer_detalles_editar_capa`(:id)', ['id' => $id]);
       $this->id_editar_capa = $id;
       $this->editar_nombre_capa =  $detalles_capa[0]->capa;
       $this->dispatchBrowserEvent("editar_capascript");
   }

   public function editar_capa(Request $request)
   {
      $capas_ac =  \DB::SELECT('call actualizar_capa(:id,:capa)', ['id' => $request->id_capaE,'capa' => $request->capamE]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }









   public function insertar_nombre(Request $request)
   {
      $marcas_in =  \DB::SELECT('call insertar_nombre(:nombre)', ['nombre' => $request->nombrem]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }
   public function cargar_nombre_editar($id)
   {
       $detalles_nombre = DB::select('CALL `traer_detalles_editar_nombre`(:id)', ['id' => $id]);
       $this->id_editar_nombre = $id;
       $this->editar_nombre_nombre =  $detalles_nombre[0]->nombre;
       $this->dispatchBrowserEvent("editar_nombrescript");
   }

   public function editar_nombre(Request $request)
   {
      $nombre_ac =  \DB::SELECT('call actualizar_nombre(:id,:nombre)', ['id' => $request->id_nombreE,'nombre' => $request->nombremE]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }








   public function insertar_tipo(Request $request)
   {
      $marcas_in =  \DB::SELECT('call insertar_tipo(:tipo)', ['tipo' => $request->tipom]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }
   public function cargar_empaque_editar($id)
   {
       $detalles_tipo = DB::select('CALL `traer_detalles_editar_tipo`(:id)', ['id' => $id]);
       $this->id_editar_empaque = $id;
       $this->editar_nombre_empaque =  $detalles_tipo[0]->tipo_empaque;
       $this->dispatchBrowserEvent("editar_tiposcript");
   }

   public function editar_tipo(Request $request)
   {
      $tipos_ac =  \DB::SELECT('call actualizar_tipo(:id,:tipo)', ['id' => $request->id_tipoE,'tipo' => $request->tipomE]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }








   public function insertar_vitola(Request $request)
   {
      $marcas_in =  \DB::SELECT('call insertar_vitola(:vitola)', ['vitola' => $request->vitolam]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }

   public function cargar_vitola_editar($id)
   {
       $detalles_vitola = DB::select('CALL `traer_detalles_editar_vitola`(:id)', ['id' => $id]);
       $this->id_editar_vitola = $id;
       $this->editar_nombre_vitola =  $detalles_vitola[0]->vitola;
       $this->dispatchBrowserEvent("editar_vitolascript");
   }

   public function editar_vitola(Request $request)
   {
      $vitolas_ac =  \DB::SELECT('call actualizar_vitola(:id,:vitola)', ['id' => $request->id_vitolaE,'vitola' => $request->vitolamE]);
      $this->capas = \DB::SELECT('call buscar_capa(:capa)', ['capa' => $this->busqueda]);
      $this->marcas = \DB::SELECT('call buscar_marca(:marca)', ['marca' => $this->busqueda]);
      $this->nombres = \DB::SELECT('call buscar_nombre(:nombre)', ['nombre' => $this->busqueda]);
      $this->vitolas = \DB::SELECT('call buscar_vitola(:vitola)', ['vitola' => $this->busqueda]);
      $this->tipos = \DB::SELECT('call buscar_tipo_empaque(:tipo)', ['tipo' => $this->busqueda]);
      return redirect()->route('datos_producto');
   }






   use WithFileUploads;

   public function importar_excel()
   {

      (new DatosProductosImport())->import($this->select_file);

      $this->busqueda = "";
   }
}
