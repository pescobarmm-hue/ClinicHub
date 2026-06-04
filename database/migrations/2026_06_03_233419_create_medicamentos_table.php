<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dosis');
            $table->string('frecuencia');
            $table->string('duracion');

            //Relaciones
            $table->foreignId('tratamiendo_id')->constrained('tratamientos')->onDelete('cascade');

            $table->string('proveedor')->nullable();
            $table->text('efectos_secundarios')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
