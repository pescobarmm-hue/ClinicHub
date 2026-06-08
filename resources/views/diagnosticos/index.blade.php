@extends('layouts.app')

@section('title', 'Diagnósticos')
@section('page-title', 'Diagnósticos')
@section('page-sub', 'Historial clínico de diagnósticos')

@section('content')
<div class="page-header">
    <div>
        <h2>Diagnósticos</h2>
        <p>Listado de diagnósticos registrados</p>
    </div>
    <a href="{{ route('diagnosticos.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Nuevo diagnóstico
    </a>
</div>

<div class="table-wrap">
    <div class="table-toolbar">
        <div class="t-search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar diagnóstico...">
        </div>
        <span class="t-count">{{ $diagnosticos->total() }} registros</span>
    </div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Gravedad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($diagnosticos as $dx)
                <tr>
                    <td class="mono">{{ $dx->id }}</td>
                    <td>{{ $dx->paciente->nombre ?? '—' }} {{ $dx->paciente->apellido ?? '' }}</td>
                    <td>{{ $dx->medico->nombre ?? '—' }} {{ $dx->medico->apellido ?? '' }}</td>
                    <td>{{ Str::limit($dx->descripcion, 50) }}</td>
                    <td>{{ \Carbon\Carbon::parse($dx->fecha)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $gravBadge = match($dx->gravedad) {
                                'Leve'     => 'badge-active',   // verde  → leve
                                'Moderado' => 'badge-pending',  // ámbar  → moderado
                                'Severo'   => 'badge-cancel',   // rojo   → severo
                                default    => 'badge-done',
                            };
                        @endphp
                        <span class="badge {{ $gravBadge }}">{{ $dx->gravedad ?? '—' }}</span>
                    </td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('diagnosticos.show', $dx) }}" class="act-btn" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('diagnosticos.edit', $dx) }}" class="act-btn" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('diagnosticos.destroy', $dx) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este diagnóstico?')">
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
                            <p>No hay diagnósticos registrados.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem; border-top:1px solid var(--pearl-200);">
        {{ $diagnosticos->links() }}
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
