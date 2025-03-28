<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Libros_controller;


/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');ç*/

Route::get('libros', 'App\Http\Controllers\Libros_controller@getLibros')->name('libros_ruta');

Route::get('libros/{id}', 'App\Http\Controllers\Libros_controller@getLibroId')->name('libroId_ruta');

Route::post('login', 'App\Http\Controllers\Usuarios_controller@login')->name('login_ruta');

Route::post('salir', 'App\Http\Controllers\Usuarios_controller@salir')->name('salir_ruta');

Route::post('prestamo', 'App\Http\Controllers\Prestamos_controller@prestamo')->name('prestamo_ruta');

Route::put('prestamo/{id}', 'App\Http\Controllers\Prestamos_controller@devolucion')->name('devolucion_ruta');

Route::post('admin/create', 'App\Http\Controllers\Admin_controller@aniadirLibro')->name('create_ruta');

Route::put('admin/update/{id}', 'App\Http\Controllers\Admin_controller@modificarLibro')->name('update_ruta');

Route::delete('admin/delete/{id}', 'App\Http\Controllers\Admin_controller@borrarLibro')->name('delete_ruta');

Route::fallback(function () {
    return response()->json([
        'error' => 'Ruta no encontrada. Verifica la URL e inténtalo de nuevo.'
    ], 404);
});