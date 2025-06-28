@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <div class="form-check mb-3">
        <h1 class="text-center"><a class="float-start" title="Volver" href="{{ route('producto_final.index') }}">
        <i class="bi bi-arrow-left-circle"></i></a>
        Detalle: {{ $producto->articulo->nombre }}</h1>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-6">
                <p><label>Clasificación:</label> {{ $producto->volumen->clasificacion->nombre_clasificacion ?? 'N/A' }}</p>
                <p><label>Volumen:</label> {{ $producto->volumen->nombre ?? ' - ' }}{{ $producto->volumen->clasificacion->unidadMedida->nombre_unidad_de_medida ?? 'N/A' }}</p>
               <label>Estado de Artículo:</label><p class="badge bg-{{ $producto->articulo->estado === 'activo' ? 'success' : 'secondary' }}">{{ $producto->articulo->estado === 'activo' ? 'Activo' : 'Inactivo' }}</p>
            </div>

            <!-- Segunda columna -->
            <div class="col-md-6">
                <h5><label>Costos</label></h5>
                <ul>
                    <li><label>Costo total de producción:</label> S/ {{ number_format($producto->costo_total_produccion, 2) }}</li>
                    <li><label>Costo total real (con IGV):</label> S/ {{ number_format($producto->costo_total_real, 2) }}</li>
                    <li><label>Costo publicado:</label> S/ {{ number_format($producto->costo_total_publicado, 2) }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <!-- Insumos -->
    <div class="card mb-4">
        <div class="card-header"style="background-color:rgb(254, 107, 124); color: white;"><i class="fa-solid fa-atom"></i>
        Insumos utilizados</div>
        <div class="card-body">
            @if($producto->insumos->isEmpty())
                <p>No se usaron insumos.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (S/)</th>
                            <th>Total (S/)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producto->insumos as $insumo)
                            <tr>
                                <td>{{ $insumo->articulo->nombre }}</td>
                                <td>{{ $insumo->pivot->cantidad }}</td>
                                <td>S/ {{ number_format($insumo->precio, 2) }}</td>
                                <td>S/ {{ number_format($insumo->precio * $insumo->pivot->cantidad, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <!-- Bases -->
    <div class="card mb-4">
        <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;"><i class="fa-solid fa-flask"></i>
        Bases utilizadas</div>
        <div class="card-body">
            @if($producto->bases->isEmpty())
                <p>No se usaron bases.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (S/)</th>
                            <th>Total (S/)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producto->bases as $base)
                            <tr>
                                <td>{{ $base->articulo->nombre }}</td>
                                <td>{{ $base->pivot->cantidad }}</td>
                                <td>S/ {{ number_format($base->precio, 2) }}</td>
                                <td>S/ {{ number_format($base->precio * $base->pivot->cantidad, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop
