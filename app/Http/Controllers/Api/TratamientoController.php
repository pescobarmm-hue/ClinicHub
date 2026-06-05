<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TratamientoController extends Controller
{
    // Listar tratamientos con diagnóstico, médico y medicamentos
    public function index()
    {
        $tratamientos = Tratamiento::with(['diagnostico', 'medico', 'medicamentos'])->get();
        return response()->json([
            'status' => true,
            'data' => $tratamientos
        ], 200);
    }

    // Crear un nuevo tratamiento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'duracion' => 'required|string|max:100',
            'diagnostico_id' => 'required|exists:diagnosticos,id',
            'medico_id' => 'required|exists:medicos,id',
            'estado' => 'sometimes|required|string|in:Activo,Finalizado,Suspendido',
            'frecuencia_administracion' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $tratamiento = Tratamiento::create($request->all());
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tratamiento registrado exitosamente',
                'data' => $tratamiento->load(['diagnostico', 'medico', 'medicamentos'])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el tratamiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar un tratamiento específico
    public function show($id)
    {
        $tratamiento = Tratamiento::with(['diagnostico', 'medico', 'medicamentos'])->find($id);
        if (!$tratamiento) {
            return response()->json([
                'status' => false,
                'message' => 'Tratamiento no encontrado'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $tratamiento
        ], 200);
    }

    // Actualizar un tratamiento
    public function update(Request $request, $id)
    {
        $tratamiento = Tratamiento::find($id);
        if (!$tratamiento) {
            return response()->json([
                'status' => false,
                'message' => 'Tratamiento no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'duracion' => 'sometimes|required|string|max:100',
            'diagnostico_id' => 'sometimes|required|exists:diagnosticos,id',
            'medico_id' => 'sometimes|required|exists:medicos,id',
            'estado' => 'sometimes|required|string|in:Activo,Finalizado,Suspendido',
            'frecuencia_administracion' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $tratamiento->update($request->all());
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tratamiento actualizado correctamente',
                'data' => $tratamiento->load(['diagnostico', 'medico', 'medicamentos'])
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al actualizar el tratamiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar un tratamiento (soft delete recomendado)
    public function destroy($id)
    {
        $tratamiento = Tratamiento::find($id);
        if (!$tratamiento) {
            return response()->json([
                'status' => false,
                'message' => 'Tratamiento no encontrado'
            ], 404);
        }

        DB::beginTransaction();
        try {
            // Opcional: eliminar también los medicamentos asociados si se usa cascade
            $tratamiento->medicamentos()->delete();
            $tratamiento->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tratamiento eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el tratamiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
