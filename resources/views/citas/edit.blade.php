@extends('layouts.app')

@section('title', 'Editar Cita')
@section('page-title', 'Editar Cita')
@section('page-sub', 'Modificar datos de la cita')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar cita #{{ $cita->id }}</h3>
    </div>
    <form action="{{ route('citas.update', $cita) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Paciente <span class="req">*</span></label>
                    <select name="paciente_id" class="form-select" required>
                        @foreach($pacientes as $p)
                            <option value="{{ $p->id }}" {{ old('paciente_id', $cita->paciente_id) == $p->id ? 'selected' : '' }}>{{ $p->nombre }} {{ $p->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Médico <span class="req">*</span></label>
                    <select name="medico_id" class="form-select" required>
                        @foreach($medicos as $m)
                            <option value="{{ $m->id }}" {{ old('medico_id', $cita->medico_id) == $m->id ? 'selected' : '' }}>{{ $m->nombre }} {{ $m->apellido }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Fecha y hora</label>
                    <input type="datetime-local" name="fecha" class="form-input" value="{{ old('fecha', \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d\TH:i')) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Sala</label>
                    <input type="text" name="sala" class="form-input" value="{{ old('sala', $cita->sala) }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-input" value="{{ old('motivo', $cita->motivo) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="Programada" {{ old('estado', $cita->estado) == 'Programada' ? 'selected' : '' }}>Programada</option>
                    <option value="Completada" {{ old('estado', $cita->estado) == 'Completada' ? 'selected' : '' }}>Completada</option>
                    <option value="Cancelada" {{ old('estado', $cita->estado) == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Observaciones</label>
                <textarea name="observaciones" class="form-textarea" rows="3">{{ old('observaciones', $cita->observaciones) }}</textarea>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('citas.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        </div>
    </form>
</div>
@endsection
