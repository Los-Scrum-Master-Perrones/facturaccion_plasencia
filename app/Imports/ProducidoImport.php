<?php

namespace App\Imports;

use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\ProduccionOrden;
use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProducidoImport implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $orden = '';
        $fecha = '';
        foreach ($rows as $key => $row) {

            if ($row[0] === 'Nombre_Sucursal' || $row[0] === 'Cantidad Producida' || $row[0] === 'Fecha') {
                continue;
            }

            if (is_null($row[0]) && is_null($row[10]) && is_null($row[6]) && is_null($row[12]) && is_null($row[4])) {
                continue;
            }

            if ($this->obtenerUltimaPalabra($row[0]) === 'Total') {
                continue;
            }

            $orden = $row[2] ? $row[2]: $orden;
            $fecha = $row[0] ? $row[0]: $fecha;

            $marca = marca_producto::updateOrCreate(
                ['marca' => $row[6]],
                ['marca' => $row[6]]
            );
            $nombre = nombre_producto::updateOrCreate(
                ['nombre' => $row[8]],
                ['nombre' => $row[8]]
            );
            $vitola = vitola_producto::updateOrCreate(
                ['vitola' => $row[10]],
                ['vitola' => $row[10]]
            );
            $capa = capa_producto::updateOrCreate(
                ['capa' => $row[12]],
                ['capa' => $row[12]]
            );

            $producto = Produccion::updateOrCreate(
                ['codigo' => $row[4]],
                [
                    'id_marca' => $marca->id_marca,
                    'id_nombre' => $nombre->id_nombre,
                    'id_vitola' => $vitola->id_vitola,
                    'id_capa' => $capa->id_capa,
                    'existencia' => 0,
                ]
            );



            $orden_entrada = new ProduccionOrden();
            $orden_entrada->id_producto = $producto->id;
            $orden_entrada->cantidad = $row[14];
            $orden_entrada->orden = $orden;

            $orden_entrada->fecha = $this->obtenerPrimeraPalabra($fecha);
            $orden_entrada->save();



        }
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

    function obtenerPrimeraPalabra($cadena) {
        // Divide la cadena en palabras utilizando espacios como separadores
        $palabras = explode(' ', $cadena);

        // Elimina espacios en blanco al final de la cadena
        $palabras = array_filter($palabras, 'trim');

        // Obtiene la última palabra utilizando array_pop
        $ultimaPalabra = $palabras[0];

        $fechaEnTimestamp = strtotime('1899-12-30 +' . $ultimaPalabra . ' days');

        // Formatea el timestamp como una fecha legible
        $fechaFormateada = date('Y-m-d', $fechaEnTimestamp);

        return  $fechaFormateada;
    }
}
