<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::latest()->paginate(10);
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        return view('medicos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'nullable|string|max:100',
            'especialidad'     => 'required|string|max:150',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:150|unique:medicos,email',
            'licencia'         => 'nullable|string|max:100',
            'años_experiencia' => 'nullable|string|max:50',
        ]);

        Medico::create($validated);

        return redirect()->route('medicos.index')
                         ->with('success', 'Médico registrado exitosamente.');
    }

    public function show(Medico $medico)
    {
        $medico->load(['citas.paciente']);
        return view('medicos.show', compact('medico'));
    }

    public function edit(Medico $medico)
    {
        return view('medicos.edit', compact('medico'));
    }

    public function update(Request $request, Medico $medico)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'nullable|string|max:100',
            'especialidad'     => 'required|string|max:150',
            'telefono'         => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:150|unique:medicos,email,' . $medico->id,
            'licencia'         => 'nullable|string|max:100',
            'años_experiencia' => 'nullable|string|max:50',
        ]);

        $medico->update($validated);

        return redirect()->route('medicos.show', $medico)
                         ->with('success', 'Médico actualizado correctamente.');
    }

    public function destroy(Medico $medico)
    {
        $medico->delete();

        return redirect()->route('medicos.index')
                         ->with('success', 'Médico eliminado correctamente.');
    }
}
