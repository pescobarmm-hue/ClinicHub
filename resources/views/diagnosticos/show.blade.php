@extends('layouts.app')

@section('title', 'Detalle Diagnóstico')
@section('page-title', 'Diagnóstico')
@section('page-sub', 'Información completa')

@section('content')
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title"><i class="fas fa-stethoscope"></i> Datos del diagnóstico</div>
    <div class="form-row" style="margin-bottom:0;">
        <div><strong>ID:</strong> {{ $diagnostico->id }}</div>
        <div><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($diagnostico->fecha)->format('d/m/Y H:i') }}</div>
        <div><strong>Gravedad:</strong> <span class="badge badge-{{ $diagnostico->gravedad == 'Leve' ? 'info' : ($diagnostico->gravedad == 'Moderado' ? 'pending' : 'cancel') }}">{{ $diagnostico->gravedad ?? '—' }}</span></div>
        <div><strong>Tipo:</strong> {{ $diagnostico->tipo_diagnostico ?? '—' }}</div>
        <div><strong>Descripción:</strong> {{ $diagnostico->descripcion }}</div>
        <div><strong>Recomendaciones:</strong> {{ $diagnostico->recomendaciones ?? '—' }}</div>
    </div>
</div>

<div class="grid-2">
    <div class="card">
        <div class="card-title"><i class="fas fa-user"></i> Paciente</div>
        <div><strong>Nombre:</strong> {{ $diagnostico->paciente->nombre }} {{ $diagnostico->paciente->apellido }}</div>
        <div><strong>Teléfono:</strong> {{ $diagnostico->paciente->telefono ?? '—' }}</div>
    </div>
    <div class="card">
        <div class="card-title"><i class="fas fa-user-md"></i> Médico</div>
        <div><strong>Nombre:</strong> {{ $diagnostico->medico->nombre }} {{ $diagnostico->medico->apellido }}</div>
        <div><strong>Especialidad:</strong> {{ $diagnostico->medico->especialidad }}</div>
    </div>
</div>

@if($diagnostico->tratamientos->count())
<div class="card" style="margin-top:1.5rem;">
    <div class="card-title"><i class="fas fa-notes-medical"></i> Tratamientos asociados</div>
    <div class="appt-list">
        @foreach($diagnostico->tratamientos as $t)
        <div class="appt-item">
            <div class="appt-info">
                <div class="appt-name">{{ $t->nombre }}</div>
                <div class="appt-meta">{{ $t->duracion }} · {{ $t->estado }}</div>
            </div>
            <a href="{{ route('tratamientos.show', $t) }}" class="act-btn"><i class="fas fa-eye"></i></a>
        </div>
        @endforeach
    </div>
</div>
@endif

<div class="form-footer" style="justify-content:flex-start; gap:1rem; margin-top:1rem;">
    <a href="{{ route('diagnosticos.edit', $diagnostico) }}" class="btn-secondary"><i class="fas fa-pen"></i> Editar</a>
    <a href="{{ route('diagnosticos.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
</div>
@endsection
