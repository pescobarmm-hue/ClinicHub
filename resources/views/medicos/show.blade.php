@extends('layouts.app')

@section('title', 'Detalle Médico')
@section('page-title', 'Médico')
@section('page-sub', 'Información y citas asociadas')

@section('content')
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title"><i class="fas fa-user-md"></i> Datos profesionales</div>
    <div class="form-row" style="margin-bottom:0;">
        <div><strong>Nombre:</strong> {{ $medico->nombre }} {{ $medico->apellido }}</div>
        <div><strong>Especialidad:</strong> {{ $medico->especialidad }}</div>
        <div><strong>Teléfono:</strong> {{ $medico->telefono ?? '—' }}</div>
        <div><strong>Email:</strong> {{ $medico->email ?? '—' }}</div>
        <div><strong>Licencia:</strong> {{ $medico->licencia ?? '—' }}</div>
        <div><strong>Años exp.:</strong> {{ $medico->años_experiencia ?? '—' }}</div>
    </div>
</div>

<div class="card">
    <div class="card-title"><i class="fas fa-calendar-alt"></i> Citas asignadas</div>
    @if($medico->citas->count())
        <div class="appt-list">
            @foreach($medico->citas->take(10) as $cita)
            <div class="appt-item">
                <div class="appt-info">
                    <div class="appt-name">{{ $cita->paciente->nombre ?? '—' }} {{ $cita->paciente->apellido ?? '' }}</div>
                    <div class="appt-meta">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }} · {{ $cita->motivo }}</div>
                </div>
                <span class="badge badge-{{ $cita->estado == 'Programada' ? 'pending' : ($cita->estado == 'Completada' ? 'done' : 'cancel') }}">{{ $cita->estado }}</span>
            </div>
            @endforeach
        </div>
    @else
        <p class="tbl-empty">No tiene citas asignadas.</p>
    @endif
</div>

<div class="form-footer" style="justify-content:flex-start; gap:1rem; margin-top:1rem;">
    <a href="{{ route('medicos.edit', $medico) }}" class="btn-secondary"><i class="fas fa-pen"></i> Editar</a>
    <a href="{{ route('medicos.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
</div>
@endsection
