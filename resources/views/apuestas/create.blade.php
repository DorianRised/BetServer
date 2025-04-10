@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0"><i class="fas fa-plus-circle"></i> Crear Nueva Apuesta</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('apuestas.store') }}" id="apuesta-form">
                        @csrf

                        @foreach([
                            ['name' => 'fecha_evento', 'label' => '📅 Fecha del evento', 'type' => 'datetime-local', 'required' => true],
                            ['name' => 'tipster', 'label' => '🎯 Tipster', 'type' => 'text', 'required' => true],
                            ['name' => 'grupo', 'label' => '👥 Grupo', 'type' => 'text', 'required' => false],
                            ['name' => 'tipo', 'label' => '🧾 Tipo', 'type' => 'select', 'options' => ['Simple', 'Combinada', 'Parlay'], 'required' => true],
                            ['name' => 'evento', 'label' => '🏟️ Evento', 'type' => 'text', 'required' => true],
                            ['name' => 'apuesta', 'label' => '🎲 Apuesta', 'type' => 'text', 'required' => true],
                            ['name' => 'tipo_apuesta', 'label' => '🔖 Tipo de apuesta', 'type' => 'select', 'options' => ['1X2', 'Handicap', 'Over/Under', 'Goles', 'Corner'], 'required' => true],
                            ['name' => 'monto', 'label' => '💰 Monto', 'type' => 'number', 'step' => '0.01', 'required' => true],
                            ['name' => 'cuota', 'label' => '📈 Cuota', 'type' => 'number', 'step' => '0.01', 'required' => true],
                            ['name' => 'ganancia_total', 'label' => '🏆 Ganancia Total', 'type' => 'number', 'step' => '0.01', 'required' => false],
                            ['name' => 'liga', 'label' => '🏆 Liga', 'type' => 'text', 'required' => true],
                            ['name' => 'deporte', 'label' => '⚽ Deporte', 'type' => 'select', 'options' => ['Fútbol', 'Tenis', 'Baloncesto', 'Béisbol', 'Hockey'], 'required' => true],
                            ['name' => 'parlay_id', 'label' => '🧩 ID Parlay', 'type' => 'text', 'required' => false],
                            ['name' => 'resultado', 'label' => '📌 Resultado', 'type' => 'select', 'options' => ['Pendiente', 'Ganada', 'Perdida', 'Nula'], 'required' => true]
                        ] as $field)
                        
                        <div class="form-group mb-3">
                            <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                            
                            @if($field['type'] == 'select')
                                <select class="form-select @error($field['name']) is-invalid @enderror" 
                                        id="{{ $field['name'] }}" 
                                        name="{{ $field['name'] }}"
                                        {{ $field['required'] ? 'required' : '' }}>
                                    <option value="">Seleccione...</option>
                                    @foreach($field['options'] as $option)
                                        <option value="{{ $option }}" {{ old($field['name']) == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="{{ $field['type'] }}" 
                                       class="form-control @error($field['name']) is-invalid @enderror" 
                                       id="{{ $field['name'] }}" 
                                       name="{{ $field['name'] }}" 
                                       value="{{ old($field['name']) }}"
                                       {{ isset($field['step']) ? 'step='.$field['step'] : '' }}
                                       {{ $field['required'] ? 'required' : '' }}>
                            @endif
                            
                            @error($field['name'])
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endforeach

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Guardar Apuesta
                            </button>
                            <a href="{{ route('apuestas.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Validación del formulario -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('apuesta-form');
        
        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validar campos numéricos
            const monto = parseFloat(form.elements['monto'].value);
            const cuota = parseFloat(form.elements['cuota'].value);
            
            if (monto <= 0) {
                alert('El monto debe ser mayor que cero');
                isValid = false;
            }
            
            if (cuota < 1) {
                alert('La cuota debe ser mayor o igual a 1');
                isValid = false;
            }
            
            // Validar fecha
            const fechaEvento = new Date(form.elements['fecha_evento'].value);
            const hoy = new Date();
            
            if (fechaEvento < hoy) {
                if (!confirm('La fecha del evento es anterior a hoy. ¿Estás seguro de que es correcta?')) {
                    isValid = false;
                }
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // Calcular ganancia total automáticamente
        const montoInput = document.getElementById('monto');
        const cuotaInput = document.getElementById('cuota');
        const gananciaInput = document.getElementById('ganancia_total');
        
        function calcularGanancia() {
            if (montoInput.value && cuotaInput.value) {
                const ganancia = parseFloat(montoInput.value) * parseFloat(cuotaInput.value);
                gananciaInput.value = ganancia.toFixed(2);
            }
        }
        
        montoInput.addEventListener('input', calcularGanancia);
        cuotaInput.addEventListener('input', calcularGanancia);
    });
</script>
@endpush