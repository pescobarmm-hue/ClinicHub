@extends('layouts.app')

@section('title', 'Detalle Tratamiento')
@section('page-title', 'Tratamiento')
@section('page-sub', 'Información del plan terapéutico')

@section('content')

{{-- ALERTAS --}}
@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- DATOS DEL TRATAMIENTO --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title"><i class="fas fa-notes-medical"></i> Datos del tratamiento</div>
    <div class="form-row" style="margin-bottom:0;gap:1.2rem;">
        <div><strong>Nombre:</strong> {{ $tratamiento->nombre }}</div>
        <div><strong>Duración:</strong> {{ $tratamiento->duracion }}</div>
        <div>
            <strong>Estado:</strong>
            <span class="badge badge-{{ $tratamiento->estado == 'Activo' ? 'active' : ($tratamiento->estado == 'Finalizado' ? 'done' : 'cancel') }}">
                {{ $tratamiento->estado }}
            </span>
        </div>
        <div><strong>Frecuencia:</strong> {{ $tratamiento->frecuencia_administracion ?? '—' }}</div>
    </div>
    <div style="margin-top:1rem;"><strong>Descripción:</strong> {{ $tratamiento->descripcion }}</div>
</div>

{{-- DIAGNÓSTICO Y MÉDICO --}}
<div class="grid-2">
    <div class="card">
        <div class="card-title"><i class="fas fa-diagnoses"></i> Diagnóstico asociado</div>
        <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.5rem;">
            <div><strong>ID:</strong> {{ $tratamiento->diagnostico->id ?? '—' }}</div>
            <div><strong>Descripción:</strong> {{ $tratamiento->diagnostico->descripcion ?? '—' }}</div>
            <div>
                <strong>Paciente:</strong>
                {{ $tratamiento->diagnostico->paciente->nombre ?? '—' }}
                {{ $tratamiento->diagnostico->paciente->apellido ?? '' }}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-title"><i class="fas fa-user-md"></i> Médico responsable</div>
        <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.5rem;">
            <div>
                <strong>Nombre:</strong>
                {{ $tratamiento->medico->nombre ?? '—' }}
                {{ $tratamiento->medico->apellido ?? '' }}
            </div>
            <div><strong>Especialidad:</strong> {{ $tratamiento->medico->especialidad ?? '—' }}</div>
        </div>
    </div>
</div>

{{-- MEDICAMENTOS ASOCIADOS --}}
@if($tratamiento->medicamentos->count())
<div class="card" style="margin-top:1.5rem;">
    <div class="card-title"><i class="fas fa-capsules"></i> Medicamentos asociados ({{ $tratamiento->medicamentos->count() }})</div>
    <div class="appt-list">
        @foreach($tratamiento->medicamentos as $med)
        <div class="appt-item">
            <div class="appt-info">
                <div class="appt-name">{{ $med->nombre }}</div>
                <div class="appt-meta">Dosis: {{ $med->dosis ?? '—' }} · Frecuencia: {{ $med->frecuencia ?? '—' }}</div>
            </div>
            <a href="{{ route('medicamentos.show', $med) }}" class="act-btn" title="Ver medicamento">
                <i class="fas fa-eye"></i>
            </a>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="card" style="margin-top:1.5rem;">
    <div class="card-title"><i class="fas fa-capsules"></i> Medicamentos asociados</div>
    <div class="tbl-empty" style="padding:1.5rem 0;">
        <i class="fas fa-pills"></i>
        <p>No hay medicamentos asociados a este tratamiento.</p>
    </div>
</div>
@endif

{{-- ACCIONES --}}
<div class="form-footer" style="justify-content:flex-start;gap:1rem;margin-top:1.2rem;">
    <a href="{{ route('tratamientos.edit', $tratamiento) }}" class="btn-primary">
        <i class="fas fa-pen"></i> Editar
    </a>
    <form action="{{ route('tratamientos.destroy', $tratamiento) }}" method="POST"
          onsubmit="return confirm('¿Eliminar este tratamiento? También se eliminarán sus medicamentos.')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-secondary" style="color:#dc2626;border-color:#dc2626;">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </form>
    <a href="{{ route('tratamientos.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>
@endsection
