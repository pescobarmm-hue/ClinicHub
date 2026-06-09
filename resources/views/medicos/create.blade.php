@extends('layouts.app')

@section('title', 'Nuevo Médico')
@section('page-title', 'Nuevo Médico')
@section('page-sub', 'Registrar un nuevo especialista')

@section('content')
<div class="form-card">
    <div class="form-header">
        <h3>Registrar médico</h3>
        <p>Complete los datos del profesional.</p>
    </div>
    <form action="{{ route('medicos.store') }}" method="POST">
        @csrf
        <div class="form-body">

            {{-- Nombre / Apellido --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nombre <span class="req">*</span></label>
                    <input type="text" name="nombre"
                        class="form-input @error('nombre') is-invalid @enderror"
                        value="{{ old('nombre') }}"
                        placeholder="Ej. Carlos"
                        required>
                    @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido"
                        class="form-input"
                        value="{{ old('apellido') }}"
                        placeholder="Ej. Ramírez Torres">
                </div>
            </div>

            {{-- Especialidad / Teléfono --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Especialidad <span class="req">*</span></label>
                    <input type="text" name="especialidad"
                        class="form-input @error('especialidad') is-invalid @enderror"
                        value="{{ old('especialidad') }}"
                        placeholder="Ej. Cardiología"
                        required>
                    @error('especialidad') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <div class="input-prefix-wrap">
                        <span class="input-prefix">+51</span>
                        <input type="text" name="telefono"
                            class="form-input input-with-prefix"
                            value="{{ old('telefono') }}"
                            placeholder="999 999 999">
                    </div>
                </div>
            </div>

            {{-- Email / Licencia --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="medico@clinica.com">
                </div>
                <div class="form-group">
                    <label class="form-label">N.º de licencia</label>
                    <input type="text" name="licencia"
                        class="form-input"
                        value="{{ old('licencia') }}"
                        placeholder="Ej. CMP-12345">
                </div>
            </div>

            {{-- Años de experiencia --}}
            <div class="form-group">
                <label class="form-label">Años de experiencia</label>
                <div class="exp-selector">
                    @foreach([1,2,3,5,8,10,15,20] as $yr)
                    <button type="button"
                        class="exp-btn {{ old('años_experiencia') == $yr ? 'selected' : '' }}"
                        data-value="{{ $yr }}"
                        onclick="selectExp(this)">
                        {{ $yr }} años
                    </button>
                    @endforeach
                    <button type="button"
                        class="exp-btn {{ old('años_experiencia') == '20+' ? 'selected' : '' }}"
                        data-value="20+"
                        onclick="selectExp(this)">
                        +20 años
                    </button>
                </div>
                <input type="hidden" name="años_experiencia" id="expHidden" value="{{ old('años_experiencia') }}">
                <input type="text" id="expCustom" class="form-input" style="margin-top:.6rem;display:none;"
                    placeholder="O escribe un número personalizado..."
                    oninput="document.getElementById('expHidden').value=this.value">
                <small style="color:var(--pearl-400);font-size:.75rem;margin-top:.3rem;display:block;">
                    Selecciona o escribe los años de trayectoria del médico.
                </small>
            </div>

        </div>
        <div class="form-footer">
            <a href="{{ route('medicos.index') }}" class="btn-secondary">Cancelar</a>
            <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Guardar médico</button>
        </div>
    </form>
</div>

@push('styles')
<style>
    /* Prefix de teléfono */
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

    /* Selector de años de experiencia */
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
    // Desmarcar todos los botones del selector
    document.querySelectorAll('.exp-selector .exp-btn').forEach(b => b.classList.remove('selected'));
    // Marcar el actual
    btn.classList.add('selected');
    // Asignar el valor al input oculto
    document.getElementById('expHidden').value = btn.dataset.value;

    // Mostrar campo personalizado si es '20+'
    const custom = document.getElementById('expCustom');
    if (btn.dataset.value === '20+') {
        custom.style.display = 'block';
        custom.setAttribute('required', 'required');
    } else {
        custom.style.display = 'none';
        custom.removeAttribute('required');
    }
}

// REGISTRO SEGURO: Al cargar la página, si Laravel regresa por error de validación, re-activa el botón correcto
document.addEventListener("DOMContentLoaded", function() {
    const oldValue = document.getElementById('expHidden').value;
    if(oldValue) {
        const targetBtn = document.querySelector(`.exp-btn[data-value="${oldValue}"]`);
        if(targetBtn) targetBtn.classList.add('selected');
    }
});
</script>
@endpush
@endsection
