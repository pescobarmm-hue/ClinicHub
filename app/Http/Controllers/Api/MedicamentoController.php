<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    // Listar todos los medicamentos con su tratamiento
    public function index()
    {
        $medicamentos = Medicamento::with('tratamiento')->get();
        return response()->json([
            'status' => true,
            'data' => $medicamentos
        ], 200);
    }

    // Crear un nuevo medicamento
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'dosis' => 'required|string|max:100',
            'frecuencia' => 'required|string|max:100',
            'duracion' => 'required|string|max:100',
            'tratamiento_id' => 'required|exists:tratamientos,id',
            'proveedor' => 'nullable|string|max:255',
            'efectos_secundarios' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $medicamento = Medicamento::create($request->all());
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Medicamento registrado exitosamente',
                'data' => $medicamento->load('tratamiento')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al crear el medicamento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mostrar un medicamento específico
    public function show($id)
    {
        $medicamento = Medicamento::with('tratamiento')->find($id);
        if (!$medicamento) {
            return response()->json([
                'status' => false,
                'message' => 'Medicamento no encontrado'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $medicamento
        ], 200);
    }

    // Actualizar un medicamento
    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::find($id);
        if (!$medicamento) {
            return response()->json([
                'status' => false,
                'message' => 'Medicamento no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'dosis' => 'sometimes|required|string|max:100',
            'frecuencia' => 'sometimes|required|string|max:100',
            'duracion' => 'sometimes|required|string|max:100',
            'tratamiento_id' => 'sometimes|required|exists:tratamientos,id',
            'proveedor' => 'nullable|string|max:255',
            'efectos_secundarios' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $medicamento->update($request->all());
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Medicamento actualizado correctamente',
                'data' => $medicamento->load('tratamiento')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al actualizar el medicamento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Eliminar un medicamento
    public function destroy($id)
    {
        $medicamento = Medicamento::find($id);
        if (!$medicamento) {
            return response()->json([
                'status' => false,
                'message' => 'Medicamento no encontrado'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $medicamento->delete();
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Medicamento eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el medicamento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
