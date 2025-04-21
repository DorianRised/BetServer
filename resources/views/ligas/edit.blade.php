@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ isset($liga) ? 'Editar' : 'Crear' }} Liga</h1>
                </div>

                <div class="card-body">
                    <form action="{{ isset($liga) ? route('ligas.update', $liga) : route('ligas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($liga)) @method('PUT') @endif

                        <div class="form-group">
                            <label for="nombre">Nombre de la Liga</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $liga->nombre ?? '') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pais">País</label>
                            <input type="text" name="pais" id="pais" class="form-control @error('pais') is-invalid @enderror" 
                                   value="{{ old('pais', $liga->pais ?? '') }}" required>
                            @error('pais')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img_liga">Logo/Imagen</label>
                            <input type="file" name="img_liga" id="img_liga" class="form-control-file @error('img_liga') is-invalid @enderror">
                            @error('img_liga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if(isset($liga) && $liga->img_liga)
                                <div class="mt-2">
                                    <img src="{{ $liga->imagen_url }}" alt="Imagen actual" width="100" class="img-thumbnail">
                                    <p class="text-muted small mt-1">Imagen actual</p>
                                </div>
                            @endif

                            <label for="deporte_id">Deporte</label>
                            <select name="deporte_id" id="deporte_id" class="form-control @error('deporte_id') is-invalid @enderror" required>
                                <option value="">Seleccione un deporte</option>
                                @foreach($deportes as $deporte)
                                    <option value="{{ $deporte->id }}" 
                                        {{ (old('deporte_id', $liga->deporte_id ?? '') == $deporte->id ? 'selected' : '') }}>
                                        {{ $deporte->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('deporte_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                            <a href="{{ route('ligas.index') }}" class="btn btn-secondary">
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