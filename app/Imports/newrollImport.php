<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Http\Static_Vars;
use App\Models\pedido;
use DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class newrollImport implements ToModel
{

    public $item;
    public $contar = 0;
    public $orden;

    use Importable;
    public function model(array $row)
    {

      

        if($row[4] == null && $row[5] ==null || $row[0] == null && $row[1] ==null){
                    
                   
                $pedio = null;
                    

        }else{  
                    if($row[4] != null && $row[0] != null && $row[2] != null && $row[1] == null && $row[3] == null){
                        Static_Vars::Setordenes($row[5]);
                        Static_Vars::Setitems($row[0]);
                        Static_Vars::Setconteos(DB::select('call contar_detalles_productos(:item)', ['item'=> Static_Vars::getitems()])[0]->detalles);
                        Static_Vars::Setpaquetes($row[4]);
                        $pedio = null;
                       
                    } else{ 
                        
                           
                            if( Static_Vars::getconteos()>0 && $row[0] == null  && $row[1] != null && $row[2] != null && $row[3] != null && $row[4] == null && $row[5] = null){
            
                                $pedio = new pedido([
                                    'item' =>  Static_Vars::getitems(),
                                    'cant_paquetes' => $row[1],
                                    'unidades' => (int)(Static_Vars::getpaquetes() * $row[1]),
                                    'numero_orden' =>Static_Vars::getordenes(),
                                    'categoria' => "1",
                                    ]);

                                $ount = Static_Vars::getconteos();
                                $ount--;
                               Static_Vars::Setconteos($ount);

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
                                    
                             }
                         }
                    }
        
                    if(Static_Vars::getconteos()>0 && $row[0] == null  && $row[1] != null && $row[2] != null  && $row[4] == null){
            
                        $pedio = new pedido([
                            'item' =>  Static_Vars::getitems(),
                            'cant_paquetes' => $row[1],
                            'unidades' =>$row[3]==null? 0 : ((intval(Static_Vars::getpaquetes()) )* (intval($row[1]))),
                           
                            'numero_orden' =>Static_Vars::getordenes(),
                            'categoria' => "1",
                            ]);
                            $ount = Static_Vars::getconteos();
                            $ount--;
                           Static_Vars::Setconteos($ount);
                    }
        
            	return $pedio;
    }
}



