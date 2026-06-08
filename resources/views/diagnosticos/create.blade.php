@extends('layouts.app')

@section('title', 'Nuevo Diagnóstico')
@section('page-title', 'Nuevo Diagnóstico')
@section('page-sub', 'Registrar diagnóstico clínico')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Registrar diagnóstico</h3>
        <p>Complete la información del diagnóstico.</p>
    </div>
    <form action="{{ route('diagnosticos.store') }}" method="POST">
        @csrf
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Paciente <span class="req">*</span></label>
                    <select name="paciente_id" class="form-select" required>
                        <option value="">Seleccionar</option>
                        @foreach($pacientes as $p)
                            <option value="{{ $p->id }}" {{ old('paciente_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }} {{ $p->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Médico <span class="req">*</span></label>
                    <select name="medico_id" class="form-select" required>
                        <option value="">Seleccionar</option>
                        @foreach($medicos as $m)
                            <option value="{{ $m->id }}" {{ old('medico_id') == $m->id ? 'selected' : '' }}>{{ $m->nombre }} {{ $m->apellido }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Fecha del diagnóstico <span class="req">*</span></label>
                    <input type="datetime-local" name="fecha" class="form-input" value="{{ old('fecha') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Gravedad</label>
                    <select name="gravedad" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Leve" {{ old('gravedad') == 'Leve' ? 'selected' : '' }}>Leve</option>
                        <option value="Moderado" {{ old('gravedad') == 'Moderado' ? 'selected' : '' }}>Moderado</option>
                        <option value="Severo" {{ old('gravedad') == 'Severo' ? 'selected' : '' }}>Severo</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tipo de diagnóstico</label>
                <input type="text" name="tipo_diagnostico" class="form-input" value="{{ old('tipo_diagnostico') }}" placeholder="Ej: Primario, Secundario, etc.">
            </div>
            <div class="form-group">
                <label class="form-label">Descripción <span class="req">*</span></label>
                <textarea name="descripcion" class="form-textarea" rows="4" required>{{ old('descripcion') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Recomendaciones</label>
                <textarea name="recomendaciones" class="form-textarea" rows="3">{{ old('recomendaciones') }}</textarea>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('diagnosticos.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Guardar diagnóstico</button>
        </div>
    </form>
</div>
@endsection
