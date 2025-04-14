@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>{{ isset($deporte) ? 'Editar' : 'Crear' }} Deporte</h1>
                </div>

                <div class="card-body">
                    <form action="{{ isset($deporte) ? route('deportes.update', $deporte) : route('deportes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($deporte)) @method('PUT') @endif

                        <div class="form-group">
                            <label for="nombre">Nombre del Deporte</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre', $deporte->nombre ?? '') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="img_deporte">Imagen del Deporte</label>
                            <input type="file" name="img_deporte" id="img_deporte" class="form-control-file @error('img_deporte') is-invalid @enderror">
                            @error('img_deporte')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if(isset($deporte) && $deporte->img_deporte)
                                <div class="mt-2">
                                    <img src="{{ $deporte->imagen_url }}" alt="Imagen actual" width="100" class="img-thumbnail">
                                    <p class="text-muted small mt-1">Imagen actual</p>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                            <a href="{{ route('deportes.index') }}" class="btn btn-secondary">
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