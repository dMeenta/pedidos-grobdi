@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Detalles del pedido</h2>
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
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Estado de pago:</strong> <br/>
                {{ $pedido->paymentStatus }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Metodo de pago:</strong> <br/>
                {{ $pedido->paymentMethod }}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 mt-2">
            <div class="form-group">
                <strong>Número de operación:</strong> <br/>
                {{ $pedido->operationNumber }}
            </div>
        </div>
        @if ($pedido->voucher)
            <div class="col-xs-4 col-sm-4 col-md-4">
                <img src="{{ asset($pedido->voucher) }}" alt="{{ $pedido->orderId }} width="400" height="400"">
            </div>
        @endif
        <form action="{{ route('pedidoscontabilidad.update',$pedido->id) }}" method="POST">
            @csrf
            @method('PUT')
      
            <div class="mb-3">
                <label for="accountingStatus" class="form-select"><strong>Estado de contabilidad:</strong></label>
                <select class="form-select" name="accountingStatus" id="accountingStatus">
                    <option disabled select>Selecciona una opción</option>
                    <option value="0" {{ $pedido->accountingStatus === 0 ? 'selected' : '' }}>Sin revisar</option>
                    <option value="1" {{ $pedido->accountingStatus === 1 ? 'selected' : '' }}>Revisado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar revisión</button>
        </form>
    </div>
  
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop