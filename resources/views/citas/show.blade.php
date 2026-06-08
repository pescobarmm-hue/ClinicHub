@extends('layouts.app')

@section('title', 'Detalle Cita')
@section('page-title', 'Cita')
@section('page-sub', 'Información de la atención')

@section('content')
<div class="card">
    <div class="card-title"><i class="fas fa-info-circle"></i> Datos de la cita</div>
    <div class="form-row" style="margin-bottom:0;">
        <div><strong>ID:</strong> {{ $cita->id }}</div>
        <div><strong>Fecha/Hora:</strong> {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }}</div>
        <div><strong>Estado:</strong> <span class="badge badge-{{ $cita->estado == 'Programada' ? 'pending' : ($cita->estado == 'Completada' ? 'done' : 'cancel') }}">{{ $cita->estado }}</span></div>
        <div><strong>Sala:</strong> {{ $cita->sala ?? '—' }}</div>
        <div><strong>Motivo:</strong> {{ $cita->motivo }}</div>
        <div><strong>Observaciones:</strong> {{ $cita->observaciones ?? '—' }}</div>
    </div>
</div>

<div class="grid-2" style="margin-top:1.5rem;">
    <div class="card">
        <div class="card-title"><i class="fas fa-user"></i> Paciente</div>
        <div><strong>Nombre:</strong> {{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</div>
        <div><strong>Teléfono:</strong> {{ $cita->paciente->telefono ?? '—' }}</div>
        <div><strong>Dirección:</strong> {{ $cita->paciente->direccion ?? '—' }}</div>
    </div>
    <div class="card">
        <div class="card-title"><i class="fas fa-user-md"></i> Médico</div>
        <div><strong>Nombre:</strong> {{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</div>
        <div><strong>Especialidad:</strong> {{ $cita->medico->especialidad }}</div>
        <div><strong>Teléfono:</strong> {{ $cita->medico->telefono ?? '—' }}</div>
    </div>
</div>

<div class="form-footer" style="justify-content:flex-start; gap:1rem; margin-top:1rem;">
    <a href="{{ route('citas.edit', $cita) }}" class="btn-secondary"><i class="fas fa-pen"></i> Editar</a>
    <a href="{{ route('citas.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
</div>
@endsection
