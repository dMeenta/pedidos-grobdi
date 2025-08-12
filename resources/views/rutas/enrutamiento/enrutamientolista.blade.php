@extends('adminlte::page')

@section('title', 'Enrutamiento')

@section('content_header')
    <h1>lista de Semanas - Zona: {{ $enrutamiento->zone->name }} / Mes: {{ \Carbon\Carbon::parse($enrutamiento->fecha)->locale('es')->monthName . ', ' . \Carbon\Carbon::parse($enrutamiento->fecha)->year}} </h1>
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-medium">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#itemModal">Agregar Nueva Semana</button>
        </div>
        <!-- Boton de doctores pendientes -->
        <div class="mb-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalDoctoresPendientes">Doctores Pendientes</button>
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
                    <th>Doctores</th>
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
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('enrutamientolista.doctores', $ruta_lista->id) }}"><i class=" fa fa-eye"></i> Ver lista</a>
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

<div class="modal fade" id="modalDoctoresPendientes" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDoctoresPendientes">Lista de Doctores pendientes de aprobación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>CMP</th>
                                <th>Telefono</th>
                                <th>Centro de salud</th>
                                <th>Distrito</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitas as $visita)
                            <tr>
                                <td>{{ $visita->doctor->name }} {{ $visita->doctor->first_lastname }} {{ $visita->doctor->second_lastname }}</td>
                                <td>{{ $visita->doctor->CMP }}</td>
                                <td>{{ $visita->doctor->phone }}</td>
                                <td>{{ $visita->doctor->centrosalud->name }}</td>
                                <td>{{ $visita->doctor->distrito->name }}</td>
                                <td>{{ $visita->fecha ?? 'Sin fecha' }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm btn-aprobar" data-id="{{ $visita->id }}">Aprobar</button>
                                    <button class="btn btn-danger btn-sm btn-rechazar" data-id="{{ $visita->id }}">Rechazar</button>
                                </td>
                            </tr>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
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

    $(document).ready(function () {
        // Aprobar
        $('.btn-aprobar').click(function () {
            let btn = $(this); // Guardamos el botón clickeado
            let id = btn.data('id');

            $.ajax({
                url: '/visitadoctornuevo/' + id + '/aprobar',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        title: '¡Exitoso!',
                        text: 'Doctor aprobado correctamente',
                        type: 'success',
                        timer: 3000,
                        shoConfirmButton: false
                    });
                    // Eliminar la fila sin recargar
                    btn.closest('tr').remove();
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo aprobar al doctor',
                        icon: 'error'
                    });
                }
            });
        });
        // Rechazar
        $('.btn-rechazar').click(function () {
            let btn = $(this); // Guardamos el botón clickeado
            let id = btn.data('id');

            $.ajax({
                url: '/visitadoctornuevo/' + id + '/rechazar',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        title: '¡Exitoso!',
                        text: 'Doctor rechazado correctamente',
                        type: 'success',
                        timer: 3000,
                        shoConfirmButton: false
                    });
                    // Eliminar la fila sin recargar
                    btn.closest('tr').remove();
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo aprobar al doctor',
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>
@stop