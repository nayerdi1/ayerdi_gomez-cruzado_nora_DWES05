<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Prestamo;
use App\Models\Libro;
use Illuminate\Support\Facades\DB;

class Prestamos_controller extends Controller
{
    // Crea un prestamo y lo añade en la BD
    // Cambia la disponibilidad del libro
    public function prestamo(Request $request){
        $usuario = Usuario::where('usuario', $request->usuario)->first();
              
        if($this->sesionIniciada($usuario)){
            $libro = Libro::find($request->libro_id);
            if (!$libro) {
                return respuestaJson(['error' => 'El libro no existe'], 404);
            }
            if($libro->disponible) {
                $prestamoCreado = Prestamo::create([
                    'libro_id' => $libro->id,
                    'usuario_id' => $usuario->id,
                    'fecha_inicio' => date('Y-m-d'),
                    'fecha_devolucion' => null
                ]);  
                $libro->update([
                    'disponible'=> false
                ]);
                return response()->json(['Exito' => 'El prestamo se ha creado correctamente. El numero de prestamo es '. $prestamoCreado->id], 200);  
            } else{
                return response()->json(['error' => 'El libro no esta disponible'], 423);
            }
        } else{
            return response()->json(['error' => 'Debe iniciar sesion para pedir el prestamo'], 401);
        }
    }

    // Modifica el prestamo añadiendole una fecha de devolucion
    // Cambia la disponibilidad del libro
    function devolucion($id, Request $request) {
        $usuario = Usuario::where('usuario', $request->usuario)->first();
        
        if($this->sesionIniciada($usuario)){
            $prestamo = Prestamo::find($id);
            if(!$prestamo){
                return response()->json(['error' => 'El prestamo no existe'], 404); 
            }
            if($prestamo->fecha_devolucion != null){
                return response()->json(['error' => 'Esta devolucion ya se había registrado'], 400);
            }
            $libro = Libro::find($prestamo->libro_id);
            $usuarioPrestamo = Usuario::find($prestamo->usuario_id);
            if($usuario->id == $usuarioPrestamo->id){
                if($request->accion === "devolver libro") {
                    $prestamo->update([
                        'fecha_devolucion' => date('Y-m-d')
                    ]); 
                    $libro->update([
                        'disponible'=> true
                    ]);                     
                    return response()->json(['mensaje' => 'La devolucion se ha registrado'], 200);                                          
                }
            } else{
                return response()->json(['error' => 'Este usuario no tenía prestado ese libro'], 400);
            }       
        }else {
            return response()->json(['error' => 'Debe iniciar sesion para realizar la devolucion'], 401);
        }
    }

    public function sesionIniciada($usuario){
        return $usuario->sesion_iniciada;
    }
}
