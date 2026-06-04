<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'diagnosticos';

    protected $fillable = [
        'descripcion',
        'fecha',
        'paciente_id',
        'medico_id',
        'gravedad',
        'recomendaciones',
        'tipo_diagnostico'
    ];

    // Relaciones
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }
}