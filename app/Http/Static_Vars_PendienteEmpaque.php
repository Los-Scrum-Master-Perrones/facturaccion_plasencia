<?php

namespace App\Http;

use Illuminate\Support\Arr;

class Static_Vars_PendienteEmpaque{

   public static $e_cat1 = "";
   public static $e_cat2 = "";
   public static $e_cat3 = "";
   public static $e_cat4 = "";
      
    public static $e_item = "";
    public static $e_orden = "";
    public static $e_hon = "";
    public static $e_marca = "";

    public static $e_vitola = "";    
    public static $e_nombre = "";
    public static $e_capa = "";
    public static $e_empaque = "";
    public static $e_mes = "";


 
   // metodo get y set
   public static function Sete_cat1s($e_cat1) {
      self::$e_cat1 = $e_cat1;
   }

   public static function gete_cat1s() {
       return self::$e_cat1;
    }
 
    // metodo get y set
     public static function Sete_cat2s($e_cat2) {
        self::$e_cat2 = $e_cat2;
     }
 
     public static function gete_cat2s() {
         return self::$e_cat2;
      }
 
      // metodo get y set
       public static function Sete_cat3s($e_cat3) {
          self::$e_cat3 = $e_cat3;
       }
   
       public static function gete_cat3s() {
           return self::$e_cat3;
        }
 
        // metodo get y set
         public static function Sete_cat4s($e_cat4) {
            self::$e_cat4 = $e_cat4;
         }
     
         public static function gete_cat4s() {
             return self::$e_cat4;
          }







 
   // metodo get y set
    public static function Sete_presentacions($e_presentacion) {
       self::$e_presentacion = $e_presentacion;
    }

    public static function gete_presentacions() {
        return self::$e_presentacion;
     }
 
     // metodo get y set
      public static function Sete_items($e_item) {
         self::$e_item = $e_item;
      }
  
      public static function gete_items() {
          return self::$e_item;
       }
 
       // metodo get y set
        public static function Sete_ordenes($e_orden) {
           self::$e_orden = $e_orden;
        }
    
        public static function gete_ordenes() {
            return self::$e_orden;
         }
 
         // metodo get y set
          public static function Sete_hons($e_hon) {
             self::$e_hon = $e_hon;
          }
      
          public static function gete_hons() {
              return self::$e_hon;
           }
 
           // metodo get y set
            public static function Sete_marcas($e_marca) {
               self::$e_marca = $e_marca;
            }
        
            public static function gete_marcas() {
                return self::$e_marca;
             }
 
             // metodo get y set
              public static function Sete_vitolas($e_vitola) {
                 self::$e_vitola = $e_vitola;
              }
          
              public static function gete_vitolas() {
                  return self::$e_vitola;
               }
 
               // metodo get y set
                public static function Sete_nombres($e_nombre) {
                   self::$e_nombre = $e_nombre;
                }
            
                public static function gete_nombres() {
                    return self::$e_nombre;
                 }
 
                 // metodo get y set
                  public static function Sete_capas($e_capa) {
                     self::$e_capa = $e_capa;
                  }
              
                  public static function gete_capas() {
                      return self::$e_capa;
                   }
 
                   // metodo get y set
                    public static function Sete_empaques($e_empaque) {
                       self::$e_empaque = $e_empaque;
                    }
                
                    public static function gete_empaques() {
                        return self::$e_empaque;
                     }
 
                     // metodo get y set
                      public static function Sete_meses($e_mes) {
                         self::$e_mes = $e_mes;
                      }
                  
                      public static function gete_meses() {
                          return self::$e_mes;
                       }


}

?>