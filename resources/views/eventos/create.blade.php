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

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="liga_id">Liga</label>
                                <select name="liga_id" id="liga_id" class="form-control @error('liga_id') is-invalid @enderror" required>
                                    <option value="">Seleccione una liga</option>
                                    @foreach($ligas as $liga)
                                        <option value="{{ $liga->id }}" {{ old('liga_id') == $liga->id ? 'selected' : '' }}>{{ $liga->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('liga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
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
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha y Hora</label>
                            <input type="datetime-local" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha') }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
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