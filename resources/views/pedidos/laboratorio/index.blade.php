@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Laboratorio</h1>
@stop

@section('content')
<div class="card mt-2">
    <h2 class="card-header">Pedidos</h2>
    <div class="card-body">
        <form action="{{ route('pedidoslaboratorio.index') }}" method="GET">
            <div class="row">
                <div class="col-xs-1 col-sm-1 col-md-1">
                    <label for="fecha">Fecha:</label>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <input class="form-control" type="date" name="fecha" id="fecha" value="{{ request()->fecha }}" required>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <select onchange="this.form.submit()" class="form-control" aria-label="Default select example" name="turno">
                        <option disabled>Selecciona un turno</option>
                        <option {{ $turno == 0 ? 'selected': '' }} value="0">Mañana</option>
                        <option {{ $turno == 1 ? 'selected': '' }} value="1">Tarde</option>
                    </select>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3  d-md-flex justify-content-md-end">
                    @if(request()->get('fecha'))
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',['fecha'=>request()->get('fecha'),'turno' => $turno]) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
                    @else
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('pedidoslaboratorio.downloadWord',['fecha'=>date('Y-m-d'),'turno' => $turno]) }}"><i class="fa fa-file-word"></i> Descargar Word</a>
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
        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-4" id="tablaPedidos">
                <thead>
                    <tr>
                        <th width="80px">Nro</th>
                        <th>Nro pedido</th>
                        <th>Cliente</th>
                        <th>Turno</th>
                        <th>Zona</th>
                        <th>Estado Producción</th>
                        <th>Actualizar estado</th>
                        <th width="220px">Opciones</th>
                    </tr>
                </thead>
      
                <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->nroOrder }}</td>
                        <td>{{ $pedido->orderId }}</td>
                        <td>{{ $pedido->customerName }}</td>
                        <td>{{ $pedido->turno ===  0  ? 'Mañana' : 'Tarde' }}</td>
                        <td>{{ $pedido->zone->name }}  </td>
    
                        <td>
                        @if ($pedido->productionStatus === 0) 
                            <span class="badge bg-warning">Pendiente</span>
                        @else
                            <span class="badge bg-success">Elaborado</span>
                        @endif
                        </td>
                        <td>
                        @if ($pedido->productionStatus === 0) 
                            <form action="{{ route('pedidoslaboratorio.update',$pedido->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <input type="hidden" name="productionStatus" value=1>
                                <button class="btn btn-outline-success btn-sm"><i class="fa fa-check"></i></button>
                            </form>
                        @endif
                        </td>
                        <td>
                            @if ($pedido->receta)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#imageModal{{ $pedido->id }}"><i class="fa fa-file-image"></i> Imagen
                                </button>
                                <div class="modal fade" id="imageModal{{ $pedido->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $pedido->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $pedido->id }}">Nro de Pedido: {{ $pedido->orderId }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset($pedido->receta) }}" class="img-fluid" alt="{{ $pedido->orderId }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="badge bg-danger">Sin imagen</span>
                            @endif
                            <button class="btn btn-secondary btn-sm btn-detalle" type="button"  data-id="{{ $pedido->id }}"><i class="fa fa-info"></i> Detalles</button>
                            <!-- <a class="btn btn-secondary btn-sm" href="{{ route('pedidoslaboratorio.show',$pedido->id) }}"><i class="fa fa-info"></i> Detalles</a> -->
                 

                        </td>
                    </tr>
                    <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pedido:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-header">
                                        </div>
                                        <div class="card-body">
                                            <ul id="detalle-lista" class="list-group"></ul>

                                        </div> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="8">No hay información que mostrar</td>
                    </tr>
                @endforelse
                </tbody>
      
            </table>

        </div>
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Imagen de la Receta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" alt="Imagen del producto" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <!-- <link rel="stylesheet" href="/css/admin_custom.css">  -->
    
@stop

@section('js')
<script>

    $(document).ready(function () {
        $('.btn-detalle').click(function () {
            const id = $(this).data('id');

            $.ajax({
                url: `/pedidoslaboratorio/${id}`,
                type: 'GET',
                success: function (pedido) {
                    $('#detalle-lista').empty();
                    pedido.detailpedidos.forEach(detalle => {
                        $('#detalle-lista').append(`<li class="list-group-item">
                            <label>Producto:</label> ${detalle.articulo} | <label>Cantidad:</label> ${detalle.cantidad} 
                        </li>`);
                    });
                    $('#detalleModal').modal('show');
                }
            });
        });
    });
    
</script>
@stop