@extends('layouts.app')

@section('title', 'Editar Paciente')
@section('page_title', 'Editar Paciente')
@section('page_sub', 'Modificar datos del paciente')

@section('content')
<div class="page-header">
  <div>
    <h2>Editar paciente</h2>
    <p>{{ $paciente->nombre }} {{ $paciente->apellido }}</p>
  </div>
  <a href="{{ route('pacientes.index') }}" class="btn-secondary">
    <i class="fas fa-arrow-left"></i> Volver
  </a>
</div>

<div class="form-card">
  <div class="form-header">
    <h3><i class="fas fa-user-edit" style="color:var(--pearl-400);font-size:1.1rem;margin-right:.5rem"></i>Actualizar datos</h3>
    <p>Modifique la información necesaria y guarde los cambios.</p>
  </div>

  {{-- ACCIÓN: PUT mediante spoofing de método Laravel --}}
  <form action="{{ route('pacientes.update', $paciente) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nombre <span class="req">*</span></label>
          <input type="text" name="nombre"
            class="form-input @error('nombre') is-invalid @enderror"
            value="{{ old('nombre', $paciente->nombre) }}"
            required>
          @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="form-group">
          <label class="form-label">Apellido</label>
          <input type="text" name="apellido"
            class="form-input"
            value="{{ old('apellido', $paciente->apellido) }}">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Fecha de nacimiento</label>
          <input type="date" name="fecha_nacimiento"
            class="form-input"
            value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento?->format('Y-m-d')) }}">
        </div>
        <div class="form-group">
          <label class="form-label">Género</label>
          <select name="genero" class="form-select">
            <option value="">Seleccionar...</option>
            <option value="Masculino" @selected(old('genero', $paciente->genero) === 'Masculino')>Masculino</option>
            <option value="Femenino"  @selected(old('genero', $paciente->genero) === 'Femenino')>Femenino</option>
            <option value="Otro"      @selected(old('genero', $paciente->genero) === 'Otro')>Otro</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Teléfono</label>
          <input type="text" name="telefono"
            class="form-input"
            value="{{ old('telefono', $paciente->telefono) }}"
            placeholder="999 999 999">
        </div>
        <div class="form-group">
          <label class="form-label">Tipo de sangre</label>
          <select name="tipo_sangre" class="form-select">
            <option value="">Seleccionar...</option>
            @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $t)
              <option value="{{ $t }}" @selected(old('tipo_sangre', $paciente->tipo_sangre) === $t)>{{ $t }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Dirección</label>
        <textarea name="direccion" class="form-textarea">{{ old('direccion', $paciente->direccion) }}</textarea>
      </div>
    </div>

    <div class="form-footer">
      <a href="{{ route('pacientes.show', $paciente) }}" class="btn-secondary">Cancelar</a>
      <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i> Actualizar paciente
      </button>
    </div>
  </form>
</div>
@endsection
