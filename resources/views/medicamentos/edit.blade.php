@extends('layouts.app')

@section('title', 'Editar Medicamento')
@section('page-title', 'Editar Medicamento')
@section('page-sub', 'Modificar datos del fármaco')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar medicamento: <strong>{{ $medicamento->nombre }}</strong></h3>
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

    <form action="{{ route('medicamentos.update', $medicamento) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre <span class="req">*</span></label>
                    <input type="text" name="nombre" class="form-input {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                           value="{{ old('nombre', $medicamento->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Dosis <span class="req">*</span></label>
                    <input type="text" name="dosis" class="form-input {{ $errors->has('dosis') ? 'is-invalid' : '' }}"
                           value="{{ old('dosis', $medicamento->dosis) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Frecuencia <span class="req">*</span></label>
                    <input type="text" name="frecuencia" class="form-input {{ $errors->has('frecuencia') ? 'is-invalid' : '' }}"
                           value="{{ old('frecuencia', $medicamento->frecuencia) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Duración <span class="req">*</span></label>
                    <input type="text" name="duracion" class="form-input {{ $errors->has('duracion') ? 'is-invalid' : '' }}"
                           value="{{ old('duracion', $medicamento->duracion) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Tratamiento asociado <span class="req">*</span></label>
                <select name="tratamiento_id" class="form-select {{ $errors->has('tratamiento_id') ? 'is-invalid' : '' }}" required>
                    <option value="">-- Seleccionar tratamiento --</option>
                    @foreach($tratamientos as $t)
                        <option value="{{ $t->id }}"
                            {{ old('tratamiento_id', $medicamento->tratamiento_id) == $t->id ? 'selected' : '' }}>
                            {{ $t->nombre }}
                            @if($t->diagnostico?->paciente)
                                — {{ $t->diagnostico->paciente->nombre }} {{ $t->diagnostico->paciente->apellido }}
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Proveedor</label>
                <input type="text" name="proveedor" class="form-input"
                       value="{{ old('proveedor', $medicamento->proveedor) }}"
                       placeholder="Nombre del proveedor (opcional)">
            </div>

            <div class="form-group">
                <label class="form-label">Efectos secundarios</label>
                <textarea name="efectos_secundarios" class="form-textarea" rows="2">{{ old('efectos_secundarios', $medicamento->efectos_secundarios) }}</textarea>
            </div>
        </div>

        <div class="form-footer">
            <a href="{{ route('medicamentos.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i> Actualizar medicamento
            </button>
        </div>
    </form>
</div>
@endsection
