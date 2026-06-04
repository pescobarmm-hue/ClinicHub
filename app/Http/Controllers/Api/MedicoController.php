<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    // Listar todos los médicos
    public function index()
    {
        $medicos = Medico::all();
        return response()->json([
            'status' => true,
            'data' => $medicos
        ], 200);
    }

    // Crear un nuevo médico
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'email' => 'required|email|unique:medicos,email',
            'licencia' => 'required|string|unique:medicos,licencia|max:100',
            'años_experiencia' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $medico = Medico::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Médico registrado exitosamente',
            'data' => $medico
        ], 201);
    }

    // Mostrar un médico específico
    public function show($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json([
                'status' => false,
                'message' => 'Médico no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $medico
        ], 200);
    }

    // Actualizar un médico
    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json([
                'status' => false,
                'message' => 'Médico no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'especialidad' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|email|unique:medicos,email,' . $id,
            'licencia' => 'sometimes|required|string|max:100|unique:medicos,licencia,' . $id,
            'años_experiencia' => 'sometimes|required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $medico->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Médico actualizado correctamente',
            'data' => $medico
        ], 200);
    }

    // Eliminar un médico
    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json([
                'status' => false,
                'message' => 'Médico no encontrado'
            ], 404);
        }

        $medico->delete();

        return response()->json([
            'status' => true,
            'message' => 'Médico eliminado correctamente'
        ], 200);
    }
}