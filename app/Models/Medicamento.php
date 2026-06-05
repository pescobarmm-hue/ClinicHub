<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre',
        'dosis',
        'frecuencia',
        'duracion',
        'tratamiento_id',
        'proveedor',
        'efectos_secundarios'
    ];

    // Relaciones
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'tratamiendo_id');
    }
}
