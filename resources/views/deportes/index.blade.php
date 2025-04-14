@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Deportes</h1>
                    <a href="{{ route('deportes.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Deporte
                    </a>
                </div>

                <div class="card-body">
                    <table id="deportes-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deportes as $deporte)
                            <tr>
                                <td>{{ $deporte->nombre }}</td>
                                <td>
                                    @if($deporte->img_deporte)
                                        <img src="{{ Storage::url($deporte->img_deporte) }}" alt="{{ $deporte->nombre }}" width="50" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('deportes.show', $deporte->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('deportes.edit', $deporte->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('deportes.destroy', $deporte->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este deporte?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Incluir DataTables CSS y JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Inicializar DataTable -->
<script>
    $(document).ready(function() {
        $('#deportes-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "responsive": true,
            "order": [[2, "desc"]], // Ordenar por fecha de creación descendente
            "columnDefs": [
                {
                    "targets": [1, 3], // Columnas de Imagen y Acciones
                    "orderable": false, // No permitir ordenación
                    "searchable": false // No permitir búsqueda
                }
            ]
        });
    });
</script>
@endpush