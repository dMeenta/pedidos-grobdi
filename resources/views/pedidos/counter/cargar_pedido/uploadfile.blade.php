@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar pago del Pedido N° {{$pedido->orderId}}</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('cargarpedidos.cargarImagen',$pedido->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            @if ($pedido->voucher)
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <img src="{{ asset($pedido->voucher) }}" alt="{{ $pedido->orderId }} width="400" height="300"">
                </div>
            @endif

            <div class="col-xs-4 col-sm-4 col-md-4">
                <label for="inputvoucher" class="form-label"><strong>Imagen:</strong></label>
                <input 
                    type="file" 
                    name="voucher" 
                    value="{{ $pedido->voucher }}"
                    class="form-control @error('voucher') is-invalid @enderror" 
                    id="inputvoucher" 
                    placeholder="Name">
                @error('voucher')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="inputName" class="form-label"><strong>Estado del pago:</strong></label>
                <select class="form-select" name="paymentStatus" id="paymentStatus">
                    <option value="" select>Selecciona una opción de pago</option>
                    <option value="PAGADO">PAGADO</option>
                    <option value="PENDIENTE">PENDIENTE</option>
                </select>
                @error('paymentStatus')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <label for="inputpaymentmethod" class="form-label"><strong>Número de operación:</strong></label>
                <input 
                    type="text" 
                    name="operationNumber" 
                    value="{{ $pedido->operationNumber }}"
                    class="form-control @error('operationNumber') is-invalid @enderror" 
                    id="inputoperationNumber" 
                    placeholder="número de operación">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <label for="inputpaymentmethod" class="form-label"><strong>Metodo de pago:</strong></label>
                <input 
                    type="text" 
                    name="paymentMethod" 
                    value="{{ $pedido->paymentMethod }}"
                    class="form-control @error('paymentMethod') is-invalid @enderror" 
                    id="inputpaymentmethod" 
                    placeholder="metodo de pago">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
  
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop