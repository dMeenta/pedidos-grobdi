@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ingredientes</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <label>Lista de ingredientes</label>
                    @session('success')
                        <br>
                        <div class="alert alert-success" role="alert"> {{ $value }} </div>
                    @endsession
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
                                @foreach ($ingredientes as $ingrediente)
                                <tr>
                                    <form action="{{ route('ingredientes.update',$ingrediente->id) }}" method="POST">
                                     @csrf
                                     @method('PUT')
                                        <td>{{ $ingrediente->name }}</td> 
                                        <td><input class="form-control" value="{{ $ingrediente->cantidad }}" name="cantidad"></td> 
                                        <td>{{ $ingrediente->unidad_medida }}</td> 
                                        <td>
                                            <button class="btn btn-success" type="submit"><i class="fa fa-wrench"></i></button>
                                        </td>
                                        <td>
                                            @if (isset($ingrediente->excipientes))
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ingrediente_ver_{{ $ingrediente->id }}"><i class="fa fa-eye"></i> Ver</button>/
                                            
                                            @endif
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ingrediente_{{ $ingrediente->id }}"><i class="fa fa-plus"></i> Agregar</button>
                                        </td>
                                    </form> 
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ingrediente_{{ $ingrediente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('excipientes.store') }}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Excipientes al ingrediente {{ $ingrediente->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="ingrediente_id" value="{{ $ingrediente->id }}">
                                                    <div class="mb-3">
                                                        <label>Nombre:</label>
                                                        <input class="form-control" name="name" placeholder="Ingresar el nombre del excipiente" type="text" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Cantidad:</label>
                                                        <input class="form-control" name="cantidad" step="0.001" placeholder="Ingresar la cantidad" type="number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Unidad de Medida:</label>
                                                        <select class="form-control" name="unidad_medida" required>
                                                            <option value="" selected disabled>Ingresar una unidad de medida</option>
                                                            <option>ML</option>
                                                            <option>G</option>
                                                            <option>gotas</option>
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
                                <div class="modal fade" id="ingrediente_ver_{{ $ingrediente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Excipientes de {{ $ingrediente->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-5"><label>Nombre</label></div>
                                                    <div class="col-sm-3"><label>Cantidad</label></div>
                                                    <div class="col-sm-3"><label>Unidad Medida</label></div>
                                                    <div class="col-sm-1"><label>Ac</label></div>
                                                </div>
                                                @foreach ($ingrediente->excipientes as $excipientes)
                                                <form action="{{ route('excipientes.delete',$excipientes->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="row">
                                                        <div class="col-sm-5">{{ $excipientes->name }}</div>
                                                        <div class="col-sm-3">{{ $excipientes->cantidad }}</div>
                                                        <div class="col-sm-3">{{ $excipientes->unidad_medida }}</div>
                                                        <div class="col-sm-1"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></div>
                                                    </div>

                                                </form>
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
                    <h5>Registrar ingrediente</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ingredientes.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="base_id" value="{{ request('base_id') }}">
                            <label>Nombre:</label>
                            <input class="form-control" type="text" name="name" placeholder="Ingresar nombre del ingrediente">
                        </dic>
                        <div class="mb-3">
                            <label>Cantidad:</label>
                            <input class="form-control" type="number" name="cantidad" step="0.001" placeholder="Ingresar la cantidad">
                        </div>
                        <div class="mb-3">
                            <label>Unida de medida:</label>
                            <select class="form-control" name="unidad_medida">
                                <option>ML</option>
                                <option>G</option>
                                <option>gotas</option>
                                <option>UND</option>
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