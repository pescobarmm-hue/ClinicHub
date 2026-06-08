<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['paciente', 'medico'])->latest('fecha')->paginate(10);
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos   = Medico::orderBy('nombre')->get();
        return view('citas.create', compact('pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paciente_id'  => 'required|exists:pacientes,id',
            'medico_id'    => 'required|exists:medicos,id',
            'fecha'        => 'required|date',
            'motivo'       => 'required|string|max:255',
            'sala'         => 'nullable|string|max:100',
            'estado'       => 'nullable|in:Programada,Completada,Cancelada',
            'observaciones'=> 'nullable|string',
        ]);

        // Estado por defecto si no viene del formulario
        $validated['estado'] = $validated['estado'] ?? 'Programada';

        Cita::create($validated);

        return redirect()->route('citas.index')
                         ->with('success', 'Cita programada exitosamente.');
    }

    public function show(Cita $cita)
    {
        $cita->load(['paciente', 'medico']);
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos   = Medico::orderBy('nombre')->get();
        return view('citas.edit', compact('cita', 'pacientes', 'medicos'));
    }

    public function update(Request $request, Cita $cita)
    {
        $validated = $request->validate([
            'paciente_id'  => 'required|exists:pacientes,id',
            'medico_id'    => 'required|exists:medicos,id',
            'fecha'        => 'required|date',
            'motivo'       => 'required|string|max:255',
            'sala'         => 'nullable|string|max:100',
            'estado'       => 'nullable|in:Programada,Completada,Cancelada',
            'observaciones'=> 'nullable|string',
        ]);

        $cita->update($validated);

        return redirect()->route('citas.show', $cita)
                         ->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();

        return redirect()->route('citas.index')
                         ->with('success', 'Cita eliminada correctamente.');
    }
}
