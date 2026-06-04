<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('motivo');

            //Clases Foráneas
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');

            $table->string('estado')->default('Programada'); //Programada, completada, cancelada
            $table->text('observaciones')->nullable();
            $table->string('sala');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
