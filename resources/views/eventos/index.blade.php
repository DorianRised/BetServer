@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Eventos</h1>
                    <a href="{{ route('eventos.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Evento
                    </a>
                </div>

                <div class="card-body">
                    <table id="eventos-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Liga</th>
                                <th>Deporte</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($eventos as $evento)
                            <tr>
                                <td>{{ $evento->nombre }}</td>
                                <td>{{ $evento->liga->nombre ?? 'N/A' }}</td>
                                <td>{{ $evento->deporte->nombre ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm btn-primary">
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
        $('#eventos-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "responsive": true,
            "order": [[3, "desc"]] // Ordenar por fecha descendente por defecto
        });
    });
</script>
@endpush