@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Doctores</h1>
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-medium">
            <a class="btn btn-success btn-sm" href="{{ route('doctor.create') }}"> <i class="fa fa-plus"></i> Registrar datos</a>
        </div>
    </div>
    <div class="card-body">
    @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <form method="GET" action="{{ route('doctor.index') }}">
            <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}" class="form-control">
            <!-- <button type="submit" class="btn btn-primary">Buscar</button> -->
        </form>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>CMP</th>
                    <th>Telefono</th>
                    <th>Especialidad</th>
                    <th>Centro de salud</th>
                    <th>Distrito</th>
                    <th>Tipo Medico</th>
                    <th>Usuario</th>
                    <th>Hijos</th>
                    <th>modificar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($doctores as $doctor)
                <tr class={{ $doctor->state == 0 ? 'table-danger': ''}}>
                    <td>{{ $doctor->name }}</td>
                    <td>{{ $doctor->lastname }}</td>
                    <td>{{ $doctor->CMP }}</td>
                    <td>{{ $doctor->phone }}</td>
                    <td>{{ $doctor->especialidad->name }}</td>
                    <td>{{ $doctor->centrosalud->name }}</td>
                    <td>{{ $doctor->distrito->name }}</td>
                    <td>{{ $doctor->tipo_medico }}</td>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->songs == 1 ? 'Si': 'No'}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('doctor.edit',$doctor) }}"><i class="fa-solid fa-pen-to-square"></i> Actualizar</a>
                    </td>
                    <td>
                        <form action="{{ route('doctor.destroy',$doctor->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @if($doctor->state == 1)
                                <button type="submit" class="btn btn-danger btn-sm">Inhabilitar</button>
                            @else
                                <button type="submit" class="btn btn-success btn-sm">Habilitar</button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
    </div>
</div>

@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop