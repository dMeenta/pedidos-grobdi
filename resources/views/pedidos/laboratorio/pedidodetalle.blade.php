@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Indicadores</h1>
@stop

@section('content')
    <p>Bienvenidos</p>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Detalles de Pedidos del día {{ date('d/m/Y') }}</label>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-2">Filtrar: </label>
                        <div class="col-2">
                            <select class="form-control" name="base">
                                @foreach ($bases as $key => $base)
                                <option>{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id Soflin</th>
                                    <th>Nro Orden</th>
                                    <th>Cliente</th>
                                    <th>Bases</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detallepedidos as $detalle)
                                <tr>
                                    <td>{{ $detalle->pedido->orderId }}</td>
                                    <td>{{ $detalle->pedido->nroOrder }}</td>
                                    <td>{{ $detalle->pedido->customerName }}</td>
                                    <td>{{ $detalle->bases }}</td>
                                    <td>{{ $detalle->articulo }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td><button class="btn btn-secondary" data-toggle="modal" data-target="#detalle_{{ $detalle->id }}">ver</button></td>
                                </tr>
                                <div class="modal fade" id="detalle_{{ $detalle->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalles:</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col col-4"><label>Nombre</label></div>
                                                            <div class="col col-4"><label>Cantidad</label></div>
                                                            <div class="col col-4"><label>UNIDAD MEDIDA</label></div>

                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @if ($detalle->insumos)
                                                                @foreach ($detalle->insumos as $insumos)
                                                                    <div class="col col-4"><p>{{$insumos['nombre']}}</p></div>
                                                                    <div class="col col-4"><p>{{$insumos['cantidad']}}</p></div>
                                                                    <div class="col col-4"><p>{{$insumos['unidad']}}</p></div>
                                                                @endforeach
                                                            
                                                            @endif
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    
@stop