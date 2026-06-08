@extends('layouts.app')

@section('title', 'Paciente – ' . $paciente->nombre . ' ' . $paciente->apellido)
@section('page_title', 'Detalle de Paciente')
@section('page_sub', $paciente->nombre . ' ' . $paciente->apellido)

@section('content')

{{-- ── BOTONES DE ACCIÓN ────────────────────────────────────── --}}
<div class="page-header">
  <div>
    <h2>{{ $paciente->nombre }} {{ $paciente->apellido }}</h2>
    <p>Historial clínico completo</p>
  </div>
  <div style="display:flex;gap:.75rem;flex-wrap:wrap">
    <a href="{{ route('pacientes.edit', $paciente) }}" class="btn-primary">
      <i class="fas fa-pen"></i> Editar
    </a>
    <a href="{{ route('pacientes.index') }}" class="btn-secondary">
      <i class="fas fa-arrow-left"></i> Volver
    </a>
    {{-- Eliminar desde el detalle --}}
    <form action="{{ route('pacientes.destroy', $paciente) }}" method="POST"
          onsubmit="return confirm('¿Eliminar definitivamente a {{ addslashes($paciente->nombre . ' ' . $paciente->apellido) }}?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-danger">
        <i class="fas fa-trash"></i> Eliminar
      </button>
    </form>
  </div>
</div>

{{-- ── DATOS PERSONALES ─────────────────────────────────────── --}}
<div class="card">
  <div class="card-title"><i class="fas fa-user-circle"></i> Datos personales</div>
  <div class="form-row" style="margin-bottom:0">
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Nombre completo</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->nombre }} {{ $paciente->apellido }}</div>
    </div>
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Fecha de nac.</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->fecha_nacimiento?->format('d/m/Y') ?? '—' }}</div>
    </div>
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Género</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->genero ?? '—' }}</div>
    </div>
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Teléfono</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->telefono ?? '—' }}</div>
    </div>
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Tipo de sangre</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->tipo_sangre ?? '—' }}</div>
    </div>
    <div>
      <div style="font-size:.72rem;color:var(--pearl-400);letter-spacing:.06em;text-transform:uppercase;margin-bottom:.3rem">Dirección</div>
      <div style="font-size:.9rem;color:var(--pearl-800)">{{ $paciente->direccion ?? '—' }}</div>
    </div>
  </div>
</div>

{{-- ── CITAS Y DIAGNÓSTICOS ─────────────────────────────────── --}}
<div class="grid-2">
  {{-- CITAS --}}
  <div class="card">
    <div class="card-title"><i class="fas fa-calendar-alt"></i> Últimas citas ({{ $paciente->citas->count() }})</div>
    @if($paciente->citas->count())
      <div class="appt-list">
        @foreach($paciente->citas->sortByDesc('fecha')->take(5) as $cita)
          @php
            $bc = match($cita->estado ?? 'pendiente') {
              'activo','Completada','completada' => 'badge-active',
              'finalizado'                       => 'badge-done',
              'cancelado','Cancelada','cancelada'=> 'badge-cancel',
              default                            => 'badge-pending',
            };
          @endphp
          <div class="appt-item">
            <div class="appt-info">
              <div class="appt-name">{{ $cita->medico->nombre ?? 'Sin médico' }}</div>
              <div class="appt-meta">
                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                {{ $cita->hora ? 'a las '.$cita->hora : '' }}
                · {{ $cita->motivo ?? '—' }}
              </div>
            </div>
            <span class="badge {{ $bc }}">{{ $cita->estado ?? 'pendiente' }}</span>
          </div>
        @endforeach
      </div>
    @else
      <p style="color:var(--pearl-400);font-size:.85rem;padding:.5rem 0">Sin citas registradas.</p>
    @endif
  </div>

  {{-- DIAGNÓSTICOS --}}
  <div class="card">
    <div class="card-title"><i class="fas fa-stethoscope"></i> Diagnósticos ({{ $paciente->diagnosticos->count() }})</div>
    @if($paciente->diagnosticos->count())
      <div class="appt-list">
        @foreach($paciente->diagnosticos->sortByDesc('fecha')->take(5) as $dx)
          <div class="appt-item">
            <div class="appt-info">
              <div class="appt-name">{{ $dx->diagnostico ?? $dx->descripcion ?? '—' }}</div>
              <div class="appt-meta">
                {{ $dx->fecha instanceof \Carbon\Carbon ? $dx->fecha->format('d/m/Y') : ($dx->fecha ?? '—') }}
                @if($dx->medico) · {{ $dx->medico->nombre }} @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p style="color:var(--pearl-400);font-size:.85rem;padding:.5rem 0">Sin diagnósticos registrados.</p>
    @endif
  </div>
</div>

{{-- TRATAMIENTOS (si aplica) --}}
@if($paciente->tratamientos && $paciente->tratamientos->count())
<div class="card">
  <div class="card-title"><i class="fas fa-notes-medical"></i> Tratamientos ({{ $paciente->tratamientos->count() }})</div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr><th>Descripción</th><th>Costo</th><th>Fecha inicio</th></tr>
      </thead>
      <tbody>
        @foreach($paciente->tratamientos as $t)
        <tr>
          <td>{{ $t->descripcion }}</td>
          <td>S/ {{ number_format($t->costo, 2) }}</td>
          <td>{{ $t->fecha_inicio ?? '—' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

@endsection
