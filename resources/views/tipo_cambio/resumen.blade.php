@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
     @include('messages')

    <h1 class="mb-4 text-center">Tipos de Moneda</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('tipo_cambio.create') }}" class="btn btn_crear btn-w" data-bs-toggle="modal" data-bs-target="#crearTipoCambioModal">
                <i class="fa-solid fa-square-plus"></i>Agregar tipo de cambio
            </a>
            @include('tipo_cambio.create', ['monedas' => $monedas ?? \App\Models\TipoMoneda::all()])
        </div>
        <div>
            <a href="{{ route('tipo_cambio.index') }}" class="btn btn-success btn-w"><i class="fa-solid fa-file-invoice-dollar"></i>Ver Cambios</a>
        </div>
    </div>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Código ISO</th>
                <th>Último Valor de Cambio</th>
                <th>Fecha del Cambio</th>
    
            </tr>
        </thead>
        <tbody>
            @foreach($monedas as $moneda)
                <tr>
                    <td>{{ $moneda->id }}</td>
                    <td>{{ $moneda->nombre }}</td>
                    <td>{{ $moneda->codigo_iso }}</td>
                    <td>
                        {{ $moneda->ultimoCambio?->valor_cambio ?? '—' }}
                    </td>
                    <td>
                        {{ $moneda->ultimoCambio?->fecha ?? '—' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

<!-- Bootstrap Icons (Bootstrap 5 oficial) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

<!-- Font Awesome (opcional, solo si lo usas) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Tus estilos personalizados -->
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />




 <style>
        .btn-w i {
            margin-right: 4px; /* Espaciado entre el icono y el texto */
        }
    
        table tbody td {
            background-color: rgb(255, 249, 249);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-bordered {
            border-color: #fe495f;
        }
        table th, table td {
            text-align: center;
        }
        td {
            width: 1%;  
            white-space: nowrap; 
        }
    </style>
@stop
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- DataTables CSS y JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>>


@stop

