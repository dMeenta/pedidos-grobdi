@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('asignarpedidos.index') }}" method="GET">
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
        <br>
        <div class="row">
            @foreach($zonas as $zona)
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <label for="fecha_inicio">{{ $zona->name }}</label>

                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nro pedido</th>
                                <th>Fecha creada</th>
                                <th>Distrito</th>
                                <th>Zonas</th>
                                <th width="120px">Opciones</th>
                            </tr>
                        </thead>
            
                        <tbody>
                        @forelse ($pedidos as $pedido)
                            @if ($pedido->zone_id == $zona->id)
                            <tr>
                                <td>{{ $pedido->nroOrder }}</td>
                                <td>{{ $pedido->orderId }}</td>
                                <td>{{ $pedido->created_at }}  </td>
                                <td>{{ $pedido->district}}</td>
                                <form action="{{ route('asignarpedidos.update',$pedido->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"  name="zone_id" id="zone_id">
                                        <option disabled>Cambiar zona</option>
                                        @foreach ($zonas as $zon)
                                            <option value={{ $zon->id }} {{ $pedido->zone_id ===  $zon->id  ? 'selected' : '' }}>{{$zon->name}}</option>
                                        
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <!-- <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal" href="{{ route('asignarpedidos.show',$pedido->id) }}"><i class="fa fa-eye"></i> ver</a> -->
                        
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square"></i> cambiar</button>
                                </td>
                                </form>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6">No hay información que mostrar</td>
                            </tr>
                        @endforelse
                        </tbody>
            
                    </table>
                </div>

            @endforeach
        </div>
        @error('message')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        
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