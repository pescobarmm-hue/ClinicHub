@extends('layouts.app')

@section('title', 'Pacientes')
@section('page_title', 'Pacientes')
@section('page_sub', 'Gestión de pacientes registrados')

@section('content')
<div class="page-header">
  <div>
    <h2>Pacientes</h2>
    <p>Listado completo de pacientes registrados</p>
  </div>
  <a href="{{ route('pacientes.create') }}" class="btn-primary">
    <i class="fas fa-plus"></i> Nuevo paciente
  </a>
</div>

<div class="table-wrap">
  <div class="table-toolbar">
    <div class="t-search">
      <i class="fas fa-search"></i>
      <input type="text" id="searchInput" placeholder="Buscar paciente...">
    </div>
    <span class="t-count" id="rowCount">{{ $pacientes->total() }} registros</span>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre completo</th>
          <th>Género</th>
          <th>Teléfono</th>
          <th>Tipo sangre</th>
          <th style="width:120px">Acciones</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        @forelse($pacientes as $p)
        <tr>
          <td class="mono">{{ $p->id }}</td>
          <td><strong>{{ $p->nombre }} {{ $p->apellido }}</strong></td>
          <td>{{ $p->genero ?? '—' }}</td>
          <td>{{ $p->telefono ?? '—' }}</td>
          <td>{{ $p->tipo_sangre ?? '—' }}</td>
          <td>
            <div class="tbl-actions">
              {{-- VER --}}
              <a href="{{ route('pacientes.show', $p) }}" class="act-btn" title="Ver detalle">
                <i class="fas fa-eye"></i>
              </a>
              {{-- EDITAR --}}
              <a href="{{ route('pacientes.edit', $p) }}" class="act-btn" title="Editar">
                <i class="fas fa-pen"></i>
              </a>
              {{-- ELIMINAR: form con POST + @method('DELETE') --}}
              <form action="{{ route('pacientes.destroy', $p) }}" method="POST"
                    style="display:inline"
                    onsubmit="return confirm('¿Eliminar a {{ addslashes($p->nombre . ' ' . $p->apellido) }}? Esta acción no se puede deshacer.')">
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
          <td colspan="6">
            <div class="tbl-empty">
              <i class="fas fa-inbox"></i>
              <p>No hay pacientes registrados.</p>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  {{-- Paginación de Laravel --}}
  @if($pacientes->hasPages())
  <div style="padding:1rem 1.5rem;border-top:1px solid var(--pearl-200)">
    {{ $pacientes->links() }}
  </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
// Búsqueda en tiempo real (lado cliente, sobre la página actual)
document.getElementById('searchInput').addEventListener('input', function() {
  const term = this.value.toLowerCase();
  let visible = 0;
  document.querySelectorAll('#tableBody tr').forEach(row => {
    const show = row.innerText.toLowerCase().includes(term);
    row.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  document.getElementById('rowCount').textContent = `${visible} registros`;
});
</script>
@endpush
