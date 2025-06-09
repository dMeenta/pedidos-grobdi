@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Insumos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <label>Lista de Insumos</label>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Unidad de Medida</th>
                                    <th>Actualizar</th>
                                    <th>Excipientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insumos as $insumo)
                                <tr>
                                        <td>{{ $insumo->name }}</td> 
                                        <td><input class="form-control" value="{{ $insumo->cantidad }}"></td> 
                                        <td>{{ $insumo->unidad_medida }}</td> 
                                        <td><button class="btn btn-success"><i class="fa fa-wrench"></i></button></td>
                                        <td>
                                            @if (isset($insumo->excipientes))
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#insumo_ver_{{ $insumo->id }}"><i class="fa fa-eye"></i> Ver</button>/
                                            
                                            @endif
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#insumo_{{ $insumo->id }}"><i class="fa fa-plus"></i> Agregar</button>
                                        </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="insumo_{{ $insumo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('excipientes.store') }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Excipientes al insumo {{ $insumo->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="insumo_id" value="{{ $insumo->id }}">
                                                    <div class="mb-3">
                                                        <label>Nombre:</label>
                                                        <input class="form-control" name="name" placeholder="Ingresar el nombre del excipiente" type="text" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Cantidad:</label>
                                                        <input class="form-control" name="cantidad" placeholder="Ingresar la cantidad" type="number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Unidad de Medida:</label>
                                                        <select class="form-control" name="unidad_medida" required>
                                                            <option value="" selected disabled>Ingresar una unidad de medida</option>
                                                            <option>ML</option>
                                                            <option>G</option>
                                                        </select>                                            
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="input" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="insumo_ver_{{ $insumo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Excipientes de {{ $insumo->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6"><label>Nombre</label></div>
                                                    <div class="col-sm-3"><label>Cantidad</label></div>
                                                    <div class="col-sm-3"><label>Unidad Medida</label></div>
                                                </div>
                                                @foreach ($insumo->excipientes as $excipientes)
                                                <div class="row">
                                                    <div class="col-sm-6">{{ $excipientes->name }}</div>
                                                    <div class="col-sm-3">{{ $excipientes->cantidad }}</div>
                                                    <div class="col-sm-3">{{ $excipientes->unidad_medida }}</div>
                                                </div>
                                                @endforeach
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
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Registrar Insumo</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('insumos.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="base_id" value="{{ request('base_id') }}">
                            <label>Nombre:</label>
                            <input class="form-control" type="text" name="name" placeholder="Ingresar nombre del insumo">
                        </dic>
                        <div class="mb-3">
                            <label>Cantidad:</label>
                            <input class="form-control" type="number" name="cantidad" placeholder="Ingresar la cantidad">
                        </div>
                        <div class="mb-3">
                            <label>Unida de medida:</label>
                            <select class="form-control" name="unidad_medida">
                                <option>ML</option>
                                <option>G</option>
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Registrar</button>
                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
@stop