@extends('layouts.app')

@section('title', 'Editar Médico')
@section('page-title', 'Editar Médico')
@section('page-sub', 'Modificar datos del especialista')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Editar médico: {{ $medico->nombre }} {{ $medico->apellido }}</h3>
        <p>Actualiza los datos del profesional.</p>
    </div>
    <form action="{{ route('medicos.update', $medico) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-body">

            {{-- Nombre / Apellido --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre <span class="req">*</span></label>
                    <input type="text" name="nombre"
                        class="form-input @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre', $medico->nombre) }}"
                        placeholder="Ej. Carlos"
                        required>
                    @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido"
                        class="form-input"
                        value="{{ old('apellido', $medico->apellido) }}"
                        placeholder="Ej. Ramírez Torres">
                </div>
            </div>

            {{-- Especialidad / Teléfono --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Especialidad <span class="req">*</span></label>
                    <input type="text" name="especialidad"
                        class="form-input @error('especialidad') is-invalid @enderror"
                        value="{{ old('especialidad', $medico->especialidad) }}"
                        placeholder="Ej. Cardiología"
                        required>
                    @error('especialidad') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <div style="position: relative; display: flex; align-items: center;">
                        <span class="input-prefix" style="position: absolute; left: .85rem; color: var(--pearl-400); font-weight: 600;">+51</span>
                        <input type="tel" name="telefono"
                               class="form-input input-with-prefix"
                               style="padding-left: 2.8rem !important;"
                               value="{{ old('telefono', $medico->telefono ?? '') }}"
                               placeholder="987 654 321"
                               pattern="[0-9]{9}"
                               title="El teléfono debe tener 9 dígitos numéricos">
                    </div>
                </div>
            </div>

            {{-- Email / Licencia --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                        class="form-input"
                        value="{{ old('email', $medico->email) }}"
                        placeholder="medico@clinica.com">
                </div>
                <div class="form-group">
                    <label class="form-label">N.º de licencia</label>
                    <input type="text" name="licencia"
                        class="form-input"
                        value="{{ old('licencia', $medico->licencia) }}"
                        placeholder="Ej. CMP-12345">
                </div>
            </div>

            {{-- Años de Experiencia Interactivo --}}
            <div class="form-group">
                <label class="form-label">Años de Experiencia <span class="req">*</span></label>
                @php
                    $currentExp = old('años_experiencia', $medico->años_experiencia);
                @endphp
                <div class="exp-selector">
                    <button type="button" class="exp-btn {{ $currentExp == '1-3' ? 'selected' : '' }}" data-value="1-3" onclick="selectExp(this)">1 - 3 años</button>
                    <button type="button" class="exp-btn {{ $currentExp == '4-7' ? 'selected' : '' }}" data-value="4-7" onclick="selectExp(this)">4 - 7 años</button>
                    <button type="button" class="exp-btn {{ $currentExp == '8-12' ? 'selected' : '' }}" data-value="8-12" onclick="selectExp(this)">8 - 12 años</button>
                    <button type="button" class="exp-btn {{ $currentExp == '13-19' ? 'selected' : '' }}" data-value="13-19" onclick="selectExp(this)">13 - 19 años</button>
                    <button type="button" class="exp-btn {{ $currentExp == '20+' ? 'selected' : '' }}" data-value="20+" onclick="selectExp(this)">20+ años (Senior)</button>
                </div>

                <input type="hidden" name="años_experiencia" id="expHidden" value="{{ $currentExp }}" required>

                <input type="number" name="años_experiencia_custom" id="expCustom"
                       class="form-input" style="display: {{ $currentExp == '20+' ? 'block' : 'none' }}; margin-top: 0.5rem;"
                       value="{{ old('años_experiencia_custom', $medico->años_experiencia_custom ?? '') }}" placeholder="Escriba la cantidad exacta de años">

                @error('años_experiencia') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
        <div class="form-footer">
            <a href="{{ route('medicos.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Actualizar</button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .input-prefix-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-prefix {
        position: absolute;
        left: .85rem;
        color: var(--pearl-400);
        font-size: .85rem;
        font-weight: 500;
        pointer-events: none;
        user-select: none;
    }
    .input-with-prefix {
        padding-left: 2.6rem !important;
    }
    .exp-selector {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: .25rem;
    }
    .exp-btn {
        padding: .4rem .9rem;
        border-radius: 8px;
        border: 1.5px solid var(--pearl-200);
        background: transparent;
        color: var(--pearl-500);
        font-size: .82rem;
        font-weight: 500;
        cursor: pointer;
        transition: all .18s;
    }
    .exp-btn:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: var(--accent-subtle, rgba(99,102,241,.07));
    }
    .exp-btn.selected {
        border-color: var(--accent);
        background: var(--accent);
        color: #fff;
    }
</style>
@endpush

@push('scripts')
<script>
function selectExp(btn) {
    document.querySelectorAll('.exp-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    document.getElementById('expHidden').value = btn.dataset.value;
    const custom = document.getElementById('expCustom');
    if (btn.dataset.value === '20+') {
        custom.style.display = 'block';
    } else {
        custom.style.display = 'none';
        custom.value = '';
    }
}
</script>
@endpush
@endsection
