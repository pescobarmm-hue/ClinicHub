@extends('layouts.app')

@section('title', 'Editar Diagnóstico')
@section('page-title', 'Editar Diagnóstico')
@section('page-sub', 'Modificar datos del diagnóstico')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar diagnóstico #{{ $diagnostico->id }}</h3>
    </div>
    <form action="{{ route('diagnosticos.update', $diagnostico) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Paciente <span class="req">*</span></label>
                    <select name="paciente_id" class="form-select" required>
                        @foreach($pacientes as $p)
                            <option value="{{ $p->id }}" {{ old('paciente_id', $diagnostico->paciente_id) == $p->id ? 'selected' : '' }}>{{ $p->nombre }} {{ $p->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Médico <span class="req">*</span></label>
                    <select name="medico_id" class="form-select" required>
                        @foreach($medicos as $m)
                            <option value="{{ $m->id }}" {{ old('medico_id', $diagnostico->medico_id) == $m->id ? 'selected' : '' }}>{{ $m->nombre }} {{ $m->apellido }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Fecha del diagnóstico</label>
                    <input type="datetime-local" name="fecha" class="form-input" value="{{ old('fecha', \Carbon\Carbon::parse($diagnostico->fecha)->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Gravedad</label>
                    <select name="gravedad" class="form-select">
                        <option value="">Seleccionar</option>
                        <option value="Leve" {{ old('gravedad', $diagnostico->gravedad) == 'Leve' ? 'selected' : '' }}>Leve</option>
                        <option value="Moderado" {{ old('gravedad', $diagnostico->gravedad) == 'Moderado' ? 'selected' : '' }}>Moderado</option>
                        <option value="Severo" {{ old('gravedad', $diagnostico->gravedad) == 'Severo' ? 'selected' : '' }}>Severo</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tipo de diagnóstico</label>
                <input type="text" name="tipo_diagnostico" class="form-input" value="{{ old('tipo_diagnostico', $diagnostico->tipo_diagnostico) }}">
            </div>
            <div class="form-group">
                <label class="form-label">Descripción <span class="req">*</span></label>
                <textarea name="descripcion" class="form-textarea" rows="4" required>{{ old('descripcion', $diagnostico->descripcion) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Recomendaciones</label>
                <textarea name="recomendaciones" class="form-textarea" rows="3">{{ old('recomendaciones', $diagnostico->recomendaciones) }}</textarea>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('diagnosticos.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
