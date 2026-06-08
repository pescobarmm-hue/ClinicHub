@extends('layouts.app')

@section('title', 'Detalle Medicamento')
@section('page-title', 'Medicamento')
@section('page-sub', 'Información del fármaco')

@section('content')

{{-- ALERTA DE ÉXITO --}}
@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

{{-- DATOS DEL MEDICAMENTO --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title"><i class="fas fa-capsules"></i> Datos del medicamento</div>
    <div class="form-row" style="margin-bottom:0;gap:1.2rem;">
        <div><strong>Nombre:</strong> {{ $medicamento->nombre }}</div>
        <div><strong>Dosis:</strong> {{ $medicamento->dosis }}</div>
        <div><strong>Frecuencia:</strong> {{ $medicamento->frecuencia }}</div>
        <div><strong>Duración:</strong> {{ $medicamento->duracion }}</div>
        <div><strong>Proveedor:</strong> {{ $medicamento->proveedor ?? '—' }}</div>
    </div>
    @if($medicamento->efectos_secundarios)
    <div style="margin-top:1rem;">
        <strong>Efectos secundarios:</strong> {{ $medicamento->efectos_secundarios }}
    </div>
    @endif
</div>

{{-- TRATAMIENTO ASOCIADO --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title"><i class="fas fa-notes-medical"></i> Tratamiento asociado</div>
    <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.5rem;">
        <div><strong>Nombre:</strong> {{ $medicamento->tratamiento->nombre ?? '—' }}</div>
        <div><strong>Descripción:</strong> {{ $medicamento->tratamiento->descripcion ?? '—' }}</div>
        <div>
            <strong>Estado:</strong>
            @if($medicamento->tratamiento)
            <span class="badge badge-{{ $medicamento->tratamiento->estado == 'Activo' ? 'active' : ($medicamento->tratamiento->estado == 'Finalizado' ? 'done' : 'cancel') }}">
                {{ $medicamento->tratamiento->estado ?? '—' }}
            </span>
            @else
            —
            @endif
        </div>
        <div><strong>Diagnóstico:</strong> {{ $medicamento->tratamiento->diagnostico->descripcion ?? '—' }}</div>
        <div>
            <strong>Paciente:</strong>
            {{ $medicamento->tratamiento->diagnostico->paciente->nombre ?? '—' }}
            {{ $medicamento->tratamiento->diagnostico->paciente->apellido ?? '' }}
        </div>
    </div>
</div>

{{-- ACCIONES --}}
<div class="form-footer" style="justify-content:flex-start;gap:1rem;margin-top:1rem;">
    <a href="{{ route('medicamentos.edit', $medicamento) }}" class="btn-primary">
        <i class="fas fa-pen"></i> Editar
    </a>
    <form action="{{ route('medicamentos.destroy', $medicamento) }}" method="POST"
          onsubmit="return confirm('¿Eliminar este medicamento?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-secondary" style="color:#dc2626;border-color:#dc2626;">
            <i class="fas fa-trash"></i> Eliminar
        </button>
    </form>
    <a href="{{ route('medicamentos.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>
@endsection
