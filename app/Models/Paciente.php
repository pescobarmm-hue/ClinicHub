<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = "pacientes";

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'direccion',
        'tipo_sangre',
    ];

    //Relaciones
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function diagnosticos()
    {
        return $this->hasMany(Diagnostico::class);
    }

}
