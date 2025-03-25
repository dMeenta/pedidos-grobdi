@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
    <h1>Pedidos por día</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('cargarpedidos.create') }}"> <i class="fa fa-plus"></i> Registrar datos</a>
    </div>
    <br>
    <form action="{{ route('cargarpedidos.index') }}" method="GET">
        <div class="row">
            <div class="col-xs-1 col-sm-1 col-md-1">
                <label for="fecha_inicio">Fecha:</label>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2">
                <input class="form-control" type="date" name="fecha" id="fecha" required>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
            </div>
            @if(request()->get('fecha'))
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',request()->get('fecha')) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
                </div>
            @else
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',date('Y-m-d')) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
                </div>
            @endif
        </div>
        @error('message')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </form>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Id Pedido</th>
                <th>Cliente</th>
                <th>Doctor</th>
                <th>Est. Pago</th>
                <th>Est. Entrega</th>
                <th width="200px">distrito</th>
                <th width="200px">Voucher</th>
                <th width="200px">Receta</th>
                <th width="200px">Zona</th>
                <th width="220px">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedidos  as $arr)
                <tr>
                    <td>{{ $arr["nroOrder"] }}</td>
                    <td>{{ $arr["orderId"] }}</td>
                    <td>{{ $arr["customerName"] }}</td>
                    <td>{{ $arr["doctorName"] }}</td>
                    <td>{{ $arr["paymentStatus"] }}</td>
                    @if($arr->user->role->name == 'motorizado' && $arr["paymentStatus"] === "Reprogramado")
                        <td class="table-danger">{{ $arr["deliveryStatus"] }}</td>
                    @else
                        <td>{{ $arr["deliveryStatus"] }}</td>
                    @endif
                    <td>{{ $arr["district"] }}</td>
                    <td>
                        @if ( $arr["voucher"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>
                        @if ( $arr["receta"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>{{ $arr->zone->name }}</td>
                    <td>
                        <form action="{{ route('cargarpedidos.destroy',$arr->id) }}" method="POST">
                            <a class="btn btn-danger btn-sm" href="{{ route('cargarpedidos.uploadfile',$arr->id) }}"><i class="fa fa-upload"></i>Carga</a>
                            <a class="btn btn-info btn-sm" href="{{ route('cargarpedidos.show',$arr->id) }}"><i class="fa fa-eye"></i> Ver</a>

                            <a class="btn btn-primary btn-sm" href="{{ route('cargarpedidos.edit',$arr->id) }}"><i class="fa-pencil"></i> Editar</a>

                            @csrf
                            @method('DELETE')
                    
                            <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">
    </style>
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop