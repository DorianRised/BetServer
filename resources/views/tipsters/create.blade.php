@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Crear Nuevo Tipster</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('tipsters.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="nombre">Nombre del Tipster</label>
                            <input type="text" name="nombre" id="nombre" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pais">País del Tipster</label>
                            <input type="text" name="pais" id="pais" 
                                   class="form-control @error('pais') is-invalid @enderror" 
                                   value="{{ old('pais') }}" required>
                            @error('pais')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id">Usuario Asociado</label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} {{ $user->a_paterno }} {{ $user->a_materno }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="grupo_id">Grupo</label>
                            <select name="grupo_id" id="grupo_id" class="form-control @error('grupo_id') is-invalid @enderror" required>
                                <option value="">Seleccione un grupo</option>
                                @foreach($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                        {{ $grupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grupo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Tipster
                            </button>
                            <a href="{{ route('tipsters.index') }}" class="btn btn-secondary">
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