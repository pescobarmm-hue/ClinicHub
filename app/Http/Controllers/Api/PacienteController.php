<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacienteController extends Controller
{
    // Listar todos los pacientes
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json([
            'status' => true,
            'data' => $pacientes
        ], 200);
    }

    // Crear un nuevo paciente
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string|max:50',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'tipo_sangre' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $paciente = Paciente::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Paciente registrado exitosamente',
            'data' => $paciente
        ], 201);
    }

    // Mostrar un paciente específico
    public function show($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json([
                'status' => false,
                'message' => 'Paciente no encontrado'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $paciente
        ], 200);
    }

    // Actualizar un paciente
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json([
                'status' => false,
                'message' => 'Paciente no encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'apellido' => 'sometimes|required|string|max:255',
            'fecha_nacimiento' => 'sometimes|required|date',
            'genero' => 'sometimes|required|string|max:50',
            'telefono' => 'sometimes|required|string|max:50',
            'direccion' => 'sometimes|required|string|max:255',
            'tipo_sangre' => 'sometimes|required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $paciente->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Paciente actualizado correctamente',
            'data' => $paciente
        ], 200);
    }

    // Eliminar un paciente
    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json([
                'status' => false,
                'message' => 'Paciente no encontrado'
            ], 404);
        }

        $paciente->delete();

        return response()->json([
            'status' => true,
            'message' => 'Paciente eliminado correctamente'
        ], 200);
    }
}