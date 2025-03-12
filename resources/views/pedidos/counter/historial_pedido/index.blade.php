@extends('adminlte::page')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('historialpedidos.index') }}" method="GET">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required>
                </div>
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i> Buscar</button>
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
                    <th width="95px">Id Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha de Entrega</th>
                    <th>Estado Producción</th>
                    <th>Estado Entrega</th>
                    <th width="120px">Opciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->orderId }}</td>
                    <td>{{ $pedido->customerName }}</td>
                    <td>{{ $pedido->deliveryDate }}  </td>
                    <td>{{ $pedido->productionStatus === 0 ? 'Pendiente' : 'Elaborado' }}</td>
                    <td>{{ $pedido->deliveryStatus}}</td>
                    <td>
                        <form action="{{ route('cargarpedidos.destroy',$pedido->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('historialpedidos.show',$pedido->id) }}"><i class="fa fa-info"></i> Detalles</a>
                            @csrf
                            @method('DELETE')
                
                            <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay información que mostrar</td>
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
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop