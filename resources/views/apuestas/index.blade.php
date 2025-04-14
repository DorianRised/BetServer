@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Apuestas</h1>
                    <a href="{{ route('apuestas.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nueva Apuesta
                    </a>
                </div>

                <div class="card-body">
                    <table id="apuestas-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Evento</th>
                                <th>Cantidad</th>
                                <th>Selección</th>
                                <th>Cuota</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apuestas as $apuesta)
                            <tr>
                                <td>{{ $apuesta->id }}</td>
                                <td>{{ $apuesta->usuario->name ?? 'N/A' }}</td>
                                <td>{{ $apuesta->evento->nombre ?? 'N/A' }}</td>
                                <td>{{ number_format($apuesta->cantidad, 2) }}</td>
                                <td>{{ $apuesta->seleccion }}</td>
                                <td>{{ number_format($apuesta->cuota, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $apuesta->estado == 'ganada' ? 'success' : ($apuesta->estado == 'perdida' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($apuesta->estado) }}
                                    </span>
                                </td>
                                <td>{{ $apuesta->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('apuestas.show', $apuesta->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('apuestas.edit', $apuesta->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
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
        $('#apuestas-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "responsive": true,
            "order": [[0, "desc"]]
        });
    });
</script>
@endpush