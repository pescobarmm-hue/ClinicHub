@extends('layouts.app')

@section('title', 'Citas')
@section('page-title', 'Citas')
@section('page-sub', 'Calendario de atención médica')

@section('content')
<div class="page-header">
    <div>
        <h2>Citas</h2>
        <p>Listado de citas programadas</p>
    </div>
    <a href="{{ route('citas.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Nueva cita
    </a>
</div>

<div class="table-wrap">
    <div class="table-toolbar">
        <div class="t-search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar cita...">
        </div>
        <span class="t-count">{{ $citas->total() }} registros</span>
    </div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha / Hora</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Sala</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $c)
                <tr>
                    <td class="mono">{{ $c->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($c->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $c->paciente->nombre ?? '—' }} {{ $c->paciente->apellido ?? '' }}</td>
                    <td>{{ $c->medico->nombre ?? '—' }} {{ $c->medico->apellido ?? '' }}</td>
                    <td>{{ $c->motivo }}</td>
                    <td>
                        @php
                            $estadoBadge = match($c->estado) {
                                'Programada' => 'badge-pending',
                                'Completada' => 'badge-done',
                                'Cancelada'  => 'badge-cancel',
                                default      => 'badge-pending',
                            };
                        @endphp
                        <span class="badge {{ $estadoBadge }}">{{ $c->estado ?? 'Programada' }}</span>
                    </td>
                    <td>{{ $c->sala ?? '—' }}</td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('citas.show', $c) }}" class="act-btn" title="Ver"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('citas.edit', $c) }}" class="act-btn" title="Editar"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('citas.destroy', $c) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Cancelar/eliminar esta cita?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="act-btn del" title="Eliminar"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="tbl-empty">
                            <i class="fas fa-inbox"></i>
                            <p>No hay citas registradas.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem; border-top:1px solid var(--pearl-200);">
        {{ $citas->links() }}
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
