<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Users extends Controller
{
    function index()
    {
        $users = DB::table('users')->get();
    	return view('users')->with('users',$users);
    }


    
    public function update(Request $request){        
        $usuario = \DB::select('call actualizar_usuarios(:id_usuario, :codigo,:nombre_usuario)',[
        'id_usuario' => (int)$request->id_usuario,
        'codigo' => (int)$request->txt_codigo,
        'nombre_usuario' => (string)$request->txt_nombre_completo
        ]);              

        $administradores =\DB::select('call mostrar_usuarios',[]);
        return view('usuarios')->with('administradores',$administradores);
    }

    public function update_contrasenia(Request $request){     
        $usuario = \DB::select('call actualizar_contrasenia(:id_usuario, :correo,:contrasenia)', [
        'id_usuario' => $request->txt_id_usuario,
        'correo' => $request->emailcontra,
        'contrasenia' => Hash::make($request->confirmacion_contraseniaA)
        ]);     
        $administradores =\DB::select('call mostrar_usuarios',[]);
        return view('usuarios')->with('administradores',$administradores); 
    }

    public function destroy(Request $request){
        $usuario = \DB::select('call eliminar_usuario(:id_usuario)',        [
            'id_usuario' => (int)$request->id_usuarioE
         ]);
          $administradores =\DB::select('call mostrar_usuarios',[]);
          return view('usuarios')->with('administradores',$administradores);
    }
}
