@extends('layouts.app')

@section('title', 'Editar Médico')
@section('page-title', 'Editar Médico')
@section('page-sub', 'Modificar datos del especialista')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar médico: {{ $medico->nombre }} {{ $medico->apellido }}</h3>
    </div>
    <form action="{{ route('medicos.update', $medico) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre <span class="req">*</span></label>
                    <input type="text" name="nombre" class="form-input" value="{{ old('nombre', $medico->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-input" value="{{ old('apellido', $medico->apellido) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Especialidad <span class="req">*</span></label>
                    <input type="text" name="especialidad" class="form-input" value="{{ old('especialidad', $medico->especialidad) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-input" value="{{ old('telefono', $medico->telefono) }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $medico->email) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Licencia</label>
                    <input type="text" name="licencia" class="form-input" value="{{ old('licencia', $medico->licencia) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Años de experiencia</label>
                <input type="text" name="años_experiencia" class="form-input" value="{{ old('años_experiencia', $medico->años_experiencia) }}">
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('medicos.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
