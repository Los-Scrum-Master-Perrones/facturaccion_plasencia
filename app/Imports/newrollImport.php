<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\pedido;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
class newrollImport implements ToModel
{
    use Importable;
    public function model(array $row)
    {
        if($row[4] == null && $row[5] ==null){
                    $pedio = null;
                }else{ 
                    if($row[0] == null && $row[1] ==null){
                    $pedio = null;
                    }else{

                    if($row[0] == "Corojo" || $row[0] == "Maduro" || $row[0] == "Sumatra" || $row[0] == "Candela" || 
                    $row[0] == "Connecticut" || $row[0] == "Habano-col" || $row[0] == "HABANO" || $row[0] == "Cameroon" ||
                    $row[0] == "Pennsylvaina" ||$row[0] == "Corojo/Maduro" || $row[0] == "TOTAL" || $row[0] == "RP Item#"  
                    || $row[0] == "RP ITEM#" || $row[0] == null ){
                        $pedio = null;
                    }else{
                        $pro_existe = pedido::where('item',$row[0])->count();
                        $orden_existe = pedido::where('item',$row[5])->count();
                        if($pro_existe>0 &&$orden_existe>0){
                            $pedio = null;

                            }else{

                    $pedio =  new pedido([
                        'item' => $row[0],
                        'cant_paquetes' => $row[1],
                        'unidades' => $row[4],
                        'numero_orden' => $row[5],
                        'categoria' => "1",
                    ]);
                            }
                }
                   
                }}
        
            	return $pedio;
    }
}



