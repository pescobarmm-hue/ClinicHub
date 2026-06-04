<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->dateTime('fecha');

            //Relaciones
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');

            $table->string('gravedad'); //Leve, Moderado, Severo
            $table->text('recomendaciones');
            $table->string('tipo_diagnostico');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
