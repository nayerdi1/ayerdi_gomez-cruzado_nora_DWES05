<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Libro;
use Illuminate\Support\Facades\DB;

class Admin_controller extends Controller
{
    // Comprueba que el usuario tenga la sesion iniciada y sea administrador
    // Añade un nuevo libro a la BD
    function aniadirLibro(Request $request) {

        $usuario = DB::table('usuarios')->where('usuario', $request->usuario)->first();
       
        if ($usuario->sesion_iniciada){
           if($usuario->rol == "administrador"){
                Libro::create($request->only(['titulo', 'autor', 'genero', 'disponible']));
                return response()->json(['Exito' => 'El libro se ha añadido correctamente'], 200);                
            } else {
                return response()->json(['error' => 'no tiene permiso de administrador'], 401);
            }        
        }else {
            return response()->json(['error' => 'Debe iniciar sesion para ver el catalogo'], 401);
        }

    }

    // Comprueba que el usuario tenga la sesion iniciada y sea administrador
    // Modifica libro de la BD
    function modificarLibro($id, Request $request) {
        $usuario = DB::table('usuarios')->where('usuario', $request->usuario)->first();
        if ($usuario->sesion_iniciada){
            if($usuario->rol == "administrador"){
                $libro = Libro::find($id);
                if(!$libro){
                    return response()->json(['error' => 'El libro no existe'], 404);
                }
                $libro->update([
                        'titulo' => $request->titulo,
                        'autor' => $request->autor,
                        'genero' => $request->genero,
                        'disponible' => $request->disponible
                ]);
                return response()->json(['Exito' => 'El libro se ha modificado correctamente'], 200);

            }else {
                return response()->json(['error' => 'no tiene permiso de administrador'], 401);
            }
        }else {
            return response()->json(['error' => 'Debe iniciar sesion para ver el catalogo'], 401);
        }
    }

    // Comprueba que el usuario tenga la sesion iniciada y sea administrador
    // Borra libro a la BD
    function borrarLibro($id, Request $request) {
        $usuario = DB::table('usuarios')->where('usuario', $request->usuario)->first();
        if ($usuario->sesion_iniciada){
            if($usuario->rol == "administrador"){ 
                $libro = Libro::find($id);
                if(!$libro){
                    return response()->json(['error' => 'El libro no existe'], 404);
                }
                $libro->delete();    
                return response()->json(['204' => 'El libro se ha borrado correctamente'], 200);                
            
            }else {
                return response()->json(['error' => 'no tiene permiso de administrador'], 401);
            }
        }else {
            return response()->json(['error' => 'Debe iniciar sesion para ver el catalogo'], 401);
        }
    }
 
}
