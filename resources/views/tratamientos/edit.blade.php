@extends('layouts.app')

@section('title', 'Editar Tratamiento')
@section('page-title', 'Editar Tratamiento')
@section('page-sub', 'Modificar datos del tratamiento')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar tratamiento: <strong>{{ $tratamiento->nombre }}</strong></h3>
    </div>

    {{-- ERRORES DE VALIDACIÓN --}}
    @if($errors->any())
    <div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:.85rem 1.2rem;border-radius:10px;margin:1rem 1.5rem 0;">
        <strong><i class="fas fa-exclamation-triangle"></i> Corrige los siguientes errores:</strong>
        <ul style="margin-top:.4rem;padding-left:1.2rem;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tratamientos.update', $tratamiento) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre <span class="req">*</span></label>
                    <input type="text" name="nombre" class="form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                           value="{{ old('nombre', $tratamiento->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Duración <span class="req">*</span></label>
                    <input type="text" name="duracion" class="form-input {{ $errors->has('duracion') ? 'is-invalid' : '' }}"
                           value="{{ old('duracion', $tratamiento->duracion) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Diagnóstico asociado <span class="req">*</span></label>
                    <select name="diagnostico_id" class="form-select {{ $errors->has('diagnostico_id') ? 'is-invalid' : '' }}" required>
                        <option value="">-- Seleccionar diagnóstico --</option>
                        @foreach($diagnosticos as $d)
                            <option value="{{ $d->id }}"
                                {{ old('diagnostico_id', $tratamiento->diagnostico_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->descripcion }} — {{ $d->paciente->nombre ?? '' }} {{ $d->paciente->apellido ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Médico a cargo <span class="req">*</span></label>
                    <select name="medico_id" class="form-select {{ $errors->has('medico_id') ? 'is-invalid' : '' }}" required>
                        <option value="">-- Seleccionar médico --</option>
                        @foreach($medicos as $m)
                            <option value="{{ $m->id }}"
                                {{ old('medico_id', $tratamiento->medico_id) == $m->id ? 'selected' : '' }}>
                                {{ $m->nombre }} {{ $m->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Descripción <span class="req">*</span></label>
                <textarea name="descripcion" class="form-textarea {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                          rows="3" required>{{ old('descripcion', $tratamiento->descripcion) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Activo"     {{ old('estado', $tratamiento->estado) == 'Activo'     ? 'selected' : '' }}>Activo</option>
                        <option value="Finalizado" {{ old('estado', $tratamiento->estado) == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="Suspendido" {{ old('estado', $tratamiento->estado) == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Frecuencia de administración</label>
                    <input type="text" name="frecuencia_administracion" class="form-input"
                           value="{{ old('frecuencia_administracion', $tratamiento->frecuencia_administracion) }}"
                           placeholder="Ej: Cada 8 horas">
                </div>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('tratamientos.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Actualizar tratamiento
            </button>
        </div>
    </form>
</div>
@endsection
