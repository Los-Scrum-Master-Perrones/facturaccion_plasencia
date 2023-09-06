<?php

namespace App\Http;

use Illuminate\Support\Arr;

class Static_Vars{

    public static $item = "";
    public static $orden = "";
    public static $conteo = 0;
    public static $paquete = "";

    public static $items_inexistentes = [];

   public static function agregar_arreglo($item){
      self::$items_inexistentes = Arr::add(self::$items_inexistentes, 'item', $item);
   }

   public static function traer_arreglo(){
      return  self::$items_inexistentes;
   }


    public static function Setitems($item) {
       self::$item = $item;
    }

    public static function Setordenes($orden) {
        self::$orden = $orden;
    }

    public static function Setconteos($conteo) {
        self::$conteo = $conteo;
    }

    public static function Setpaquetes($paquete) {
        self::$paquete = $paquete;
    }

    public static function getitems() {
        return self::$item;
     }

     public static function getordenes() {
        return self::$orden;
     }

     public static function getconteos() {
        return self::$conteo;
     }

     public static function getpaquetes() {
        return self::$paquete;
     }
}

?>
