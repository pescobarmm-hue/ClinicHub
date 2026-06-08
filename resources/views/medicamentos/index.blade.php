@extends('layouts.app')

@section('title', 'Medicamentos')
@section('page-title', 'Medicamentos')
@section('page-sub', 'Inventario farmacéutico')

@section('content')

{{-- ALERTAS --}}
@if(session('success'))
<div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:.85rem 1.2rem;border-radius:10px;margin-bottom:1.2rem;display:flex;align-items:center;gap:.6rem;">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

<div class="page-header">
    <div>
        <h2>Medicamentos</h2>
        <p>Listado de medicamentos registrados</p>
    </div>
    <a href="{{ route('medicamentos.create') }}" class="btn-primary">
        <i class="fas fa-plus"></i> Nuevo medicamento
    </a>
</div>

<div class="table-wrap">
    <div class="table-toolbar">
        <div class="t-search">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Buscar medicamento...">
        </div>
        <span class="t-count">{{ $medicamentos->total() }} registros</span>
    </div>
    <div style="overflow-x:auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dosis</th>
                    <th>Frecuencia</th>
                    <th>Duración</th>
                    <th>Tratamiento</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicamentos as $m)
                <tr>
                    <td class="mono">{{ $m->id }}</td>
                    <td>{{ $m->nombre }}</td>
                    <td>{{ $m->dosis }}</td>
                    <td>{{ $m->frecuencia }}</td>
                    <td>{{ $m->duracion }}</td>
                    <td>{{ $m->tratamiento->nombre ?? '—' }}</td>
                    <td>{{ $m->proveedor ?? '—' }}</td>
                    <td>
                        <div class="tbl-actions">
                            <a href="{{ route('medicamentos.show', $m) }}" class="act-btn" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('medicamentos.edit', $m) }}" class="act-btn" title="Editar">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('medicamentos.destroy', $m) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Eliminar este medicamento?')">
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
                            <p>No hay medicamentos registrados.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:1rem 1.5rem;border-top:1px solid var(--pearl-200);">
        {{ $medicamentos->links() }}
    </div>
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
