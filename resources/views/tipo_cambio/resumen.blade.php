@extends('adminlte::page')

@section('title', 'Cambio de moneda')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
     @include('messages')

    <h1 class="mb-4 text-center">Tipos de Moneda</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="#" class="btn btn_crear btn-w" data-toggle="modal" data-target="#crearTipoCambioModal">
                <i class="fa fa-plus-square"></i> Agregar tipo de cambio
            </a>
            @include('tipo_cambio.create', ['monedas' => $monedas ?? \App\Models\TipoMoneda::all()])
        </div>
        <div>
            <a href="{{ route('tipo_cambio.index') }}" class="btn btn-success btn-w"><i class="fas fa-file-invoice-dollar"></i> Ver Cambios</a>
        </div>
    </div>

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Código ISO</th>
                <th>Último Valor de Compra</th>
                <th>Último Valor de Venta</th>
                <th>Fecha del Cambio</th>
    
            </tr>
        </thead>
            <tbody>
            @if ($moneda)
                <tr>
                    <td>{{ $moneda->id }}</td>
                    <td>{{ $moneda->nombre }}</td>
                    <td>{{ $moneda->codigo_iso }}</td>
                    <td>{{ $moneda->ultimoCambio?->valor_compra ?? '—' }}</td>
                    <td>{{ $moneda->ultimoCambio?->valor_venta ?? '—' }}</td>
                    <td>{{ $moneda->ultimoCambio?->fecha ?? '—' }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="6" class="text-center">No se encontró información del dólar.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop
@section('js')
@stop

