<?php

namespace App\Imports;

use App\Models\pendiente_empaque;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Models\categoria;
use App\Models\clase_producto;
use DB;




use App\Models\capa_producto;
use App\Models\cello;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\orden_producto;
use App\Models\tipo_empaque;
use App\Models\vitola_producto;
use App\Imports\CapaImport;
use App\Imports\NombreImport;
use App\Imports\VitolaImport;
use App\Imports\MarcaImport;
use App\Imports\OrdenImport;
use App\Imports\CelloImport;
use App\Imports\tipo_empaqueImport;
use Maatwebsite\Excel\Concerns\Importable;


class Pendiente_empaqueImport implements ToModel
{
    use Importable;


    public function model(array $row)
    {

   
    if($row[0] == null  && $row[1] == null 
    && $row[2] == null
    && $row[3] == null 
    && $row[4] == null 
    && $row[5] == null 
    && $row[6] == null 
    && $row[7] == null 
    && $row[8] == NULL
    && $row[9] == null 
    && $row[10] == null 
   ){

$pendiente_empaque = null;

}else{

if($row[0] == "CATEGORIA"  ){
$pendiente_empaque = null;
}else {

    $capa = capa_producto::where('capa',$row[7])->get('id_capa');
    $vitola = vitola_producto::where('vitola',$row[5])->get('id_vitola');
    $nombre = nombre_producto::where('nombre',$row[6])->get('id_nombre');
    $marca = marca_producto::where('marca',$row[4])->get('id_marca');
    $tipo = tipo_empaque::where('tipo_empaque',$row[8])->get('id_tipo_empaque');
    $cello = DB::table('cellos')->where('cello','=',$row[10])->where('anillo','=',$row[9])->where('upc','=',$row[11])->get('id_cello');
      


$categoria = \DB::select('CALL `traer_categoria_id`(:cate)',['cate'=>$row[0]]);

$pendiente_empaque = new pendiente_empaque([
'categoria'=> isset($categoria[0]->id_categoria)?$categoria[0]->id_categoria:null,
'item'=> "",
'orden_del_sitema'=>$row[1],
'observacion'=>"",
'presentacion'=>"",
'mes'=>$row[2],
'orden'=>$row[3],
'marca'=>isset($marca[0]->id_marca)?$marca[0]->id_marca:null,
'vitola'=>isset($vitola[0]->id_vitola)?$vitola[0]->id_vitola:null,
'nombre'=>isset($nombre[0]->id_nombre)?$nombre[0]->id_nombre:null,
'capa'=> isset($capa[0]->id_capa)?$capa[0]->id_capa:null,
'tipo_empaque'=>isset($tipo[0]->id_tipo_empaque)?$tipo[0]->id_tipo_empaque:null,
'cello'=>isset($cello[0]->id_cello)?$cello[0]->id_cello:null,
'pendiente'=>$row[12],
'saldo'=>$row[12],
'paquetes'=>"0",
'unidades'=>"0"

]);
}
}

return $pendiente_empaque;
    }
}
