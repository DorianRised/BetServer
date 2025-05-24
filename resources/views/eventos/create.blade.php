@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Crear Nuevo Evento</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('eventos.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Nombre del Evento</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha y Hora</label>
                            <input type="datetime-local" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha') }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="deporte_id">Deporte</label>
                                <select name="deporte_id" id="deporte_id" class="form-control @error('deporte_id') is-invalid @enderror" required>
                                    <option value="">Seleccione un deporte</option>
                                    @foreach($deportes as $deporte)
                                        <option value="{{ $deporte->id }}" {{ old('deporte_id') == $deporte->id ? 'selected' : '' }}>{{ $deporte->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('deporte_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="liga_id">Liga</label>
                                <select name="liga_id" id="liga_id" class="form-control @error('liga_id') is-invalid @enderror" required>
                                    <option value="">Seleccione una liga</option>
                                </select>
                                @error('liga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="equipo_local_id">Equipo Local</label>
                                <select name="equipo_local_id" id="equipo_local_id" class="form-control @error('equipo_local_id') is-invalid @enderror" required>
                                    <option value="">Seleccione equipo local</option>
                                </select>
                                @error('equipo_local_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="equipo_visitante_id">Equipo Visitante</label>
                                <select name="equipo_visitante_id" id="equipo_visitante_id" class="form-control @error('equipo_visitante_id') is-invalid @enderror" required>
                                    <option value="">Seleccione equipo visitante</option>
                                </select>
                                @error('equipo_visitante_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Evento
                            </button>
                            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
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
        document.addEventListener('DOMContentLoaded', function () {
            const deporteSelect = document.getElementById('deporte_id');
            const ligaSelect = document.getElementById('liga_id');
            const localSelect = document.getElementById('equipo_local_id');
            const visitanteSelect = document.getElementById('equipo_visitante_id');
            
            deporteSelect.addEventListener('change', function () {
                const deporteId = this.value;

                // Limpiamos las ligas previas
                ligaSelect.innerHTML = '<option value="">Seleccione una liga</option>';

                if (deporteId) {
                    fetch(`/api/ligas-por-deporte/${deporteId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(liga => {
                                const option = document.createElement('option');
                                option.value = liga.id;
                                option.textContent = liga.nombre;
                                ligaSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                    
                    fetch(`/api/equipos-por-deporte/${deporteId}`)
                        .then(response => response.json())
                        .then(data => {
                            equipos = data;
                            cargarEquipos();
                        });
                }

                function cargarEquipos() {
                    // Limpiar selects
                    localSelect.innerHTML = '<option value="">Seleccione un equipo</option>';
                    visitanteSelect.innerHTML = '<option value="">Seleccione un equipo</option>';

                    equipos.forEach(equipo => {
                        const optionLocal = document.createElement('option');
                        optionLocal.value = equipo.id;
                        optionLocal.textContent = equipo.nombre;
                        localSelect.appendChild(optionLocal);

                        const optionVisitante = document.createElement('option');
                        optionVisitante.value = equipo.id;
                        optionVisitante.textContent = equipo.nombre;
                        visitanteSelect.appendChild(optionVisitante);
                    });
                }

                // Evitar seleccionar el mismo equipo en local y visitante
                localSelect.addEventListener('change', filtrarEquipos);
                visitanteSelect.addEventListener('change', filtrarEquipos);

                function filtrarEquipos() {
                    const localId = localSelect.value;
                    const visitanteId = visitanteSelect.value;

                    // Refrescar opciones
                    cargarEquipos();

                    // Mantener seleccionados si siguen válidos
                    if (localId) localSelect.value = localId;
                    if (visitanteId) visitanteSelect.value = visitanteId;

                    // Quitar equipo local del visitante
                    if (localId) {
                        const optionToRemove = visitanteSelect.querySelector(`option[value="${localId}"]`);
                        if (optionToRemove) optionToRemove.remove();
                    }

                    // Quitar equipo visitante del local
                    if (visitanteId) {
                        const optionToRemove = localSelect.querySelector(`option[value="${visitanteId}"]`);
                        if (optionToRemove) optionToRemove.remove();
                    }
                }
            });
        });
    </script>

@endpush