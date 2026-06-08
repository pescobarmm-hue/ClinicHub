<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Cita;
use App\Models\Diagnostico;
use App\Models\Tratamiento;
use App\Models\Medicamento;

/*
|--------------------------------------------------------------------------
| API Routes para el Dashboard
| Protegidas con sesión web (mismo auth que el resto de la app)
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth'])->group(function () {

    // ── PACIENTES ─────────────────────────────────────────────────
    Route::get('/pacientes', function () {
        return Paciente::all()->map(fn($p) => [
            'id'               => $p->id,
            'nombre'           => $p->nombre,
            'apellido'         => $p->apellido,
            'fecha_nacimiento' => $p->fecha_nacimiento?->format('Y-m-d'),
            'genero'           => $p->genero,
            'telefono'         => $p->telefono,
            'tipo_sangre'      => $p->tipo_sangre,
            'direccion'        => $p->direccion,
        ]);
    });

    Route::post('/pacientes', function (Request $request) {
        $data = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'genero'           => 'nullable|string',
            'telefono'         => 'nullable|string|max:20',
            'tipo_sangre'      => 'nullable|string',
            'direccion'        => 'nullable|string',
        ]);
        return response()->json(Paciente::create($data), 201);
    });

    Route::put('/pacientes/{id}', function (Request $request, $id) {
        $p = Paciente::findOrFail($id);
        $p->update($request->only(['nombre','apellido','fecha_nacimiento','genero','telefono','tipo_sangre','direccion']));
        return response()->json($p);
    });

    Route::delete('/pacientes/{id}', function ($id) {
        Paciente::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    });

    // ── MÉDICOS ───────────────────────────────────────────────────
    Route::get('/medicos', function () {
        return Medico::all()->map(fn($m) => [
            'id'               => $m->id,
            'nombre'           => $m->nombre,
            'apellido'         => $m->apellido,
            'especialidad'     => $m->especialidad,
            'telefono'         => $m->telefono,
            'email'            => $m->email,
            'licencia'         => $m->licencia,
            'años_experiencia' => $m->años_experiencia ?? $m->anios_experiencia,
        ]);
    });

    Route::post('/medicos', function (Request $request) {
        $m = Medico::create($request->only(['nombre','apellido','especialidad','telefono','email','licencia','años_experiencia','anios_experiencia']));
        return response()->json($m, 201);
    });

    Route::put('/medicos/{id}', function (Request $request, $id) {
        $m = Medico::findOrFail($id);
        $m->update($request->only(['nombre','apellido','especialidad','telefono','email','licencia','años_experiencia','anios_experiencia']));
        return response()->json($m);
    });

    Route::delete('/medicos/{id}', function ($id) {
        Medico::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    });

    // ── CITAS ─────────────────────────────────────────────────────
    Route::get('/citas', function () {
        return Cita::with(['paciente','medico'])->get()->map(fn($c) => [
            'id'         => $c->id,
            'pacienteId' => $c->paciente_id,
            'medicoId'   => $c->medico_id,
            'paciente'   => trim(($c->paciente?->nombre ?? '') . ' ' . ($c->paciente?->apellido ?? '')),
            'medico'     => trim(($c->medico?->nombre ?? '') . ' ' . ($c->medico?->apellido ?? '')),
            'fecha'      => $c->fecha?->format('Y-m-d'),
            'hora'       => $c->fecha?->format('H:i'),
            'motivo'     => $c->motivo,
            'sala'       => $c->sala,
            'estado'     => $c->estado ?? 'Programada',
        ]);
    });

    Route::post('/citas', function (Request $request) {
        $fechaRaw = $request->fecha;
        if ($request->hora) {
            $fechaRaw = $request->fecha . ' ' . $request->hora . ':00';
        }
        $c = Cita::create([
            'paciente_id'   => $request->pacienteId ?? $request->paciente_id,
            'medico_id'     => $request->medicoId   ?? $request->medico_id,
            'fecha'         => $fechaRaw,
            'motivo'        => $request->motivo,
            'sala'          => $request->sala,
            'estado'        => $request->estado ?? 'Programada',
            'observaciones' => $request->observaciones,
        ]);
        return response()->json([
            'id'         => $c->id,
            'pacienteId' => $c->paciente_id,
            'medicoId'   => $c->medico_id,
            'fecha'      => $c->fecha?->format('Y-m-d'),
            'hora'       => $c->fecha?->format('H:i'),
            'motivo'     => $c->motivo,
            'sala'       => $c->sala,
            'estado'     => $c->estado,
        ], 201);
    });

    Route::put('/citas/{id}', function (Request $request, $id) {
        $c = Cita::findOrFail($id);
        $fechaRaw = $request->fecha;
        if ($request->hora) {
            $fechaRaw = $request->fecha . ' ' . $request->hora . ':00';
        }
        $c->update([
            'paciente_id'   => $request->pacienteId ?? $request->paciente_id ?? $c->paciente_id,
            'medico_id'     => $request->medicoId   ?? $request->medico_id   ?? $c->medico_id,
            'fecha'         => $fechaRaw ?? $c->fecha,
            'motivo'        => $request->motivo        ?? $c->motivo,
            'sala'          => $request->sala           ?? $c->sala,
            'estado'        => $request->estado         ?? $c->estado,
            'observaciones' => $request->observaciones  ?? $c->observaciones,
        ]);
        return response()->json([
            'id'         => $c->id,
            'pacienteId' => $c->paciente_id,
            'medicoId'   => $c->medico_id,
            'fecha'      => $c->fecha?->format('Y-m-d'),
            'hora'       => $c->fecha?->format('H:i'),
            'motivo'     => $c->motivo,
            'sala'       => $c->sala,
            'estado'     => $c->estado,
        ]);
    });

    Route::delete('/citas/{id}', function ($id) {
        Cita::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    });

    // ── DIAGNÓSTICOS ──────────────────────────────────────────────
    Route::get('/diagnosticos', function () {
        return Diagnostico::with(['paciente','medico'])->get()->map(fn($d) => [
            'id'          => $d->id,
            'pacienteId'  => $d->paciente_id,
            'medicoId'    => $d->medico_id,
            'paciente'    => trim(($d->paciente?->nombre ?? '') . ' ' . ($d->paciente?->apellido ?? '')),
            'medico'      => trim(($d->medico?->nombre ?? '') . ' ' . ($d->medico?->apellido ?? '')),
            'diagnostico' => $d->diagnostico ?? $d->descripcion,
            'gravedad'    => $d->gravedad,
            'fecha'       => $d->fecha,
        ]);
    });

    Route::post('/diagnosticos', function (Request $request) {
        $d = Diagnostico::create($request->only(['paciente_id','medico_id','diagnostico','descripcion','gravedad','fecha']));
        return response()->json($d, 201);
    });

    Route::put('/diagnosticos/{id}', function (Request $request, $id) {
        $d = Diagnostico::findOrFail($id);
        $d->update($request->only(['paciente_id','medico_id','diagnostico','descripcion','gravedad','fecha']));
        return response()->json($d);
    });

    Route::delete('/diagnosticos/{id}', function ($id) {
        Diagnostico::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    });

    // ── TRATAMIENTOS ──────────────────────────────────────────────
    Route::get('/tratamientos', function () {
        return Tratamiento::with(['diagnostico.paciente', 'medico'])->get()->map(fn($t) => [
            'id'                        => $t->id,
            'diagnosticoId'             => $t->diagnostico_id,
            'medicoId'                  => $t->medico_id,
            'nombre'                    => $t->nombre,
            'paciente'                  => trim(($t->diagnostico?->paciente?->nombre ?? '') . ' ' . ($t->diagnostico?->paciente?->apellido ?? '')),
            'medico'                    => trim(($t->medico?->nombre ?? '') . ' ' . ($t->medico?->apellido ?? '')),
            'duracion'                  => $t->duracion,
            'estado'                    => $t->estado,
            'descripcion'               => $t->descripcion,
            'frecuencia_administracion' => $t->frecuencia_administracion,
        ]);
    });

    Route::post('/tratamientos', function (Request $request) {
        $t = Tratamiento::create([
            'nombre'                    => $request->nombre,
            'descripcion'               => $request->descripcion ?? '',
            'duracion'                  => $request->duracion    ?? '',
            'diagnostico_id'            => $request->diagnosticoId ?? $request->diagnostico_id,
            'medico_id'                 => $request->medicoId      ?? $request->medico_id,
            'estado'                    => $request->estado ?? 'Activo',
            'frecuencia_administracion' => $request->frecuencia_administracion,
        ]);
        return response()->json($t, 201);
    });

    Route::put('/tratamientos/{id}', function (Request $request, $id) {
        $t = Tratamiento::findOrFail($id);
        $t->update([
            'nombre'                    => $request->nombre                    ?? $t->nombre,
            'descripcion'               => $request->descripcion               ?? $t->descripcion,
            'duracion'                  => $request->duracion                  ?? $t->duracion,
            'diagnostico_id'            => $request->diagnosticoId ?? $request->diagnostico_id ?? $t->diagnostico_id,
            'medico_id'                 => $request->medicoId      ?? $request->medico_id      ?? $t->medico_id,
            'estado'                    => $request->estado                    ?? $t->estado,
            'frecuencia_administracion' => $request->frecuencia_administracion ?? $t->frecuencia_administracion,
        ]);
        return response()->json($t);
    });

    Route::delete('/tratamientos/{id}', function ($id) {
        $t = Tratamiento::findOrFail($id);
        $t->medicamentos()->delete();
        $t->delete();
        return response()->json(['ok' => true]);
    });

    // ── MEDICAMENTOS ──────────────────────────────────────────────
    Route::get('/medicamentos', function () {
        return Medicamento::with('tratamiento')->get()->map(fn($m) => [
            'id'                  => $m->id,
            'nombre'              => $m->nombre,
            'dosis'               => $m->dosis,
            'frecuencia'          => $m->frecuencia,
            'duracion'            => $m->duracion,
            'tratamientoId'       => $m->tratamiento_id,
            'tratamiento'         => $m->tratamiento?->nombre ?? '—',
            'proveedor'           => $m->proveedor,
            'efectos_secundarios' => $m->efectos_secundarios,
        ]);
    });

    Route::post('/medicamentos', function (Request $request) {
        $m = Medicamento::create([
            'nombre'              => $request->nombre,
            'dosis'               => $request->dosis        ?? '',
            'frecuencia'          => $request->frecuencia   ?? '',
            'duracion'            => $request->duracion      ?? '',
            'tratamiento_id'      => $request->tratamientoId ?? $request->tratamiento_id,
            'proveedor'           => $request->proveedor,
            'efectos_secundarios' => $request->efectos_secundarios,
        ]);
        return response()->json($m, 201);
    });

    Route::put('/medicamentos/{id}', function (Request $request, $id) {
        $m = Medicamento::findOrFail($id);
        $m->update([
            'nombre'              => $request->nombre              ?? $m->nombre,
            'dosis'               => $request->dosis               ?? $m->dosis,
            'frecuencia'          => $request->frecuencia          ?? $m->frecuencia,
            'duracion'            => $request->duracion             ?? $m->duracion,
            'tratamiento_id'      => $request->tratamientoId ?? $request->tratamiento_id ?? $m->tratamiento_id,
            'proveedor'           => $request->proveedor           ?? $m->proveedor,
            'efectos_secundarios' => $request->efectos_secundarios ?? $m->efectos_secundarios,
        ]);
        return response()->json($m);
    });

    Route::delete('/medicamentos/{id}', function ($id) {
        Medicamento::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    });

});
