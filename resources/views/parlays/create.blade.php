@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Crear Nuevo Parlay</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('parlays.store') }}" method="POST" id="parlay-form">
                        @csrf

                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre Parlay</label>
                            <input type="text" name="nombre" id="nombre" 
                                    class="form-control @error('nombre') is-invalid @enderror" 
                                    value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="user_id">Usuario</label>
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                                    <option value="">Seleccione un usuario</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tipster_id">Tipster</label>
                                <select name="tipster_id" id="tipster_id" class="form-control @error('tipster_id') is-invalid @enderror" required>
                                    <option value="">Seleccione un tipster</option>
                                    @foreach($tipsters as $tipster)
                                        <option value="{{ $tipster->id }}" {{ old('tipster_id') == $tipster->id ? 'selected' : '' }}>
                                            {{ $tipster->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tipster_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
<!-- 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha</label>
                                <input type="datetime-local" name="fecha" id="fecha" 
                                       class="form-control @error('fecha') is-invalid @enderror" 
                                       value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}" required>
                                @error('fecha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->
<!-- 
                            <div class="form-group col-md-6">
                                <label for="monto">Monto</label>
                                <input type="number" step="0.01" name="monto" id="monto" 
                                       class="form-control @error('monto') is-invalid @enderror" 
                                       value="{{ old('monto') }}" required>
                                @error('monto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->
                        </div>

                     

                        <!-- <div class="form-group">
                            <label for="ganancia_potencial">Ganancia Potencial</label>
                            <input type="text" id="ganancia_potencial" class="form-control" readonly>
                            <input type="hidden" name="cuotas[]" id="cuotas-hidden">
                        </div> -->

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Parlay
                            </button>
                            <a href="{{ route('parlays.index') }}" class="btn btn-secondary">
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

@push('scripts')
<script>
    $(document).ready(function() {
        function calcularGanancia() {
            const monto = parseFloat($('#monto').val()) || 0;
            let ganancia = monto;
            const cuotas = [];
            
            $('.apuesta-checkbox:checked').each(function() {
                const cuota = parseFloat($(this).data('cuota'));
                ganancia *= cuota;
                cuotas.push(cuota);
            });
            
            $('#ganancia_potencial').val('$' + ganancia.toFixed(2));
            $('#cuotas-hidden').val(JSON.stringify(cuotas));
        }

        $('#monto, .apuesta-checkbox').change(function() {
            calcularGanancia();
        });

        // Validación mínimo 2 apuestas
        $('#parlay-form').submit(function(e) {
            if ($('.apuesta-checkbox:checked').length < 2) {
                e.preventDefault();
                alert('Debes seleccionar al menos 2 apuestas para crear un parlay');
            }
        });
    });
</script>
@endpush