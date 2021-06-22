<?php

namespace App\Http;

use Illuminate\Support\Arr;

class Static_Vars_Pendiente{

   public static $cat1 = "";
   public static $cat2 = "";
   public static $cat3 = "";
   public static $cat4 = "";
      
    public static $presentacion = "";
    public static $item = "";
    public static $orden = "";

    public static $hon = "";
    public static $marca = "";
    public static $vitola = "";
    
    public static $nombre = "";
    public static $capa = "";
    public static $empaque = "";
    public static $mes = "";


 
   // metodo get y set
   public static function Setcat1s($cat1) {
      self::$cat1 = $cat1;
   }

   public static function getcat1s() {
       return self::$cat1;
    }
 
    // metodo get y set
     public static function Setcat2s($cat2) {
        self::$cat2 = $cat2;
     }
 
     public static function getcat2s() {
         return self::$cat2;
      }
 
      // metodo get y set
       public static function Setcat3s($cat3) {
          self::$cat3 = $cat3;
       }
   
       public static function getcat3s() {
           return self::$cat3;
        }
 
        // metodo get y set
         public static function Setcat4s($cat4) {
            self::$cat4 = $cat4;
         }
     
         public static function getcat4s() {
             return self::$cat4;
          }







 
   // metodo get y set
    public static function Setpresentacions($presentacion) {
       self::$presentacion = $presentacion;
    }

    public static function getpresentacions() {
        return self::$presentacion;
     }
 
     // metodo get y set
      public static function Setitems($item) {
         self::$item = $item;
      }
  
      public static function getitems() {
          return self::$item;
       }
 
       // metodo get y set
        public static function Setordenes($orden) {
           self::$orden = $orden;
        }
    
        public static function getordenes() {
            return self::$orden;
         }
 
         // metodo get y set
          public static function Sethons($hon) {
             self::$hon = $hon;
          }
      
          public static function gethons() {
              return self::$hon;
           }
 
           // metodo get y set
            public static function Setmarcas($marca) {
               self::$marca = $marca;
            }
        
            public static function getmarcas() {
                return self::$marca;
             }
 
             // metodo get y set
              public static function Setvitolas($vitola) {
                 self::$vitola = $vitola;
              }
          
              public static function getvitolas() {
                  return self::$vitola;
               }
 
               // metodo get y set
                public static function Setnombres($nombre) {
                   self::$nombre = $nombre;
                }
            
                public static function getnombres() {
                    return self::$nombre;
                 }
 
                 // metodo get y set
                  public static function Setcapas($capa) {
                     self::$capa = $capa;
                  }
              
                  public static function getcapas() {
                      return self::$capa;
                   }
 
                   // metodo get y set
                    public static function Setempaques($empaque) {
                       self::$empaque = $empaque;
                    }
                
                    public static function getempaques() {
                        return self::$empaque;
                     }
 
                     // metodo get y set
                      public static function Setmeses($mes) {
                         self::$mes = $mes;
                      }
                  
                      public static function getmeses() {
                          return self::$mes;
                       }


}

?>