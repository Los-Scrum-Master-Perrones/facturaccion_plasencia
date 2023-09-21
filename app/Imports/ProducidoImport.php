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

            if ($row[0] === 'Cantidad Producida' || $row[0] === 'Tipo_de_Orden' || $row[0] === 'Fecha') {
                continue;
            }

            if (is_null($row[0]) && is_null($row[4]) && is_null($row[5]) && is_null($row[6]) && is_null($row[7])) {
                continue;
            }

            if ($this->obtenerUltimaPalabra($row[1]) === 'Total') {
                continue;
            }
            if ($this->obtenerUltimaPalabra($row[0]) === 'Total') {
                continue;
            }

            $orden = $row[1] ? $row[1]: $orden;
            $fecha = $row[0] ? $row[0]: $fecha;

            $marca = marca_producto::updateOrCreate(
                ['marca' => $row[3]],
                ['marca' => $row[3]]
            );
            $nombre = nombre_producto::updateOrCreate(
                ['nombre' => $row[4]],
                ['nombre' => $row[4]]
            );
            $vitola = vitola_producto::updateOrCreate(
                ['vitola' => $row[5]],
                ['vitola' => $row[5]]
            );
            $capa = capa_producto::updateOrCreate(
                ['capa' => $row[6]],
                ['capa' => $row[6]]
            );

            $producto = Produccion::updateOrCreate(
                ['codigo' => $row[2]],
                [
                    'id_marca' => $marca->id_marca,
                    'id_nombre' => $nombre->id_nombre,
                    'id_vitola' => $vitola->id_vitola,
                    'id_capa' => $capa->id_capa,
                    'existencia' => 0,
                ]
            );


            $cadena_sin_coma_punto = str_replace(array(',', '.00'), '', $row[7]);

            $orden_entrada = new ProduccionOrden();
            $orden_entrada->id_producto = $producto->id;
            $orden_entrada->cantidad = $cadena_sin_coma_punto;
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

        // Dividir la fecha en sus componentes
        $componentes_fecha = explode('/', $cadena);

        if (count($componentes_fecha) === 3) {
            $dia = $componentes_fecha[0];
            $mes = $componentes_fecha[1];
            $anio = $componentes_fecha[2];

            // Asegurarse de que los valores sean numéricos
            if (is_numeric($dia) && is_numeric($mes) && is_numeric($anio)) {
                // Formatear la fecha como "año-mes-día"
                $fecha_formateada = sprintf("%04d-%02d-%02d", $anio, $mes, $dia);
                return  $fecha_formateada; // Esto imprimirá "2023-11-09"
            } else {
                echo "La fecha no es válida";
            }
        } else {
            echo "La fecha no tiene el formato correcto";
        }
    }
}
