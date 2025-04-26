@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Listado de Tipsters</h1>
                    <a href="{{ route('tipsters.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Nuevo Tipster
                    </a>
                </div>

                <div class="card-body">
                    <table id="tipsters-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>País</th>
                                <th>Fecha Registro</th>
                                <th>Bank Actual</th>
                                <th>ROI</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipsters as $tipster)
                            <tr>
                                <td>{{ $tipster->nombre }}</td>
                                <td>{{ $tipster->user->name }}</td>
                                <td>{{ $tipster->pais }}</td>
                                <td>{{ \Carbon\Carbon::parse($tipster->fecha_registro)->format('d/m/Y') }}</td>
                                <td class="text-right">{{ $tipster->bank_formateado }}</td>
                                <td class="{{ $tipster->roi >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $tipster->roi_formateado }}
                                </td>
                                <td>
                                    <a href="{{ route('tipsters.show', $tipster) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tipsters.edit', $tipster) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tipsters.destroy', $tipster) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este tipster?')">
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
        $('#tipsters-table').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            },
            "order": [[3, "desc"]],
            "columnDefs": [
                {
                    "targets": [4, 5], // Columnas numéricas
                    "type": "num",
                    "render": function(data, type) {
                        if (type === 'display' || type === 'filter') {
                            return data.replace(/[$,%]/g, '');
                        }
                        return data;
                    }
                },
                {
                    "targets": [6], // Columna de Acciones
                    "orderable": false,
                    "searchable": false
                }
            ]
        });
    });
</script>
@endpush