@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Listado de Equipos</h1>
            <a href="{{ route('equipos.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo Equipo
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Deporte</th>
                        <th>Categoría</th>
                        <th>País</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($equipos as $equipo)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $equipo->logo) }}" alt="{{ $equipo->nombre }}" 
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        </td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->deporte->nombre ?? 'N/A' }}</td>
                        <td>{{ $equipo->categoria }}</td>
                        <td>{{ $equipo->pais }}</td>
                        <td>
                            <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este equipo?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $equipos->links() }}
        </div>
    </div>
</div>
@endsection