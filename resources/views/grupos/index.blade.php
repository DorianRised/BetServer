@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Grupos</h1>
                    <a href="{{ route('grupos.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Grupo
                    </a>
                </div>

                <div class="card-body">
                    <table id="grupos-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grupos as $grupo)
                            <tr>
                                <td>{{ $grupo->nombre }}</td>
                                <td>{{ $grupo->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('grupos.show', $grupo->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este grupo?')">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#grupos-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "order": [[1, "desc"]],
            "columnDefs": [
                {
                    "targets": [2], // Columna de Acciones
                    "orderable": false,
                    "searchable": false
                }
            ]
        });
    });
</script>
@endpush