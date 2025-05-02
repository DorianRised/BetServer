@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Parlays</h1>
                    <a href="{{ route('parlays.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Parlay
                    </a>
                </div>

                <div class="card-body">
                    <table id="parlays-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Tipster</th>
                                <th>Apuestas</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parlays as $parlay)
                            <tr>
                                <td>{{$parlay->nombre }}</td>
                                <td>{{ $parlay->user->name }}</td>
                                <td>{{ $parlay->tipster->nombre }}</td>
                                <td>{{ $parlay->apuestas->count() }}</td>
                                <td>
                                    @php
                                        $badgeClass = [
                                            'pendiente' => 'warning',
                                            'ganado' => 'success',
                                            'perdido' => 'danger',
                                            'cashout' => 'info',
                                            '' => 'secondary',
                                        ][$parlay->estado];
                                    @endphp
                                    <span class="badge badge-{{ $badgeClass }}">
                                        {{ ucfirst($parlay->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('parlays.show', $parlay) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('parlays.edit', $parlay) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('parlays.destroy', $parlay) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este parlay?')">
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
        $('#parlays-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "order": [[2, "desc"]],
            "columnDefs": [
                {
                    "targets": [3, 4], // Columnas de Monto y Ganancia
                    "type": "num",
                    "render": function(data, type) {
                        if (type === 'display' || type === 'filter') {
                            return data.replace(/[$,]/g, '');
                        }
                        return data;
                    }
                },
                {
                    "targets": [7], // Columna de Acciones
                    "orderable": false,
                    "searchable": false
                }
            ]
        });
    });
</script>
@endpush