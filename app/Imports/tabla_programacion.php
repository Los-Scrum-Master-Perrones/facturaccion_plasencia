<?php

namespace App\Imports;



use Maatwebsite\Excel\Concerns\Importable;
use App\Models\tabla_codigo_programacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\vitola_producto;
use App\Imports\CapaImport;
use App\Imports\NombreImport;
use App\Imports\VitolaImport;
use App\Imports\MarcaImport;

class tabla_programacion implements ToModel
{
    use Importable;
    public function model(array $row)
    {


        $capa = capa_producto::where('capa',$row[8])->get('id_capa');
        $vitola = vitola_producto::where('vitola',$row[7])->get('id_vitola');
        $nombre = nombre_producto::where('nombre',$row[6])->get('id_nombre');
        $marca = marca_producto::where('marca',$row[5])->get('id_marca');
        
        if($row[3]==null&& $row[4]==null&&$row[5]==null&&$row[6]==null &&$row[7]==null){
            $codigo = null;
        }else{

            if($row[3]=="Codigo_Producto"){
                $codigo = null;
            }else{
                    $c_existe = tabla_codigo_programacion::where('codigo',$row[3])->count();
                  if($c_existe>0){
                    $codigo = null;
                  }else{

        
        $codigo =  new tabla_codigo_programacion([
            'codigo' => $row[3],
            'presentacion' => $row[4],
            'marca' => isset($marca[0]->id_marca)?$marca[0]->id_marca:0,
            'nombre' => isset($nombre[0]->id_nombre)?$nombre[0]->id_nombre:0,
            'vitola' => isset($vitola[0]->id_vitola)?$vitola[0]->id_vitola:0,
            'capa' => isset($capa[0]->id_capa)?$capa[0]->id_capa:0,
        ]);
        }}}
        
        return $codigo;
    }
}
