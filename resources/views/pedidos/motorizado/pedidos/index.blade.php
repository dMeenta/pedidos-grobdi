@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos de la zona {{ Auth::user()->zones[0]->name }}</h2>
    <div class="card-body">
    <form action="{{ route('pedidosmotorizado.index') }}" method="GET">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1">
                <label for="fecha_inicio">Fecha:</label>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <input class="form-control" type="date" name="fecha" id="fecha" required>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i> Buscar</button>
            </div>
        </div>
        @error('message')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </form>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Id Pedido</th>
                <th>Cliente</th>
                <th>Est. pedido</th>
                <th>Dirección</th>
                <th>Referencia</th>
                <th>Turno</th>
                <th width="150px">distrito</th>
                <th width="120px">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos_zona  as $arr)
                <tr class={{ $arr["turno"]== 0 ?"table-warning":"table-success" }}>
                    <td>{{ $arr["nroOrder"] }}</td>
                    <td>{{ $arr["orderId"] }}</td>
                    <td>{{ $arr["customerName"] }}</td>
                    <td>{{ $arr["deliveryStatus"] }}</td>
                    <td>{{ $arr["address"] }}</td>
                    <td>{{ $arr["reference"] }}</td>
                    <td>{{ $arr["turno"] == 0 ? "Mañana":"Tarde" }}</td>
                    <td>{{ $arr["district"] }}</td>
                    <td><a class="btn btn-primary btn-sm" href="{{ route('pedidosmotorizado.edit',$arr->id) }}"><i class="fa-pencil"></i> Actualizar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif
    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style type="text/css">
    </style>
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop