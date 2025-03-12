@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Laboratorio</h1>
@stop

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('pedidoslaboratorio.index') }}" method="GET">
            <div class="row">
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <label for="fecha">Fecha:</label>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <input class="form-control" type="date" name="fecha" id="fecha" required>
                </div>
                <div class="col-xs-7 col-sm-7 col-md-7">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    @if(request()->get('fecha'))
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',request()->get('fecha')) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
                    @else
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',date('Y-m-d')) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
                    @endif
                </div>
            </div>
            @error('message')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </form>
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">Nro</th>
                    <th>Nro pedido</th>
                    <th>Cliente</th>
                    <th>Turno</th>
                    <th>Cambiar</th>
                    <th>Zona</th>
                    <th>Estado Producción</th>
                    <th width="220px">Opciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->nroOrder }}</td>
                    <td>{{ $pedido->orderId }}</td>
                    <td>{{ $pedido->customerName }}</td>
                    <form action="{{ route('pedidoslaboratorio.update',$pedido->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm"  name="turno" id="turno">
                            <option disabled>Cambiar turno</option>
                            <option value=0 {{ $pedido->turno ===  0  ? 'selected' : '' }}>Mañana</option>
                            <option value=1 {{ $pedido->turno ===  1  ? 'selected' : '' }}>Tarde</option>
                        </select>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square"></i>cambiar</button>
            
                    </td>
                    </form>
                    <td>{{ $pedido->zone->name }}  </td>
                    <td>{{ $pedido->productionStatus === 0 ? 'Pendiente' : 'Elaborado' }}</td>
                    <td>
                        <form action="{{ route('pedidoslaboratorio.destroy',$pedido->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('pedidoslaboratorio.show',$pedido->id) }}"><i class="fa fa-info"></i> Detalles</a>
              
                            <a class="btn btn-primary btn-sm" href="{{ route('pedidoslaboratorio.edit',$pedido->id) }}"><i class="fa-solid fa-pen-to-square"></i> Actualizar</a>
             
                            @csrf
                            @method('DELETE')
                
                            <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $pedidos->appends(request()->except('page'))->links() !!}

    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop