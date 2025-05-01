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

                        <!-- Sección Deporte/Liga/Evento -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-trophy"></i> Información del Evento</h5>
                            </div>
                            <div class="card-body">
                                <!-- Deporte -->
                                <div class="form-group mb-3">
                                    <label for="deporte_id" class="form-label">⚽ Deporte *</label>
                                    <select class="form-select @error('deporte_id') is-invalid @enderror" 
                                            id="deporte_id" name="deporte_id" required>
                                        <option value="">Seleccione un Deporte</option>
                                        @foreach($deportes as $deporte)
                                            <option value="{{ $deporte->id }}" {{ old('deporte_id') == $deporte->id ? 'selected' : '' }}>
                                                {{ $deporte->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('deporte_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Liga (dependiente de deporte) -->
                                <div class="form-group mb-3" id="liga-container" style="display: none;">
                                    <label for="liga_id" class="form-label">🏆 Liga *</label>
                                    <select class="form-select @error('liga_id') is-invalid @enderror" 
                                            id="liga_id" name="liga_id" required disabled>
                                        <option value="">Seleccione una Liga</option>
                                    </select>
                                    @error('liga_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Evento (dependiente de liga) -->
                                <div class="form-group mb-3" id="evento-container" style="display: none;">
                                    <label for="evento_id" class="form-label">🏟️ Evento *</label>
                                    <select class="form-select @error('evento_id') is-invalid @enderror" 
                                            id="evento_id" name="evento_id" required disabled>
                                        <option value="">Seleccione un Evento</option>
                                    </select>
                                    @error('evento_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Fecha del Evento (autocompletado al seleccionar evento) -->
                                <div class="form-group mb-3" id="fecha-container" style="display: none;">
                                    <label for="fecha_evento" class="form-label">📅 Fecha del evento *</label>
                                    <input type="datetime-local" class="form-control @error('fecha_evento') is-invalid @enderror" 
                                           id="fecha_evento" name="fecha_evento" value="{{ old('fecha_evento') }}" required readonly>
                                    @error('fecha_evento')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección Grupo/Tipster -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-users"></i> Información del Tipster</h5>
                            </div>
                            <div class="card-body">
                                <!-- Grupo -->
                                <div class="form-group mb-3">
                                    <label for="grupo_id" class="form-label">👥 Grupo</label>
                                    <select class="form-select @error('grupo_id') is-invalid @enderror" 
                                            id="grupo_id" name="grupo_id">
                                        <option value="">Sin grupo</option>
                                        @foreach($grupos as $grupo)
                                            <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                                {{ $grupo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('grupo_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tipster (dependiente de grupo) -->
                                <div class="form-group mb-3">
                                    <label for="tipster_id" class="form-label">🎯 Tipster *</label>
                                    <select class="form-select @error('tipster_id') is-invalid @enderror" 
                                            id="tipster_id" name="tipster_id" required>
                                        <option value="">Seleccione un Tipster</option>
                                        @foreach($tipsters as $tipster)
                                            <option value="{{ $tipster->id }}" {{ old('tipster_id') == $tipster->id ? 'selected' : '' }}>
                                                {{ $tipster->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipster_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Sección Detalles de la Apuesta -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-info-circle"></i> Detalles de la Apuesta</h5>
                            </div>
                            <div class="card-body">
                                <!-- Tipo -->
                                <div class="form-group mb-3">
                                    <label for="tipo" class="form-label">🧾 Tipo *</label>
                                    <select class="form-select @error('tipo') is-invalid @enderror" 
                                            id="tipo" name="tipo" required>
                                        <option value="">Seleccione el tipo</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>
                                                {{ $tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Apuesta -->
                                <div class="form-group mb-3">
                                    <label for="apuesta" class="form-label">🎲 Apuesta *</label>
                                    <input type="text" class="form-control @error('apuesta') is-invalid @enderror" 
                                           id="apuesta" name="apuesta" value="{{ old('apuesta') }}" required>
                                    @error('apuesta')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tipo de Apuesta -->
                                <div class="form-group mb-3">
                                    <label for="tipo_apuesta_id" class="form-label">🔖 Tipo de apuesta *</label>
                                    <select class="form-select @error('tipo_apuesta_id') is-invalid @enderror" 
                                            id="tipo_apuesta_id" name="tipo_apuesta_id" required>
                                        <option value="">Seleccione el tipo de apuesta</option>
                                        @foreach($tipoApuestas as $tipoApuesta)
                                            <option value="{{ $tipoApuesta->id }}" {{ old('tipo_apuesta_id') == $tipoApuesta->id ? 'selected' : '' }}>
                                                {{ $tipoApuesta->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo_apuesta_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Monto -->
                                <div class="form-group mb-3">
                                    <label for="monto" class="form-label">💰 Monto *</label>
                                    <input type="number" step="0.01" class="form-control @error('monto') is-invalid @enderror" 
                                           id="monto" name="monto" value="{{ old('monto') }}" required>
                                    @error('monto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Cuota -->
                                <div class="form-group mb-3">
                                    <label for="cuota" class="form-label">📈 Cuota *</label>
                                    <input type="number" step="0.01" class="form-control @error('cuota') is-invalid @enderror" 
                                           id="cuota" name="cuota" value="{{ old('cuota') }}" required>
                                    @error('cuota')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Ganancia Total -->
                                <div class="form-group mb-3">
                                    <label for="ganancia_total" class="form-label">🏆 Ganancia Total</label>
                                    <input type="number" step="0.01" class="form-control @error('ganancia_total') is-invalid @enderror" 
                                           id="ganancia_total" name="ganancia_total" value="{{ old('ganancia_total') }}" readonly>
                                    @error('ganancia_total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Parlay ID -->
                                <div class="form-group mb-3">
                                    <label for="parlay_id" class="form-label">🧩 ID Parlay</label>
                                    <input type="text" class="form-control @error('parlay_id') is-invalid @enderror" 
                                           id="parlay_id" name="parlay_id" value="{{ old('parlay_id') }}">
                                    @error('parlay_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Resultado -->
                                <div class="form-group mb-3">
                                    <label for="resultado" class="form-label">📌 Resultado *</label>
                                    <select class="form-select @error('resultado') is-invalid @enderror" 
                                            id="resultado" name="resultado" required>
                                        <option value="Pendiente" {{ old('resultado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Ganada" {{ old('resultado') == 'Ganada' ? 'selected' : '' }}>Ganada</option>
                                        <option value="Perdida" {{ old('resultado') == 'Perdida' ? 'selected' : '' }}>Perdida</option>
                                        <option value="Nula" {{ old('resultado') == 'Nula' ? 'selected' : '' }}>Nula</option>
                                    </select>
                                    @error('resultado')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('apuesta-form');
        
        // Elementos del formulario
        const deporteSelect = document.getElementById('deporte_id');
        const ligaContainer = document.getElementById('liga-container');
        const ligaSelect = document.getElementById('liga_id');
        const eventoContainer = document.getElementById('evento-container');
        const eventoSelect = document.getElementById('evento_id');
        const fechaContainer = document.getElementById('fecha-container');
        const fechaInput = document.getElementById('fecha_evento');
        const grupoSelect = document.getElementById('grupo_id');
        const tipsterSelect = document.getElementById('tipster_id');
        const montoInput = document.getElementById('monto');
        const cuotaInput = document.getElementById('cuota');
        const gananciaInput = document.getElementById('ganancia_total');

        // Función para cargar Tipsters por Grupo (versión mejorada)
        function cargarTipstersPorGrupo(grupoId) {
            tipsterSelect.innerHTML = '<option value="">Seleccione un Tipster</option>';
            
            const url = grupoId ? `/api/grupos/${grupoId}/tipsters` : '/api/grupos/0/tipsters';
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    data.forEach(tipster => {
                        const option = document.createElement('option');
                        option.value = tipster.id;
                        option.textContent = tipster.nombre;
                        
                        // Agregar atributo data-grupos si está disponible
                        if (tipster.grupos) {
                            option.dataset.grupos = tipster.grupos.map(g => g.id).join(',');
                        }
                        
                        tipsterSelect.appendChild(option);
                    });
                    
                    // Seleccionar valor anterior si existe
                    if ("{{ old('tipster_id') }}") {
                        tipsterSelect.value = "{{ old('tipster_id') }}";
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        // Cargar ligas cuando se selecciona un deporte
        deporteSelect.addEventListener('change', function() {
            const deporteId = this.value;
            
            // Resetear campos dependientes
            ligaSelect.innerHTML = '<option value="">Seleccione una Liga</option>';
            eventoSelect.innerHTML = '<option value="">Seleccione un Evento</option>';
            fechaInput.value = '';
            
            if (deporteId) {
                ligaContainer.style.display = 'block';
                ligaSelect.disabled = false;
                eventoContainer.style.display = 'none';
                eventoSelect.disabled = true;
                fechaContainer.style.display = 'none';
                fechaInput.disabled = true;
                
                // Cargar ligas del deporte seleccionado
                fetch(`/api/deportes/${deporteId}/ligas`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(liga => {
                            const option = document.createElement('option');
                            option.value = liga.id;
                            option.textContent = liga.nombre;
                            ligaSelect.appendChild(option);
                        });
                        
                        // Seleccionar valor anterior si existe
                        if ("{{ old('liga_id') }}") {
                            ligaSelect.value = "{{ old('liga_id') }}";
                            if (ligaSelect.value) {
                                ligaSelect.dispatchEvent(new Event('change'));
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                ligaContainer.style.display = 'none';
                ligaSelect.disabled = true;
                eventoContainer.style.display = 'none';
                eventoSelect.disabled = true;
                fechaContainer.style.display = 'none';
                fechaInput.disabled = true;
            }
        });
        
        // Cargar eventos cuando se selecciona una liga
        ligaSelect.addEventListener('change', function() {
            const ligaId = this.value;
            
            // Resetear campos dependientes
            eventoSelect.innerHTML = '<option value="">Seleccione un Evento</option>';
            fechaInput.value = '';
            
            if (ligaId) {
                eventoContainer.style.display = 'block';
                eventoSelect.disabled = false;
                fechaContainer.style.display = 'none';
                fechaInput.disabled = true;
                
                // Cargar eventos de la liga seleccionada
                fetch(`/api/ligas/${ligaId}/eventos`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(evento => {
                            const option = document.createElement('option');
                            option.value = evento.id;
                            option.textContent = `${evento.nombre} (${evento.fecha_legible})`;
                            option.dataset.fecha = evento.fecha_evento;
                            eventoSelect.appendChild(option);
                        });
                        
                        // Seleccionar valor anterior si existe
                        if ("{{ old('evento_id') }}") {
                            eventoSelect.value = "{{ old('evento_id') }}";
                            if (eventoSelect.value) {
                                eventoSelect.dispatchEvent(new Event('change'));
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                eventoContainer.style.display = 'none';
                eventoSelect.disabled = true;
                fechaContainer.style.display = 'none';
                fechaInput.disabled = true;
            }
        });
        
        // Autocompletar fecha cuando se selecciona un evento
        eventoSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            
            if (selectedOption && selectedOption.dataset.fecha) {
                // Convertir la fecha al formato correcto para el input datetime-local
                const fechaEvento = new Date(selectedOption.dataset.fecha);
                const formattedDate = fechaEvento.toISOString().slice(0, 16);
                
                fechaInput.value = formattedDate;
                fechaContainer.style.display = 'block';
                fechaInput.disabled = false;
            } else {
                fechaInput.value = '';
                fechaContainer.style.display = 'none';
                fechaInput.disabled = true;
            }
        });
        
        // Filtrar tipsters cuando se selecciona un grupo (versión mejorada)
        grupoSelect.addEventListener('change', function() {
            const grupoId = this.value;
            cargarTipstersPorGrupo(grupoId);
        });
        
        // Inicializar los selects con datos antiguos (si hay)
        if ("{{ old('deporte_id') }}") {
            deporteSelect.value = "{{ old('deporte_id') }}";
            if (deporteSelect.value) {
                deporteSelect.dispatchEvent(new Event('change'));
            }
        }
        
        if ("{{ old('grupo_id') }}") {
            grupoSelect.value = "{{ old('grupo_id') }}";
            // Usamos la nueva función para cargar tipsters
            cargarTipstersPorGrupo("{{ old('grupo_id') }}");
        } else {
            // Cargar todos los tipsters inicialmente
            cargarTipstersPorGrupo();
        }
        
        // Calcular ganancia total automáticamente
        function calcularGanancia() {
            if (montoInput.value && cuotaInput.value) {
                const ganancia = parseFloat(montoInput.value) * parseFloat(cuotaInput.value);
                gananciaInput.value = ganancia.toFixed(2);
            } else {
                gananciaInput.value = '';
            }
        }
        
        montoInput.addEventListener('input', calcularGanancia);
        cuotaInput.addEventListener('input', calcularGanancia);
        
        // Validación del formulario mejorada
        form.addEventListener('submit', function(event) {
            let isValid = true;
            const errorMessages = [];
            
            // Validar campos numéricos
            const monto = parseFloat(montoInput.value);
            const cuota = parseFloat(cuotaInput.value);
            
            if (!monto || monto <= 0) {
                errorMessages.push('El monto debe ser mayor que cero');
                isValid = false;
                montoInput.classList.add('is-invalid');
            } else {
                montoInput.classList.remove('is-invalid');
            }
            
            if (!cuota || cuota < 1) {
                errorMessages.push('La cuota debe ser mayor o igual a 1');
                isValid = false;
                cuotaInput.classList.add('is-invalid');
            } else {
                cuotaInput.classList.remove('is-invalid');
            }
            
            // Validar selección de evento
            if (!eventoSelect.value) {
                errorMessages.push('Debe seleccionar un evento');
                isValid = false;
                eventoSelect.classList.add('is-invalid');
            } else {
                eventoSelect.classList.remove('is-invalid');
            }
            
            // Validar fecha
            const fechaEvento = new Date(fechaInput.value);
            const hoy = new Date();
            
            if (fechaEvento < hoy) {
                if (!confirm('La fecha del evento es anterior a hoy. ¿Estás seguro de que es correcta?')) {
                    isValid = false;
                }
            }
            
            // Mostrar todos los errores juntos
            if (errorMessages.length > 0) {
                alert('Por favor corrija los siguientes errores:\n\n' + errorMessages.join('\n'));
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Inicializar cálculo de ganancia si hay valores antiguos
        if ("{{ old('monto') }}" && "{{ old('cuota') }}") {
            montoInput.value = "{{ old('monto') }}";
            cuotaInput.value = "{{ old('cuota') }}";
            calcularGanancia();
        }
    });
</script>
@endpush