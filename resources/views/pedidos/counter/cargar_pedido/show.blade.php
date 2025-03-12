@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Detalles del Pedido</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atras</a>
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
                <strong>Fecha de Emtrega:</strong> <br/>
                {{ $pedido->deliveryDate }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Distrito:</strong> <br/>
                {{ $pedido->district }}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>Dirección:</strong> <br/>
                {{ $pedido->address}}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
            <div class="form-group">
                <strong>Referencia:</strong> <br/>
                {{ $pedido->reference}}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Cliente:</strong> <br/>
                {{ $pedido->customerName }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Telefono:</strong> <br/>
                {{ $pedido->customerNumber }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Doctor:</strong> <br/>
                {{ $pedido->doctorName }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Detalles:</strong> <br/>
                @foreach ($pedido->detailpedidos as $detail_pedidos)
                    {{ $detail_pedidos->articulo }} - {{ $detail_pedidos->cantidad }} unid.<br>
                @endforeach
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Estado Pago:</strong> <br/>
                {{ $pedido->paymentStatus }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Estado Entrega:</strong> <br/>
                {{ $pedido->deliveryStatus }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Fecha Entrega:</strong> <br/>
                {{ $pedido->deliveryDate }}
            </div>
        </div>
    </div>
  
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> -->
@stop