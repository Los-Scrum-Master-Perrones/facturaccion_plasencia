<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class Users extends Controller
{
    function index()
    {
        $users = DB::table('users')->get();
    	return view('usuarios')->with('users',$users);
    }


    
    public function update(Request $request){        
        $usuario = \DB::select('call actualizar_usuarios(:id_usuario, :codigo,:nombre_usuario,:rol)',[
        'id_usuario' => (int)$request->id_usuario,
        'codigo' => (int)$request->txt_codigo,
        'nombre_usuario' => (string)$request->txt_nombre_completo,
        'rol' => $request->txt_rol
        ]);              

        $users = DB::table('users')->get();
    	return view('usuarios')->with('users',$users);
    }

    public function update_contrasenia(Request $request){     
        $usuario = \DB::select('call actualizar_contrasenia(:id_usuario, :correo,:contrasenia)', [
        'id_usuario' => $request->txt_id_usuario,
        'correo' => $request->emailcontra,
        'contrasenia' => Hash::make($request->confirmacion_contraseniaA)
        ]);     
        $users = DB::table('users')->get();
    	return view('usuarios')->with('users',$users);
    }

    public function destroy(Request $request){
        $usuario = \DB::select('call eliminar_usuario(:id_usuario)',        [
            'id_usuario' => (int)$request->id_usuarioE
         ]);
         $users = DB::table('users')->get();
         return view('usuarios')->with('users',$users);
    }
}
