@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Detalles del Deporte</h1>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($deporte->img_deporte)
                            <img src="{{ $deporte->imagen_url }}" alt="{{ $deporte->nombre }}" class="img-fluid rounded" style="max-height: 200px;">
                        @else
                            <div class="bg-light p-5 text-muted">No hay imagen</div>
                        @endif
                    </div>

                    <dl class="row">
                        <dt class="col-sm-3">Nombre:</dt>
                        <dd class="col-sm-9">{{ $deporte->nombre }}</dd>

                        <dt class="col-sm-3">Creado:</dt>
                        <dd class="col-sm-9">{{ $deporte->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-3">Actualizado:</dt>
                        <dd class="col-sm-9">{{ $deporte->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('deportes.edit', $deporte) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('deportes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection