<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\Tratamiento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::with('tratamiento')->latest()->paginate(10);
        return view('medicamentos.index', compact('medicamentos'));
    }

    public function create()
    {
        $tratamientos = Tratamiento::with('diagnostico.paciente')->orderBy('nombre')->get();
        return view('medicamentos.create', compact('tratamientos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'              => 'required|string|max:255',
            'dosis'               => 'required|string|max:100',
            'frecuencia'          => 'required|string|max:100',
            'duracion'            => 'required|string|max:100',
            'tratamiento_id'      => 'required|exists:tratamientos,id',
            'proveedor'           => 'nullable|string|max:255',
            'efectos_secundarios' => 'nullable|string',
        ]);

        Medicamento::create($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento registrado exitosamente.');
    }

    public function show(Medicamento $medicamento)
    {
        $medicamento->load(['tratamiento.diagnostico.paciente']);
        return view('medicamentos.show', compact('medicamento'));
    }

    public function edit(Medicamento $medicamento)
    {
        $tratamientos = Tratamiento::with('diagnostico.paciente')->orderBy('nombre')->get();
        return view('medicamentos.edit', compact('medicamento', 'tratamientos'));
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $validated = $request->validate([
            'nombre'              => 'required|string|max:255',
            'dosis'               => 'required|string|max:100',
            'frecuencia'          => 'required|string|max:100',
            'duracion'            => 'required|string|max:100',
            'tratamiento_id'      => 'required|exists:tratamientos,id',
            'proveedor'           => 'nullable|string|max:255',
            'efectos_secundarios' => 'nullable|string',
        ]);

        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento eliminado correctamente.');
    }
}
