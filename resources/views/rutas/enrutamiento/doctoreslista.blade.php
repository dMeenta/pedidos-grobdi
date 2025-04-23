@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="card mt-2">
    <h2 class="card-header">Doctores</h2>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif
        @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('enrutamiento.agregarlista',$id) }}"><i class="fa fa-arrow-left"></i> Atrás</a>
        </div>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Distrito</th>
                    <th>Doctores</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctores as $doctor )
                <tr>
                    <td>{{ $doctor->doctor->distrito->name ? $doctor->doctor->distrito->name :'' }}</td>
                    <td>{{ $doctor->doctor->name." ".$doctor->doctor->lastname }}</td> 
                    @if ( $doctor->estado_visita->id  == 4)
                        <td>{{ $doctor->fecha }}</td>
                        <td><span class="badge bg-success">{{ $doctor->estado_visita->name }}</span></td>
                        <td>{{ $doctor->Observaciones_visita }}</td>
                        <td></td>
                    @else
                        <form action="{{ route('enrutamientolista.doctoresupdate',$doctor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        <td>
                            <input min="{{ $doctor->enrutamientolista->fecha_inicio }}" max="{{ $doctor->enrutamientolista->fecha_fin }}" type="date" name="fecha" class="form-control" value="{{ $doctor->fecha }}">
                        </td>
                        @if ( $doctor->estado_visita->id  == 1)
                            <td><span class="badge bg-warning">{{ $doctor->estado_visita->name }}</span></td>
                        @else
                            <td><span class="badge bg-primary">{{ $doctor->estado_visita->name }}</span></td>
                        @endif
                        <td>{{ $doctor->Observaciones_visita }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square"></i> Actualizar</button>
                        </td>

                        </form>
                    @endif

                </tr>
                @endforeach
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