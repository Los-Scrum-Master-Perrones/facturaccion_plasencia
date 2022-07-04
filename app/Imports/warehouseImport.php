<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use App\Http\Static_Vars;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\pedido;
use Maatwebsite\Excel\Concerns\ToModel;
class warehouseImport implements ToModel
{
    public $item;
    public $contar = 0;
    public $orden;
    use Importable;
    public function model(array $row)
    {


        if($row[4] == null && $row[5] ==null || $row[0] == null && $row[1] ==null  || $row[0] == "RP ITEM#"){
                   
            $pedio = null;
                

    }else{  
                if($row[4] != null && $row[0] != null && $row[2] != null && $row[1] == null && $row[3] == null){
                    Static_Vars::Setordenes($row[5]);
                    Static_Vars::Setitems($row[0]);
                    Static_Vars::Setconteos(DB::select('call contar_detalles_productos(:item)', ['item'=> Static_Vars::getitems()])[0]->detalles);
                    Static_Vars::Setpaquetes($row[4]);
                    if( Static_Vars::getconteos() == 0){
                        if(count(DB::select('select * from item_faltantes where item = ? and categoria = ?', [$row[0], 'WAREHOUSE']))==0){
                         DB::insert('insert into item_faltantes(categoria, item, detalles) values (?,?,?)', [ 'WAREHOUSE', $row[0] , $row[2]]);
                        }
                    }
                   
                    $pedio = null;
                   
                } else{ 
                    
                       
                        if( Static_Vars::getconteos()>0 && $row[0] == null  && $row[1] != null && $row[2] != null && $row[3] != null && $row[4] == null && $row[5] = null){
        
                            $pedio = new pedido([
                                'item' =>  Static_Vars::getitems(),
                                'cant_paquetes' => $row[1],
                                'unidades' => (int)(Static_Vars::getpaquetes()),
                                'numero_orden' =>Static_Vars::getordenes(),
                                'categoria' => "4",
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
                                                    'categoria' => "4",
                                                ]);
                                                        }


                                                        if(!isset(DB::select("select * from clase_productos where item like concat('%',?,'%')", [strval($row[0])])[0])){
                                                            if(count(DB::select('select * from item_faltantes where item = ? and categoria = ?', [$row[0], 'WAREHOUSE']))==0){
                                                                DB::insert('insert into item_faltantes(categoria, item, detalles) values (?,?,?)', [ 'WAREHOUSE', $row[0] , $row[2]]);
                                                               }
                                                        }
                                    }
                                
                         }
                     }
                }
    
                if(Static_Vars::getconteos()>0 && $row[0] == null  && $row[1] != null && $row[2] != null  && $row[4] == null){
        
                    $pedio = new pedido([
                        'item' =>  Static_Vars::getitems(),
                        'cant_paquetes' => $row[1],
                        'unidades' =>$row[3]==null? 0 : ((intval(Static_Vars::getpaquetes()) )),
                       
                        'numero_orden' =>Static_Vars::getordenes(),
                        'categoria' => "4",
                        ]);
                        $ount = Static_Vars::getconteos();
                        $ount--;
                       Static_Vars::Setconteos($ount);
                }



        // if(($row[4] == null && $row[5] ==null) ||$row[0] == "RP ITEM#" || $row[0] == null){
        //             $pedio = null;
        //         }else{
        //             $pedio =  new pedido([
        //                 'item' => $row[0],
        //                 'cant_paquetes' => $row[1],
        //                 'unidades' => $row[4],
        //                 'numero_orden' => $row[5],
        //                 'categoria' => "4",
        //             ]);
        //         }
        
            	return $pedio;
    }
}
