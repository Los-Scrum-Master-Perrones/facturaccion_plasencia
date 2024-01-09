<?php

namespace App\Imports;

use App\Http\Static_Vars;
use App\Models\CatalogoProducto;
use App\Models\CatalogoProductoDetalle;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class pedidoImportCatalogoHoja implements ToModel
{

    public $item;
    public $contar = 0;
    public $orden;
    public $categoria;

    use Importable;

    function __construct($nom)
    {
        $this->categoria = $nom;
    }

    public function model(array $row)
    {
        $pedio = null;

        if ($row[0] == null) {
            if ($row[2] == null) {
                Static_Vars::Setitems("0");
                return null;
            } else {
                if ($row[1] == null) {
                    return null;
                } else {
                    if (Static_Vars::getitems() == "0") {
                        return null;
                    } else {
                        CatalogoProductoDetalle::updateOrCreate([
                            'id_catalogo_producto' => CatalogoProducto::firstOrCreate(
                                [
                                    'item' => Static_Vars::getitems(),
                                ],
                                [
                                    'descripcion' => trim($row[2]),
                                    'unidades' => $row[1] ?? 0,
                                    'categoria' => 0
                                ]
                            )->id,
                            'descripcion' => trim($row[2]),
                        ], [
                            'activo' => 1,
                            'cantidad' => $row[1],
                        ]);
                    }
                }
            }
        } else {
            if (is_numeric($row[0])) {
                if ($row[2] == null) {
                    Static_Vars::Setitems("0");
                    return null;
                } else {
                    Static_Vars::Setitems($row[0]);
                    CatalogoProducto::firstOrCreate(
                        [
                            'item' => Static_Vars::getitems(),
                        ],
                        [
                            'descripcion' => trim($row[2]),
                            'unidades' => $row[1] ?? 0,
                            'categoria' => 0
                        ]
                    );
                    return null;
                }
            } else {
                return null;
            }
        }

        return null;
    }
}
