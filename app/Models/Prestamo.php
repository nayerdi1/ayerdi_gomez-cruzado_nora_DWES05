<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prestamo extends Model
{
    use HasFactory;
    protected $table = 'prestamos';

    protected $primaryKey = 'id';

    public $timestamps = false; 
    protected $fillable = ['libro_id', 'usuario_id', 'fecha_inicio','fecha_devolucion'];
}
