@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Usuarios</h2>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('usuarios.create') }}"> <i class="fa fa-plus"></i> Crear Usuario</a>
    </div>
    <br>
    <div class="card-body">
        <!-- <form action="{{ route('usuarios.index') }}" method="GET">
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
        </form> -->
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>zonas</th>
                    <th>Estado</th>
                    <th>modificar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($usuarios as $usuario)
                <tr class={{ $usuario->active == 0 ? 'table-danger': ''}}>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->role->name}}</td>
                    <td>@forelse($usuario->zones as $zonas)
                        {{ $zonas->name }}  
                        @empty
                        No hay zonas asignadas
                        @endforelse
                    </td>
                    <td>{{ $usuario->active == 1 ? 'Activo': 'Inactivo'}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('usuarios.edit',$usuario) }}"><i class="fa-solid fa-pen-to-square"></i> Actualizar</a>
                    </td>
                    <td>
                        <form action="{{ route('usuarios.destroy',$usuario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if($usuario->active == 1)
                                <button type="submit" class="btn btn-danger btn-sm">Inhabilitar</button>
                            @else
                                <button type="submit" class="btn btn-success btn-sm">Habilitar</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        

    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stop