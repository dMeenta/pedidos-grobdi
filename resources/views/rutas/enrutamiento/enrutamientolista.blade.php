@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Enrutamiento de listas</h1>
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-medium">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#itemModal">Agregar Nueva Lista</button>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('enrutamiento.index') }}"><i class="fa fa-arrow-left"></i> Atrás</a>
        </div>
    </div>
    <div class="card-body">
    @session('success')
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
    @endsession
    @session('danger')
        <div class="alert alert-danger" role="alert"> {{ $value }} </div>
    @endsession
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    @endif
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>lista</th>
                    <th>Distritos</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($enrutamiento->enrutamiento_listas as $ruta_lista)
                <tr>
                    <td>{{ $ruta_lista->fecha_inicio }} al {{ $ruta_lista->fecha_fin }}</td>
                    <td>{{ $ruta_lista->lista->name }}</td>
                    <td>
                        @foreach ($ruta_lista->lista->distritos as $distrito)
                            {{ $distrito->name }}
                            <br>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
    </div>
</div>
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Registrar Nueva Lista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('enrutamientolista.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fechas:</label>
                        <input type="text" class="form-control" id="dateRangePicker" name="fechas" placeholder="Selecciona un rango de fechas">
                        <input type="hidden" value="{{ request()->route()->parameters['id'] }}" name="enrutamiento_id">
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Lista:</label>
                        <select class="form-control" name="lista_id">
                            <option  selected disabled>Seleccione una lista</option>
                            @foreach ($listas as $lista)
                                <option value="{{ $lista->id }}">{{ $lista->name }}</option>
                            @endforeach
                        </select>
                        @error('fecha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>

    const fechasDesactivadas = @json($fechas_seleccionadas);
    const fecha_inicio = @json($enrutamiento->fecha);
    console.log(fecha_inicio);
    flatpickr("#dateRangePicker", {
        mode: "range",
        dateFormat: "Y-m-d",
        disable: fechasDesactivadas,
        minDate: fecha_inicio,
        locale: "es" // Esto cambia el idioma a español
    });
</script>
@stop