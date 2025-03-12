@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar Pedido</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('cargarpedidos.update',$pedido->id) }}" method="POST">
        @csrf
        @method('PUT')
  
        <div class="row">

            <div class="col-xs-4 col-sm-4 col-md-4">
                <label for="inputName" class="form-label"><strong>Cliente:</strong></label>
                <input 
                    type="text" 
                    name="customerName" 
                    value="{{ $pedido->customerName }}"
                    class="form-control @error('customerName') is-invalid @enderror" 
                    id="inputName" 
                    placeholder="Name">
                @error('customerName')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="customerNumber" class="form-label"><strong>Telefono:</strong></label>
                <input 
                    type="Text" 
                    name="customerNumber" 
                    value="{{ $pedido->customerNumber }}"
                    class="form-control @error('customerNumber') is-invalid @enderror" 
                    id="customerNumber"
                    step=".01"
                    placeholder="Name">
                @error('customerNumber')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <label for="inputName" class="form-label"><strong>Doctor:</strong></label>
                <input 
                    type="text" 
                    name="doctorName" 
                    value="{{ $pedido->doctorName }}"
                    class="form-control @error('doctorName') is-invalid @enderror" 
                    id="doctorName" 
                    placeholder="Nombre del doctor">
                @error('doctorName')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="inputName" class="form-label"><strong>Precio:</strong></label>
                <input 
                    type="number" 
                    name="prize" 
                    value="{{ $pedido->prize }}"
                    class="form-control @error('prize') is-invalid @enderror" 
                    id="prize"
                    step=".01"
                    placeholder="precio">
                @error('prize')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="inputName" class="form-label"><strong>Fecha de entrega:</strong></label>
                <input 
                    type="date" 
                    name="deliveryDate" 
                    value="{{ $pedido->deliveryDate }}"
                    class="form-control @error('deliveryDate') is-invalid @enderror" 
                    id="deliveryDate" 
                    min="<?= date("Y-m-d") ?>"
                    placeholder="ingresar fecha">
                @error('deliveryDate')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
                <label for="address" class="form-label"><strong>Dirección:</strong></label>
                <input 
                    type="Text" 
                    name="address" 
                    value="{{ $pedido->address }}"
                    class="form-control @error('address') is-invalid @enderror" 
                    id="address"
                    placeholder="Dirección">
                @error('address')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <label for="inputName" class="form-label"><strong>Distrito:</strong></label>
                <input 
                    type="Text" 
                    name="district" 
                    value="{{ $pedido->district }}"
                    class="form-control @error('district') is-invalid @enderror" 
                    id="district"
                    placeholder="distrito">
                @error('district')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="zone_id" class="form-label"><strong>Zonas:</strong></label>
                <select class="form-select" name="zone_id" id="zone_id">
                    <option value="" disabled>Selecciona una zona</option>
                    @foreach ($zonas as $zona )
                        <option value={{ $zona->id}} {{ $zona->id === $pedido->zone_id ? 'selected' : '' }} >{{ $zona->name }}</option>
                        
                    @endforeach
                </select>
                @error('zone_id')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
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