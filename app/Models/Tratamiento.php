<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = 'tratamientos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion',
        'diagnostico_id',
        'medico_id',
        'estado',
        'frecuencia_administracion'
    ];

    // Relaciones
    public function diagnostico()
    {
        return $this->belongsTo(Diagnostico::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class, 'tratamiendo_id');
    }
}