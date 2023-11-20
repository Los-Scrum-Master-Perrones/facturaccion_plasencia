<?php

namespace App\Imports;

use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\ProduccionMateriales;
use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProduccionMateriales2Import implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $datos = [];
        $codigo = '';
        $presentacion = '';
        $marca = '';
        $nombre = '';
        $vitola = '';
        $capa = '';
        $banda = '';
        $onza_banda = '';
        $cantidad = '';

        foreach ($rows as $key => $row) {

            if ($row[0] === 'Codigo_ProductoPuro' || $row[7] === 'Nombre_Producto' || is_null($row[7])) {
                continue;
            }

            if ($this->obtenerUltimaPalabra($row[5]) === 'Total') {
                continue;
            }

            $codigo = $row[0] ? $row[0]: $codigo;
            $presentacion = $row[1] ? $row[1]: $presentacion;

            $marca = $row[2] ? $row[2]: $marca;
            $nombre = $row[3] ? $row[3]: $nombre;
            $vitola = $row[4] ? $row[4]: $vitola;
            $capa = $row[5] ? $row[5]: $capa;

            $banda = $row[6] ? $row[6]: $banda;
            $onza_banda = '';
            $cantidad = 100;


            $marcas = marca_producto::updateOrCreate(
                ['marca' => $marca],
                ['marca' =>  $marca]
            );

            $nombres = nombre_producto::updateOrCreate(
                ['nombre' => $nombre],
                ['nombre' => $nombre]
            );

            $vitolas = vitola_producto::updateOrCreate(
                ['vitola' => $vitola],
                ['vitola' => $vitola]
            );

            $capas = capa_producto::updateOrCreate(
                ['capa' => $capa],
                ['capa' => $capa]
            );

            $producto = Produccion::updateOrCreate(
                ['codigo' => $codigo],
                [
                    'presentacion' => $presentacion,
                    'id_marca' => $marcas->id_marca,
                    'id_nombre' => $nombres->id_nombre,
                    'id_vitola' => $vitolas->id_vitola,
                    'id_capa' => $capas->id_capa,
                    'existencia' => 0,
                ]
            );


            $datos[] = [
                'id_producto' => $producto->id,
                'marca' => $marca,
                'nombre' => $nombre,
                'vitola' => $vitola,
                'capa' => $capa,
                'nombre_material' => str_replace('"Liga Puros"', '', $row[7]),
                'onza' => $banda == 'BANDA' || $banda == 'CAPA' ? '8 ONZ.' :'18 ONZ.',
                'banda' => $banda,
                'onza_banda' => $onza_banda,
                'base' => $cantidad,
            ];
        }

        ProduccionMateriales::upsert($datos, [
            'marca',
            'nombre',
            'vitola',
            'capa',
            'nombre_material',
            'onza',
            'banda',
            'onza_banda'
        ], ['base']);

    }

    function obtenerUltimaPalabra($cadena) {
        // Divide la cadena en palabras utilizando espacios como separadores
        $palabras = explode(' ', $cadena);

        // Elimina espacios en blanco al final de la cadena
        $palabras = array_filter($palabras, 'trim');

        // Obtiene la última palabra utilizando array_pop
        $ultimaPalabra = end($palabras);

        return $ultimaPalabra;
    }

}
