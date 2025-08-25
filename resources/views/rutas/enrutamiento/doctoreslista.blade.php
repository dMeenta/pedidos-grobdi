@extends('adminlte::page')

@section('title', 'Doctores Lista')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="row justify-content-md-center">
    <div class="col-12">
        <div class="card mt-2">
            <h2 class="card-header">Doctores</h2>
            <div class="card-body">
                @include('messages')
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary btn-sm" href="{{ route('enrutamiento.agregarlista',$id) }}"><i class="fa fa-arrow-left"></i> Atrás</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-4">
                        <thead>
                            <tr>
                                <th>Distrito</th>
                                <th>Doctores</th>
                                <th>Fecha</th>
                                <th>Fecha y Hora visitado</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctores as $doctor )
                                <tr>
                                    <td>{{ $doctor->doctor->distrito->name ? $doctor->doctor->distrito->name :'' }}</td>
                                    <td>{{ $doctor->doctor->name." ".$doctor->doctor->first_lastname . " " . $doctor->doctor->second_lastname }}</td> 
                                    @if ( $doctor->estado_visita->id  == 4)
                                        <td>{{ $doctor->fecha }}</td>
                                        <td>{{ $doctor->updated_at }}</td>
                                        <td><span class="badge bg-success">{{ $doctor->estado_visita->name }}</span></td>
                                        <td>{{ $doctor->observaciones_visita }}</td>
                                        <td>
                                            <button 
                                                type="button" 
                                                class="btn btn-success btn-sm btn-ver-mapa"
                                                data-lat="{{ $doctor->latitude }}"
                                                data-lng="{{ $doctor->longitude }}"
                                                data-nombre="{{ $doctor->doctor->name." ".$doctor->doctor->first_lastname . " " . $doctor->doctor->second_lastname }}"
                                                data-toggle="modal"
                                                data-target="#mapModal"
                                            >
                                                <i class="fa fa-map-marker" aria-hidden="true">
    
                                                </i> 
                                                Ver Mapa
                                            </button>
                                        </td>
                                    @else
                                        <form action="{{ route('enrutamientolista.doctoresupdate',$doctor->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                        <td>
                                            <input min="{{ $doctor->enrutamientolista->fecha_inicio }}" max="{{ $doctor->enrutamientolista->fecha_fin }}" type="date" name="fecha" class="form-control" value="{{ $doctor->fecha }}">
                                        </td>
                                        <td></td>
                                        @if ( $doctor->estado_visita->id  == 1)
                                            <td><span class="badge bg-warning">{{ $doctor->estado_visita->name }}</span></td>
                                        @elseif($doctor->estado_visita->id == 5)
                                            <td><span class="badge bg-secondary">{{ $doctor->estado_visita->name }}</span></td>
                                        @elseif($doctor->estado_visita->id == 3)
                                            <td><span class="badge bg-danger">{{ $doctor->estado_visita->name }}</span></td>
                                        @else
                                            <td><span class="badge bg-primary">{{ $doctor->estado_visita->name }}</span></td>
                                        @endif
                                        <td>{{ $doctor->observaciones_visita }}</td>
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
        </div>
    </div>
</div>
<!-- Modal Bootstrap 4.6 -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubicación del registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map = null;
    let marker = null;

    $(document).ready(function () {
        let lat = 0;
        let lng = 0;
        let nombre = '';
        const defaultLat = 19.4326; // CDMX
        const defaultLng = -99.1332;

        $('.btn-ver-mapa').on('click', function () {
            lat = parseFloat($(this).data('lat'));
            lng = parseFloat($(this).data('lng'));
            nombre = $(this).data('nombre');
        });

        // Inicializa el mapa solo cuando el modal se muestra
        $('.btn-ver-mapa').on('click', function () {
            lat = parseFloat($(this).data('lat'));
            lng = parseFloat($(this).data('lng'));
            nombre = $(this).data('nombre');

            // Si lat o lng no son válidos, usa ubicación por defecto
            if (isNaN(lat) || isNaN(lng)) {
                lat = defaultLat;
                lng = defaultLng;
                nombre = "Ubicación no disponible";
            }
        });

        $('#mapModal').on('shown.bs.modal', function () {
            // Limpia si ya hay un mapa anterior
            if (map !== null) {
                map.remove();
                map = null;
            }

            // Crear nuevo mapa
            map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup(nombre)
                .openPopup();
        });

        $('#mapModal').on('hidden.bs.modal', function () {
            if (map !== null) {
                map.remove();
                map = null;
            }
        });
        $('.table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
        pageLength: 20,
        lengthMenu: [ [10, 20, 50, 100, -1], [10, 20, 50, 100, "Todos"] ],
            dom: '<"row mb-3"<"col-md-6"l><"col-md-6"Bf>>' +
                '<"row"<"col-md-12"tr>>' +
                '<"row mt-3"<"col-md-5"i><"col-md-7"p>>'
        });
    });
</script>

@stop