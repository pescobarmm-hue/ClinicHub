<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosticoController extends Controller
{
    // Listar todos los diagnósticos
    public function index()
    {
        $diagnosticos = Diagnostico::with(['paciente', 'medico'])->get();
        return response()->json([
            'status' => true,
            'data' => $diagnosticos
        ], 200);
    }

    // Crear un nuevo diagnóstico
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'gravedad' => 'required|string|in:Leve,Moderado,Severo',
            'recomendaciones' => 'required|string',
            'tipo_diagnostico' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $diagnostico = Diagnostico::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Diagnóstico registrado exitosamente',
            'data' => $diagnostico->load(['paciente', 'medico'])
        ], 201);
    }

    // Mostrar un diagnóstico específico
    public function show($id)
    {
        $diagnostico = Diagnostico::with(['paciente', 'medico', 'tratamientos'])->find($id);

        if (!$diagnostico) {
            return response()->json([
                'status' => false,
                'message' => 'Diagnóstico no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $diagnostico
        ], 200);
    }

    // Actualizar un diagnóstico
    public function update(Request $request, $id)
    {
        $diagnostico = Diagnostico::find($id);

        if (!$diagnostico) {
            return response()->json([
                'status' => false,
                'message' => 'Diagnóstico no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'descripcion' => 'sometimes|required|string',
            'fecha' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'paciente_id' => 'sometimes|required|exists:pacientes,id',
            'medico_id' => 'sometimes|required|exists:medicos,id',
            'gravedad' => 'sometimes|required|string|in:Leve,Moderado,Severo',
            'recomendaciones' => 'sometimes|required|string',
            'tipo_diagnostico' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $diagnostico->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Diagnóstico actualizado correctamente',
            'data' => $diagnostico->load(['paciente', 'medico'])
        ], 200);
    }

    // Eliminar un diagnóstico
    public function destroy($id)
    {
        $diagnostico = Diagnostico::find($id);

        if (!$diagnostico) {
            return response()->json([
                'status' => false,
                'message' => 'Diagnóstico no encontrado'
            ], 404);
        }

        $diagnostico->delete();

        return response()->json([
            'status' => true,
            'message' => 'Diagnóstico eliminado correctamente'
        ], 200);
    }
}