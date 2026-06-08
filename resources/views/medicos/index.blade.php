@extends('layouts.app')

@section('title', 'Médicos')
@section('page-title', 'Médicos')
@section('page-sub', 'Especialistas del sistema')

@section('content')
<div class="page-header">
    <div>
        <h2>Médicos</h2>
        <p>Listado de profesionales</p>
    </div>
    <a href="{{ route('medicos.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Nuevo médico
    </a>
</div>

<div class="table-wrap">
    <div class="table-toolbar">
        <div class="t-search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar médico...">
        </div>
        <span class="t-count">{{ $medicos->total() }} registros</span>
    </div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre completo</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Licencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicos as $m)
                <tr>
                    <td class="mono">{{ $m->id }}</td>
                    <td>{{ $m->nombre }} {{ $m->apellido }}</td>
                    <td>{{ $m->especialidad }}</td>
                    <td>{{ $m->telefono ?? '—' }}</td>
                    <td>{{ $m->email ?? '—' }}</td>
                    <td>{{ $m->licencia ?? '—' }}</td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('medicos.show', $m) }}" class="act-btn" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('medicos.edit', $m) }}" class="act-btn" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('medicos.destroy', $m) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este médico?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="act-btn del" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="tbl-empty">
                            <i class="fas fa-inbox"></i>
                            <p>No hay médicos registrados.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem; border-top:1px solid var(--pearl-200);">
        {{ $medicos->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        let term = e.target.value.toLowerCase();
        document.querySelectorAll('.data-table tbody tr').forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
