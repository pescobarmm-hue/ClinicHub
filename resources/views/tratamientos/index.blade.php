@extends('layouts.app')

@section('title', 'Tratamientos')
@section('page-title', 'Tratamientos')
@section('page-sub', 'Planes de tratamiento activos')

@section('content')

{{-- ALERTAS DE ÉXITO / ERROR --}}
@if(session('success'))
<div class="alert-success" style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert-error" style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

<div class="page-header">
    <div>
        <h2>Tratamientos</h2>
        <p>Listado de tratamientos registrados</p>
    </div>
    <a href="{{ route('tratamientos.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Nuevo tratamiento
    </a>
</div>

<div class="table-wrap">
    <div class="table-toolbar">
        <div class="t-search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar tratamiento...">
        </div>
        <span class="t-count">{{ $tratamientos->total() }} registros</span>
    </div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Diagnóstico</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Duración</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tratamientos as $t)
                <tr>
                    <td class="mono">{{ $t->id }}</td>
                    <td>{{ $t->nombre }}</td>
                    <td>{{ $t->diagnostico->descripcion ?? '—' }}</td>
                    <td>{{ $t->diagnostico->paciente->nombre ?? '—' }} {{ $t->diagnostico->paciente->apellido ?? '' }}</td>
                    <td>{{ $t->medico->nombre ?? '—' }} {{ $t->medico->apellido ?? '' }}</td>
                    <td>{{ $t->duracion }}</td>
                    <td>
                        <span class="badge badge-{{ $t->estado == 'Activo' ? 'active' : ($t->estado == 'Finalizado' ? 'done' : 'cancel') }}">
                            {{ $t->estado }}
                        </span>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('tratamientos.show', $t) }}" class="act-btn" title="Ver detalle">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('tratamientos.edit', $t) }}" class="act-btn" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('tratamientos.destroy', $t) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar este tratamiento? También se eliminarán sus medicamentos asociados.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="act-btn del" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="tbl-empty">
                            <i class="fas fa-inbox"></i>
                            <p>No hay tratamientos registrados.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem;">{{ $tratamientos->links() }}</div>
</div>

@push('scripts')
<script>
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.data-table tbody tr').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(term) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
