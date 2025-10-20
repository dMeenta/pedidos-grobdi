@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
@can('pedidoslaboratorio.show')

<div class="card mt-5">
  <h2 class="card-header">Detalles del Pedido</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{url()->previous()}}"><i class="fa fa-arrow-left"></i> Atras</a>
    </div>
  
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Nro del Pedido:</strong> <br/>
                {{ $pedido->orderId }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>cliente:</strong> <br/>
                {{ $pedido->customerName }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Fecha Entrega:</strong> <br/>
                {{ $pedido->deliveryDate }}
            </div>
        </div>
        <div class="col-xs-8 col-sm-8 col-md-8 mt-2">
            <div class="form-group">
                <strong>Detalles:</strong> <br/>
                @foreach ($pedido->detailpedidos as $detail_pedidos)
                    {{ $detail_pedidos->articulo }} - {{ $detail_pedidos->cantidad }} unid.<br>
                @endforeach
            </div>
        </div>
        @if ($pedido->receta)
            <div class="col-xs-4 col-sm-4 col-md-4">
                <img src="{{ asset($pedido->receta) }}" alt="{{ $pedido->orderId }} width="400" height="400"">
            </div>
        @endif
    </div>
  
  </div>
</div>

@endcan
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop