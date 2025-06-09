@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ordenes de Producción</h1>
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
                        <label class="col-sm-1">Filtrar: </label>
                        <input type="date" name="fecha_produccion" class="form-control col-sm-2">
                        <div class="col-sm-2">
                            <select class="form-control" name="base">
                                @foreach ($presentacion_farmaceutica as $presentacion)
                                <option>{{ $presentacion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary col-sm-1"><i class="fa fa-filter"></i>Filtrar</button>
                        <button onclick="location.reload()" class="btn btn-outline-success  col-sm-2 offset-sm-4">
                            <i class="fas fa-sync-alt"></i> Recarga pagina
                        </button>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id Soflin</th>
                                    <th>Nro Orden</th>
                                    <th>Cliente</th>
                                    <th>Presentación</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Est Prod</th>
                                    <th>Usuario</th>
                                    <th>Asignar</th>
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
                                    @if ($detalle->estado_produccion)
                                        <td><span class="badge bg-success">Elaborado</span></td>
                                    @else
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                    @endif
                                    <td>{{isset($detalle->usuario_produccion->name) ?$detalle->usuario_produccion->name : 'Sin Asignar'}}</td>
                                    <td><button class="btn btn-success" data-toggle="modal" data-target="#asignarprod_{{ $detalle->id }}"><i class="fa fa-user-plus"></i></button></td>
                                    <td><button class="btn btn-secondary" data-toggle="modal" data-target="#detalle_{{ $detalle->id }}">ver</button></td>
                                </tr>

                                <div class="modal fade" id="asignarprod_{{ $detalle->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('pedidosLaboratorio.asignarTecnicoProd',$detalle->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Asignar un tecnico de Producción</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <select class="form-control" name="usuario_produccion_id" required>
                                                        <option value="" disabled selected>Seleccione un usuario</option>
                                                        @foreach ($tecnicos_produccion as $tecnicos)
                                                            <option value="{{ $tecnicos->id }}">{{ $tecnicos->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

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
                                                        <h5>Principios Activos del Producto:</h5>
                                                        <h4>{{ $detalle->articulo }}</h4>
                                                        <div class="row">
                                                            <div class="col col-3"><label>Nombre</label></div>
                                                            <div class="col col-3"><label>Cantidad</label></div>
                                                            <div class="col col-3"><label>Unidad</label></div>
                                                            <div class="col col-3"><label>Resultado</label></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @if ($detalle->insumos)
                                                                @foreach ($detalle->insumos as $insumos)
                                                                    <div class="col col-3"><p>{{$insumos['nombre']}}</p></div>
                                                                    <div class="col col-3"><p>{{$insumos['cantidad']}}</p></div>
                                                                    <div class="col col-3"><p>{{$insumos['unidad']}}</p></div>
                                                                    @if ($detalle->bases =="GOMITAS" or $detalle->bases =="CAPSULAS" or $detalle->bases =="PAPELILLOS")
                                                                    <div class="col col-3"><p>{{$insumos['cantidad']*30* $detalle->cantidad }}</p></div>
                                                                    @elseif($detalle->bases =="JARABE" or $detalle->bases =="POLVO")
                                                                    <div class="col col-3"><p>{{$insumos['cantidad']*1/1}}</p></div>
                                                                    @else
                                                                    <div class="col col-3"><p>No pudimos obtener resultados</p></div>

                                                                    @endif
                                                                @endforeach
                                                            
                                                            @endif
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Lista de bases</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        @if(isset($detalle->contenido))
                                                            @foreach($detalle->contenido as $bases)
                                                                <div class="insumos" id="insumos-{{ $bases->id }}">
                                                                    <h4>{{ $bases->name }}</h4>
                                                                    @if($bases->insumos->count())
                                                                        <ul>
                                                                            @foreach($bases->insumos as $insumo)
                                                                                <li><label>{{ $insumo->name }}:</label> Cantidad: {{ $insumo->cantidad }} {{ $insumo->unidad_medida }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @else
                                                                        <p>No hay insumos para esta base.</p>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        @endif
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
@stop

@section('js')
@stop