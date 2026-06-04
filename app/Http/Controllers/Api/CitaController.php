<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
{
    // Listar todas las citas con su paciente y médico
    public function index()
    {
        $citas = Cita::with(['paciente', 'medico'])->get();
        return response()->json([
            'status' => true,
            'data' => $citas
        ], 200);
    }

    // Crear una nueva cita
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'motivo' => 'required|string|max:255',
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'estado' => 'sometimes|string|in:Programada,Completada,Cancelada',
            'observaciones' => 'nullable|string',
            'sala' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cita = Cita::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Cita programada exitosamente',
            'data' => $cita->load(['paciente', 'medico'])
        ], 201);
    }

    // Mostrar una cita específica
    public function show($id)
    {
        $cita = Cita::with(['paciente', 'medico'])->find($id);

        if (!$cita) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $cita
        ], 200);
    }

    // Actualizar una cita
    public function update(Request $request, $id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'fecha' => 'sometimes|required|date_format:Y-m-d H:i:s',
            'motivo' => 'sometimes|required|string|max:255',
            'paciente_id' => 'sometimes|required|exists:pacientes,id',
            'medico_id' => 'sometimes|required|exists:medicos,id',
            'estado' => 'sometimes|required|string|in:Programada,Completada,Cancelada',
            'observaciones' => 'nullable|string',
            'sala' => 'sometimes|required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $cita->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Cita actualizada correctamente',
            'data' => $cita->load(['paciente', 'medico'])
        ], 200);
    }

    // Eliminar una cita
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada'
            ], 404);
        }

        $cita->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cita eliminada correctamente'
        ], 200);
    }
}