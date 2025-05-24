@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Crear Nuevo Equipo</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('equipos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del Equipo</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deporte_id">Deporte</label>
                            <select class="form-control @error('deporte_id') is-invalid @enderror" 
                                    id="deporte_id" name="deporte_id" required>
                                <option value="">Seleccione un deporte</option>
                                @foreach($deportes as $deporte)
                                    <option value="{{ $deporte->id }}" {{ old('deporte_id') == $deporte->id ? 'selected' : '' }}>
                                        {{ $deporte->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('deporte_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="categoria">Categoría</label>
                            <select class="form-control @error('categoria') is-invalid @enderror" 
                                    id="categoria" name="categoria" required>
                                <option value="">Seleccione categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria }}" {{ old('categoria') == $categoria ? 'selected' : '' }}>
                                        {{ $categoria }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="pais">País</label>
                            <select class="form-control @error('pais') is-invalid @enderror" 
                                    id="pais" name="pais" required>
                                <option value="">Seleccione país</option>
                                @foreach($paises as $pais)
                                    <option value="{{ $pais }}" {{ old('pais') == $pais ? 'selected' : '' }}>
                                        {{ $pais }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pais')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo">Logo del Equipo</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Formatos: jpeg, png, jpg, gif (Max: 2MB)</small>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                            <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
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