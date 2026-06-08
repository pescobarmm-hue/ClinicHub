<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::with(['paciente', 'medico'])->latest('fecha')->paginate(10);
        return view('diagnosticos.index', compact('diagnosticos'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos   = Medico::orderBy('nombre')->get();
        return view('diagnosticos.create', compact('pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'paciente_id'      => 'required|exists:pacientes,id',
            'medico_id'        => 'required|exists:medicos,id',
            'fecha'            => 'required|date',
            'descripcion'      => 'required|string',
            'gravedad'         => 'nullable|in:Leve,Moderado,Severo',
            'recomendaciones'  => 'nullable|string',
            'tipo_diagnostico' => 'nullable|string|max:100',
        ]);

        Diagnostico::create($validated);

        return redirect()->route('diagnosticos.index')
                         ->with('success', 'Diagnóstico registrado exitosamente.');
    }

    public function show(Diagnostico $diagnostico)
    {
        $diagnostico->load(['paciente', 'medico', 'tratamientos']);
        return view('diagnosticos.show', compact('diagnostico'));
    }

    public function edit(Diagnostico $diagnostico)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos   = Medico::orderBy('nombre')->get();
        return view('diagnosticos.edit', compact('diagnostico', 'pacientes', 'medicos'));
    }

    public function update(Request $request, Diagnostico $diagnostico)
    {
        $validated = $request->validate([
            'paciente_id'      => 'required|exists:pacientes,id',
            'medico_id'        => 'required|exists:medicos,id',
            'fecha'            => 'required|date',
            'descripcion'      => 'required|string',
            'gravedad'         => 'nullable|in:Leve,Moderado,Severo',
            'recomendaciones'  => 'nullable|string',
            'tipo_diagnostico' => 'nullable|string|max:100',
        ]);

        $diagnostico->update($validated);

        return redirect()->route('diagnosticos.show', $diagnostico)
                         ->with('success', 'Diagnóstico actualizado correctamente.');
    }

    public function destroy(Diagnostico $diagnostico)
    {
        $diagnostico->delete();

        return redirect()->route('diagnosticos.index')
                         ->with('success', 'Diagnóstico eliminado correctamente.');
    }
}
