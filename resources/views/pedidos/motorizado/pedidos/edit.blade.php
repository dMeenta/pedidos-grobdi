@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar Pedido - orden: {{ $pedido->orderId }} - Nro: {{ $pedido->nroOrder }}</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('pedidosmotorizado.index') }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('pedidosmotorizado.update',$pedido->id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <label for="deliveryStatus" class="form-label"><strong>Estado de entrega:</strong></label>
                <select class="form-select" name="deliveryStatus" id="deliveryStatus">
                    <option value="" disabled>Selecciona una opción</option>
                    <option value="Pendiente" @if('Pendiente' === $pedido->deliveryStatus) selected @endif>Pendiente</option>
                    <option value="Reprogramado" @if('Reprogramado' === $pedido->deliveryStatus) selected @endif >Reprogramado</option>
                    <option value="Entregado" @if('Entregado' === $pedido->deliveryStatus) selected @endif >Entregado</option>
                </select>
                @error('detail')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>observaciones:</strong></label>
                <textarea
                    class="form-control @error('detailMotorizado') is-invalid @enderror" 
                    style="height:150px" 
                    id="inputDetail"
                    name="detailMotorizado"
                    placeholder="ingresar observaciones o detalles">{{ $pedido->detailMotorizado }}</textarea>
                @error('detailMotorizado')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
    <br>
    <div class="row">
        <form id="enviarfoto" action="{{ route('pedidosmotorizado.cargarfotos',$pedido->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-6">
                <label>Cargar foto del domicilio</label>
                <input class="form-control" accept="image/*" type="file" capture="camera" name="fotoDomicilio" id="fotoDomicilio">
            </div>
            @if ($pedido->fotoDomicilio)
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <img src="{{ asset($pedido->fotoDomicilio) }}" alt="{{ $pedido->orderId }}"><br>
                    <strong>Fecha y hora del registro:</strong>{{ $pedido->fechaFotoDomicilio }}
                </div><br>
            @endif
            <div class="col-6">
                <label>Cargar foto del pedido entregado</label>
                <input class="form-control" accept="image/*" type="file" capture="camera" name="fotoEntrega" id="fotoEntrega">
            </div>
            @if($pedido->fotoEntrega)
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <img src="{{ asset($pedido->fotoEntrega) }}" alt="{{ $pedido->orderId }}"><br>
                    <strong>Fecha y hora del registro:</strong>{{ $pedido->fechaFotoEntrega }}
                </div>
            @endif
        </form>
    </div>
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <style>
        img {
            display: block;
            margin: 20px auto;
            max-width: 90%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('js')
<script>
    document.getElementById('fotoDomicilio').addEventListener('change', function () {
        // Enviar el formulario automáticamente cuando se seleccione un archivo
        document.getElementById('enviarfoto').submit();
    });
    document.getElementById('fotoEntrega').addEventListener('change', function () {
        // Enviar el formulario automáticamente cuando se seleccione un archivo
        document.getElementById('enviarfoto').submit();
    });
</script>
@stop