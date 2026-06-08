@extends('layouts.app')

@section('title', 'Nueva Cita')
@section('page-title', 'Nueva Cita')
@section('page-sub', 'Programar una atención')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Registrar cita</h3>
        <p>Seleccione paciente, médico y horario.</p>
    </div>
    <form action="{{ route('citas.store') }}" method="POST">
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
                            <option value="{{ $m->id }}" {{ old('medico_id') == $m->id ? 'selected' : '' }}>{{ $m->nombre }} {{ $m->apellido }} ({{ $m->especialidad }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Fecha y hora <span class="req">*</span></label>
                    <input type="datetime-local" name="fecha" class="form-input" value="{{ old('fecha') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Sala</label>
                    <input type="text" name="sala" class="form-input" value="{{ old('sala') }}" placeholder="Ej: Consultorio 3">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Motivo <span class="req">*</span></label>
                <input type="text" name="motivo" class="form-input" value="{{ old('motivo') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-textarea" rows="3">{{ old('observaciones') }}</textarea>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('citas.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Guardar cita</button>
        </div>
    </form>
</div>
@endsection
