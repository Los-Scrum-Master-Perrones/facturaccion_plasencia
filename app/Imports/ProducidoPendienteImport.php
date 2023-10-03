<?php

namespace App\Imports;

use App\Models\capa_producto;
use App\Models\marca_producto;
use App\Models\nombre_producto;
use App\Models\Produccion;
use App\Models\ProduccionOrden;
use App\Models\ProduccionPendiente;
use App\Models\ProduccionPendienteSalida;
use App\Models\vitola_producto;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProducidoPendienteImport implements ToCollection, WithCalculatedFormulas
{

    use Importable;
    public function collection(Collection $rows)
    {
        $orden = '';
        $fecha = '';
        foreach ($rows as $key => $row) {

            if ($row[0] === 'Orden Sistema') {
                continue;
            }

            if (is_null($row[0])) {
                continue;
            }

            $marca = marca_producto::firstOrCreate(
                ['marca' => $row[4]],
                ['marca' => $row[4]]
            );
            $nombre = nombre_producto::firstOrCreate(
                ['nombre' => $row[5]],
                ['nombre' => $row[5]]
            );
            $vitola = vitola_producto::firstOrCreate(
                ['vitola' => $row[6]],
                ['vitola' => $row[6]]
            );
            $capa = capa_producto::firstOrCreate(
                ['capa' => $row[7]],
                ['capa' => $row[7]]
            );


            $producto = Produccion::updateOrCreate(
                [
                    'id_marca' => $marca->id_marca,
                    'id_nombre' => $nombre->id_nombre,
                    'id_vitola' => $vitola->id_vitola,
                    'id_capa' => $capa->id_capa
                ],
                [
                    'presentacion' => $row[3],
                ]
            );


            $numericDate = $row[1]-2; // Tu valor numérico de días
            $startDate = strtotime('1900-01-01'); // Fecha de referencia de Excel (1 de enero de 1900)
            $convertedDate = date('Y-m-d', strtotime("+$numericDate days", $startDate));

            $producir = ProduccionPendiente::firstOrCreate(
                [
                    'orden_sistema' => $row[0],
                    'id_producto' =>  $producto->id
                ],
                [
                    'fecha_recibido' => $convertedDate,
                    'cantidad' => $row[8],
                ]
            );


            foreach ($row as $key => $value) {
                if ($key >= 9 && $key < 51) {

                    if (!is_null($value)) {

                        if (explode(" ", $rows[0][$key])[0] == 'Moroceli') {

                            $elementos = explode('/', explode(" ", $rows[0][$key])[1]);

                            $fecha = '';
                            if (count($elementos) === 3) {
                                $anio = $elementos[2];
                                $mes = $elementos[1];
                                $dia = $elementos[0];

                                // Asegurarse de que el mes y el día tengan dos dígitos
                                $mes = str_pad($mes, 2, '0', STR_PAD_LEFT);
                                $dia = str_pad($dia, 2, '0', STR_PAD_LEFT);

                                // Formatear la nueva cadena en 'año mes y día'
                                $fecha_formateada = "$anio-$mes-$dia";
                                $fecha = $fecha_formateada;  // Esto imprimirá '2023 08 09'
                            } else {
                                echo "Formato de fecha incorrecto.";
                            }



                            $producir = ProduccionPendiente::firstOrCreate(
                                [
                                    'orden_sistema' => $row[0],
                                    'id_producto' =>  $producto->id
                                ],
                                [
                                    'orden_sistema' => $row[0],
                                    'id_producto' =>  $producto->id
                                ]
                            );
                            $salida =  ProduccionPendienteSalida::Create(
                                [
                                    'id_produccion_pendiente' => $producir->id,
                                    'destino' => explode(" ", $rows[0][$key])[0],
                                    'fecha_salida' => $fecha,
                                    'cantidad' => $value,
                                ]
                            );

                            continue;
                        }
                        echo $rows[0][$key] . '<br>';

                        $numericDate = $rows[0][$key] - 2; // Tu valor numérico de días
                        $startDate = strtotime('1900-01-01'); // Fecha de referencia de Excel (1 de enero de 1900)
                        $convertedDate = date('Y-m-d', strtotime("+$numericDate days", $startDate));


                        $dato =  ProduccionOrden::Create(
                            [
                                'id_producto' => $producto->id,
                                'orden' => $row[0],
                                'cantidad' => $value,
                                'fecha' => $convertedDate,
                            ]
                        );
                    }
                }
            }
        }
    }
    // use Importable;
    // public function collection(Collection $rows)
    // {
    //     $orden = '';
    //     $fecha = '';
    //     foreach ($rows as $key => $row) {

    //         if ($row[0] === 'Orden Sistema') {
    //             continue;
    //         }

    //         if (is_null($row[0])) {
    //             continue;
    //         }

    //         $marca = marca_producto::firstOrCreate(
    //             ['marca' => $row[4]],
    //             ['marca' => $row[4]]
    //         );
    //         $nombre = nombre_producto::firstOrCreate(
    //             ['nombre' => $row[5]],
    //             ['nombre' => $row[5]]
    //         );
    //         $vitola = vitola_producto::firstOrCreate(
    //             ['vitola' => $row[6]],
    //             ['vitola' => $row[6]]
    //         );
    //         $capa = capa_producto::firstOrCreate(
    //             ['capa' => $row[7]],
    //             ['capa' => $row[7]]
    //         );

    //         if ($row[5] == "(en blanco)") {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2],
    //                     'existencia' => 0,
    //                     'precio_bonchero' => '1.1452',
    //                     'precio_rolero' => '1.1452'
    //                 ]
    //             );
    //         } else if ($row[4] == "RP Rejectes #1") {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2],
    //                     'existencia' => 0,
    //                     'precio_bonchero' => '1.0619',
    //                     'precio_rolero' => '1.0619'
    //                 ]
    //             );
    //         } else if ($row[4] == "The Edge Seleccion" && $row[5] == 'Pyramid') {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2],
    //                     'existencia' => 0,
    //                     'precio_bonchero' => '1.0619',
    //                     'precio_rolero' => '1.0619'
    //                 ]
    //             );
    //         } else if ($row[4] == "Havana Connections") {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2],
    //                     'existencia' => 0,
    //                     'precio_bonchero' => '0.9834',
    //                     'precio_rolero' => '0.9834'
    //                 ]
    //             );
    //         } else if ($row[4] == "Junior Sungrown") {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2],
    //                     'existencia' => 0,
    //                     'precio_bonchero' => '0.799',
    //                     'precio_rolero' => '0.799'
    //                 ]
    //             );
    //         } else {
    //             $producto = Produccion::firstOrCreate(
    //                 [
    //                     'id_marca' => $marca->id_marca,
    //                     'id_nombre' => $nombre->id_nombre,
    //                     'id_vitola' => $vitola->id_vitola,
    //                     'id_capa' => $capa->id_capa
    //                 ],
    //                 [
    //                     'codigo' => $row[2]
    //                 ]
    //             );
    //         }

    //         $numericDate = $row[1]-2; // Tu valor numérico de días
    //         $startDate = strtotime('1900-01-01'); // Fecha de referencia de Excel (1 de enero de 1900)
    //         $convertedDate = date('Y-m-d', strtotime("+$numericDate days", $startDate));

    //         $producir = ProduccionPendiente::firstOrCreate(
    //             [
    //                 'orden_sistema' => $row[0],
    //                 'id_producto' =>  $producto->id
    //             ],
    //             [
    //                 'fecha_recibido' => $convertedDate,
    //                 'cantidad' => $row[8],
    //             ]
    //         );
    //     }
    // }
}
