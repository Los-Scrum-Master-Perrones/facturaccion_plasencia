<?php

namespace App\Imports;

use App\Models\capa_producto;
use App\Models\cello;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\orden_producto;
use App\Models\tipo_empaque;
use App\Models\vitola_producto;
use App\Models\clase_producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use App\Imports\CapaImport;
use App\Imports\NombreImport;
use App\Imports\VitolaImport;
use App\Imports\MarcaImport;
use App\Imports\OrdenImport;
use App\Imports\CelloImport;
use App\Imports\tipo_empaqueImport;
use Illuminate\Support\Facades\DB;

class clase_productoImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
        $capa = capa_producto::where('capa',$row[11])->get('id_capa');
        $vitola = vitola_producto::where('vitola',$row[9])->get('id_vitola');
        $nombre = nombre_producto::where('nombre',$row[10])->get('id_nombre');
        $marca = marca_producto::where('marca',$row[8])->get('id_marca');
        $orden = orden_producto::where('orden',$row[7])->get('id_orden');
        

        $cello = DB::table('cellos')->where('cello','=',$row[14])->where('anillo','=',$row[13])->where('upc','=',$row[15])->get('id_cello');
        $tipo_empaque = tipo_empaque::where('tipo_empaque',$row[12])->get('id_tipo_empaque');


        if( $row[1] ==null ||$row[11] ==null || $row[9] ==null ||$row[10]==null ||$row[8]==null ||
        $row[7] ==null ||$row[14] ==null || $row[13] ==null ||$row[15] ==null ||$row[12] ==null ){

        $clase_producto= null;
        }else{
        if($row[1] =='ITEM NUMBERS' || $row[11] =='CAPA' || $row[9] =='VITOLA' ||$row[10]=='NOMBRE' ||$row[8]=='MARCA'
        ||
        $row[7] =='ORDEN' ||$row[14] =='CELLO' || $row[13] =='ANILLO' ||$row[15] =='UPC' ||$row[12] =='TIPO DE
        EMPAQUE'){
        $clase_producto= null;
        }else{
        $marca_existe = clase_producto::where('item',$row[1])->count();
        if($marca_existe>0){
        $clase_producto = null;
        }else{

             
      $clase_producto =  new  clase_producto([
            'item'=>$row[1],
            'id_capa'=>isset($capa[0]->id_capa)?$capa[0]->id_capa:null,
            'id_vitola'=>isset($vitola[0]->id_vitola)?$vitola[0]->id_vitola:null,
            'id_nombre'=>isset($nombre[0]->id_nombre)?$nombre[0]->id_nombre:null,
            'id_marca'=>isset($marca[0]->id_marca)?$marca[0]->id_marca:null,
            'id_orden'=>isset($orden[0]->id_orden)?$orden[0]->id_orden:null, 
            'id_cello'=>isset($cello[0]->id_cello)?$cello[0]->id_cello:null,
            'id_tipo_empaque'=>isset($tipo_empaque[0]->id_tipo_empaque)?$tipo_empaque[0]->id_tipo_empaque:null,

        ]);
    }}

      }
        return $clase_producto;
     }
        
  }