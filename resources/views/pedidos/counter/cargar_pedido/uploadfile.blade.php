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
        <a class="btn btn-primary btn-sm" href="{{ route('cargarpedidos.index', ['fecha' => $pedido->deliveryDate]) }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
    <div class="d-grid gap-2 d-md-flex ">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Agregar Imagen Voucher
        </button>
    </div>
    <br><div class="row">
        @if ($pedido->voucher)
        @foreach ($array_voucher as $voucher)
            <div class="col-xs-4 col-sm-4 col-md-4">
                Nro de Operación: <strong>{{ $voucher['nro_operacion'] }}</strong><br>
                <img src="{{ asset($voucher['voucher']) }}" alt="{{ $pedido->orderId }}" width="500" height="500"">
            </div>
        @endforeach

        @endif
    </div>
    <form action="{{ route('cargarpedidos.actualizarPago',$pedido->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-2 col-sm-2 col-md-2">
                <label for="inputName" class="form-label"><strong>Estado del pago:</strong></label>
                <select class="form-control" name="paymentStatus" id="paymentStatus">
                    <option value="" select>Selecciona una opción de pago</option>
                    <option value="PAGADO">PAGADO</option>
                    <option value="PENDIENTE">PENDIENTE</option>
                </select>
                @error('paymentStatus')
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
        <br>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
        <br>
    <form action="{{ route('cargarpedidos.cargarImagenReceta',$pedido->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="row">
        @if ($pedido->receta)
        @foreach ($recetas as $receta)
            <div class="col-xs-6 col-sm-6 col-md-6">
                <img src="{{ asset($receta) }}" alt="{{ $pedido->orderId }}" width="600" height="500"">
            </div>
        @endforeach

        @endif
            <div class="col-xs-4 col-sm-4 col-md-4">
                <label for="inputreceta" class="form-label"><strong>Imagen de la receta:</strong></label>
                <input 
                    type="file" 
                    name="receta[]" 
                    value="{{ $pedido->receta }}"
                    multiple accept="image/*"
                    class="form-control @error('receta[]') is-invalid @enderror" 
                    id="inputreceta">
                @error('receta')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Actualizar Imagen de la receta</button>
    </form>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
  </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cargarpedidos.cargarImagen',$pedido->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ingresar Voucher</h1>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="inputvoucher" class="form-label"><strong>Imagen del voucher de pago:</strong></label>
                    <input 
                        type="file" 
                        name="voucher" 
                        value=""
                        accept="image/*"
                        class="form-control @error('voucher') is-invalid @enderror" 
                        id="inputvoucher" 
                        placeholder="Name">
                    @error('voucher')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="inputpaymentmethod" class="form-label"><strong>Número de operación:</strong></label>
                    <input 
                        type="text" 
                        name="operationNumber" 
                        value=""
                        class="form-control @error('operationNumber') is-invalid @enderror" 
                        id="inputoperationNumber" 
                        placeholder="número de operación">
                    @error('name')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop