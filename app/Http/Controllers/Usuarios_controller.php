<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class Usuarios_controller extends Controller
{
    // Comprueba si el usuario tiene la sesion iniciada
    // Inicia la sesion del usuario
    public function login(Request $request){
        $usuario = Usuario::where('usuario', $request->usuario)->first();
        
        if(!$usuario->sesion_iniciada){
            if($usuario->usuario == $request->usuario && $usuario->contrasenia == $request->password){
                $usuario->update([
                    'sesion_iniciada' => true
                ]);  
                return response()->json(['Mensaje' => 'Ongi etorri, '. $usuario->nombre], 200);          
            } else{
                return response()->json(['error' => 'Usuario o contraseña incorrectos'], 401);
            }
        } else{
            return response()->json(['error' => 'Este usuario ya tiene la sesion iniciada'], 409);
        }                   
    }

    // Comprueba la sesion del usuario
    // Cierra la sesion del usuario
    public function salir(Request $request){
        $usuario = Usuario::where('usuario', $request->usuario)->first();
      
        if($usuario->sesion_iniciada){
            $usuario->update([
                'sesion_iniciada' => false
            ]);
            return response()->json(['Mensaje' => 'Gero arte, '. $usuario->nombre], 200);          
        } else{
            return response()->json(['error' => 'Este usuario no tiene la sesion iniciada'], 409);
        }           
    }      
}
