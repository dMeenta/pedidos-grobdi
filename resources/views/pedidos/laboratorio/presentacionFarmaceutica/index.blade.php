@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Presentaciones Farmaceuticas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <label>Lista</label>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Bases</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presentaciones as $presentacion)
                                    <tr data-bs-toggle="collapse" data-bs-target="#bases-{{ $presentacion->id }}" aria-expanded="false" aria-controls="bases-{{ $presentacion->id }}">
                                        <td>{{ $presentacion->name }}</td> 
                                        <td><button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#presentacion_{{ $presentacion->id }}">Agregar Bases</button></td>
                                        <td>
                                        <form action="{{ route('presentacionfarmaceutica.edit', $presentacion->id) }}" method="GET">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                                        </form>
                                        <form action="{{ route('presentacionfarmaceutica.destroy', $presentacion->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Estás seguro de eliminar este ítem?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        </td>
                                    </tr>
                                    <tr class="collapse bg-light" id="bases-{{ $presentacion->id }}">
                                        <td colspan="4">
                                            <strong>bases de {{ $presentacion->name }}</strong>
                                            <table class="table table-sm mt-2">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($presentacion->bases as $bases)
                                                        <tr>
                                                            <td>{{ $bases->name }}</td>
                                                            <td>
                                                                <a href="{{ route('ingredientes.index',$bases->id) }}">Ingredientes</a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="presentacion_{{ $presentacion->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $presentacion->name }}:</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('bases.store')}}" method="POST">
                                                        @csrf
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    Ingresar los datos de la base para: {{ $presentacion->name }}
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <label>Nombre:</label>
                                                                    <input type="hidden" name="presentacion_id" value="{{ $presentacion->id }}">
                                                                    <input class="form-control" type="text" name="name" placeholder="Ingresar el nombre de la base" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Guardar</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div> 
                                                        </div>
                                                    </form>
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
                    <h5>{{ isset($presentacionfarma)?'Editar Presentacion Farmaceutica':'Registrar Presentacion Farmaceutica' }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ isset($presentacionfarma) ? route('presentacionfarmaceutica.update',$presentacionfarma->id) : route('presentacionfarmaceutica.store') }}">
                        @csrf
                        @if(isset($presentacionfarma))
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label>Nombre:</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $presentacionfarma->name ?? '') }}" placeholder="Ingresar nombre de la presentación Farmaceutica" required>
                        </dic>
                        <button class="btn btn-success" type="submit">{{ isset($presentacionfarma)?'Actualizar':'Registrar' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('js')
<!-- En tu layout Blade -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    
@stop