@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content')
<div class="card mt-5">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('pedidoscontabilidad.index') }}" method="GET">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input class="form-control" type="date" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <label for="fecha_fin">Fecha de fin:</label>
                    <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" required>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">

                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i> Buscar</button>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    @if(request()->get('fecha_inicio'))
                        <a class="btn btn-outline-success btn-sm" href="{{ route('pedidoscontabilidad.downloadExcel',['fechainicio' => request()->get('fecha_inicio'),'fechafin' => request()->get('fecha_fin')]) }}"><i class="fa fa-file-word"></i> Descargar Excel</a>
                    @else
                        <a class="btn btn-outline-success btn-sm" href="{{ route('pedidoscontabilidad.downloadExcel',['fechainicio' => date('Y-m-d'),'fechafin' => date('Y-m-d')]) }}"><i class="fa fa-file-excel"></i> Descargar Excel</a>
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
                    <th>Nro pedido</th>
                    <th>Cliente</th>
                    <th>Fecha de registro</th>
                    <th>Estado de pago</th>
                    <th>Estado Contabilidad</th>
                    <th>Voucher</th>
                    <th width="120px">Opciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->orderId }}</td>
                    <td>{{ $pedido->customerName }}</td>
                    <td>{{ date('d-m-Y', strtotime($pedido->created_at)) }}  </td>
                    <td>{{ $pedido->paymentStatus }}</td>
                    @if ($pedido->accountingStatus === 0)
                    
                    <td><i class="fa fa-times" aria-hidden="true"></i> Sin revisar</td>
                    @else
                    <td><i class="fa fa-check" aria-hidden="true"></i> Revisado</td>
                    @endif
                    <td>
                        @if ( $pedido->voucher == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                        @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('pedidoscontabilidad.destroy',$pedido->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('pedidoscontabilidad.show',$pedido->id) }}"><i class="fa fa-info"></i> Detalles</a>
             
                            @csrf
                            @method('DELETE')
                
                            <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay información que mostrar</td>
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