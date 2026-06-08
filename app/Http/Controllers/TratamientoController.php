<?php

namespace App\Http\Controllers;

use App\Models\Tratamiento;
use App\Models\Diagnostico;
use App\Models\Medico;
use Illuminate\Http\Request;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::with(['diagnostico.paciente', 'medico', 'medicamentos'])
            ->latest()
            ->paginate(10);
        return view('tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
        $diagnosticos = Diagnostico::with('paciente')->get();
        $medicos      = Medico::orderBy('nombre')->get();
        return view('tratamientos.create', compact('diagnosticos', 'medicos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'                    => 'required|string|max:255',
            'descripcion'               => 'required|string',
            'duracion'                  => 'required|string|max:100',
            'diagnostico_id'            => 'required|exists:diagnosticos,id',
            'medico_id'                 => 'required|exists:medicos,id',
            'estado'                    => 'nullable|string|in:Activo,Finalizado,Suspendido',
            'frecuencia_administracion' => 'nullable|string|max:255',
        ]);

        $validated['estado'] = $validated['estado'] ?? 'Activo';

        Tratamiento::create($validated);

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento registrado exitosamente.');
    }

    public function show(Tratamiento $tratamiento)
    {
        $tratamiento->load(['diagnostico.paciente', 'medico', 'medicamentos']);
        return view('tratamientos.show', compact('tratamiento'));
    }

    public function edit(Tratamiento $tratamiento)
    {
        $diagnosticos = Diagnostico::with('paciente')->get();
        $medicos      = Medico::orderBy('nombre')->get();
        return view('tratamientos.edit', compact('tratamiento', 'diagnosticos', 'medicos'));
    }

    public function update(Request $request, Tratamiento $tratamiento)
    {
        $validated = $request->validate([
            'nombre'                    => 'required|string|max:255',
            'descripcion'               => 'required|string',
            'duracion'                  => 'required|string|max:100',
            'diagnostico_id'            => 'required|exists:diagnosticos,id',
            'medico_id'                 => 'required|exists:medicos,id',
            'estado'                    => 'nullable|string|in:Activo,Finalizado,Suspendido',
            'frecuencia_administracion' => 'nullable|string|max:255',
        ]);

        $tratamiento->update($validated);

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->medicamentos()->delete();
        $tratamiento->delete();

        return redirect()->route('tratamientos.index')
            ->with('success', 'Tratamiento eliminado correctamente.');
    }
}
