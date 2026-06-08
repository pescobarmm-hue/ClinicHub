<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::latest()->paginate(20);
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'genero'           => 'nullable|in:Masculino,Femenino,Otro',
            'telefono'         => 'nullable|string|max:20',
            'tipo_sangre'      => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'direccion'        => 'nullable|string|max:255',
        ]);

        Paciente::create($validated);

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente registrado correctamente.');
    }

    public function show(Paciente $paciente)
    {
        $paciente->load(['citas.medico', 'diagnosticos.medico', 'tratamientos']);
        return view('pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $validated = $request->validate([
            'nombre'           => 'required|string|max:100',
            'apellido'         => 'nullable|string|max:100',
            'fecha_nacimiento' => 'nullable|date',
            'genero'           => 'nullable|in:Masculino,Femenino,Otro',
            'telefono'         => 'nullable|string|max:20',
            'tipo_sangre'      => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'direccion'        => 'nullable|string|max:255',
        ]);

        $paciente->update($validated);

        return redirect()->route('pacientes.show', $paciente)
                         ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente eliminado.');
    }
}
