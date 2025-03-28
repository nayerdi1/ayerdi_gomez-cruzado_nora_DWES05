<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\DTO\LibroDTO;
use Illuminate\Support\Facades\DB;

class Libros_controller extends Controller
{
    // Devuelve todos los libros de la BD
    public function getLibros(){
        $libros = Libro::all();

        foreach($libros as $libro){
            $librosDTO[] = $this->nuevoLibroDTO($libro);
        }
        return response()->json($librosDTO);
    }

    // Devuelve un libro de la BD
    public function getLibroId($id){
        $libro = Libro::where('id', $id)->first();
        $libroDTO = $this->nuevoLibroDTO($libro);
        return response()->json($libroDTO);
    }

    // Crea un nuevo objeto de la clase LibroDTO
    public function nuevoLibroDTO($libro){
        return new LibroDTO(
            $libro->titulo,
            $libro->autor,
            $libro->genero,
            $libro->disponible
        );
    }
}
