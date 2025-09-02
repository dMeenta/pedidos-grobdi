@extends('adminlte::page')

@section('title', 'Mis rutas')

@section('content_header')

@stop

@section('content')

@php
function getDoctorStars($categoriaDoctor){
switch ($categoriaDoctor){
case 'AAA':
return '★★★';
case 'AA':
return '★★';
default:
return '★';
}
}

function getBtnFontColor($estadoVisita){
if($estadoVisita != 'Asignado'){
return 'black';
} else {
return 'white';
}
}

@endphp

<div class="row gap-3 gap-lg-0" style=" background-color: white;">
    @if ($data->isEmpty())
    <div class="d-flex justify-content-center align-items-center w-100 py-5">
        <h3>No hay visitas pendientes para el día de hoy</h3>
    </div>
    @else
    <div class="col-12 col-xl-3 px-0 overflow-y-scroll" style="max-height: 400px;">
        @foreach ($data as $visita)
        <div data-id="{{ $visita->id }}" role="button"
            class="visita-btn d-flex justify-content-between align-items-center px-2 py-2 border"
            style="background-color: {{ $visita->estado_color }};
            color: {{ getBtnFontColor($visita->estado) }};">
            <span class=" text-truncate">
                {{ getDoctorStars($visita->categoria_doctor) . ' ' . $visita->doctor_name . ' ' . $visita->doctor_first_lastname . ' ' . $visita->doctor_second_lastname }}
            </span>
            <div class="btn btn-light p-0 px-1 rounded-circle details-btn" data-id="{{ $visita->id }}" data-color="{{ $visita->estado_color }}"
                data-toggle="modal"
                data-target="#detailsModal">
                <i class="fas fa-eye"></i>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-12 col-xl-9 p-0" id="map-container">
        <div id="map" style="height: 400px; margin-bottom: 15px;"></div>
        <input type="hidden" name="latitude" id="latitude" value="-12.071693261380643">
        <input type="hidden" name="longitude" id="longitude" value="-77.05072388037252">
    </div>
    @endif
</div>

@include('rutas.details')
</div>

@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFYHepFxrAp3eEIPF5Dynw3Qi85Bhf6rI&libraries=places"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(() => {
        const estadoSelect = $('#estado-visita');
        const fechaInput = $('#fecha-visita');
        const btnSubmit = $('#submit-btn');

        estadoSelect.on('change', function() {
            if (Number.parseInt(estadoSelect.val()) !== 5) {
                fechaInput.prop('disabled', true);
                fechaInput.prop('required', false);
            } else {
                fechaInput.prop('disabled', false);
                fechaInput.prop('required', true);
            }
        })

        const visitas = JSON.parse('@json($data)');
        let map;
        let markers = [];
        let directionsService;
        let directionsRenderer;
        let userPosition = null;
        let activeInfoWindow = null;

        initMap();

        function initMap() {
            const defaultCoords = {
                lat: -12.071693261380643,
                lng: -77.05072388037252
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultCoords,
                zoom: 13,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        userPosition = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };

                        new google.maps.Marker({
                            position: userPosition,
                            map,
                            title: "Tu ubicación",
                            icon: {
                                path: google.maps.SymbolPath.CIRCLE,
                                scale: 8,
                                fillColor: "blue",
                                fillOpacity: 0.8,
                                strokeWeight: 2,
                                strokeColor: "white",
                            }
                        });

                        map.setCenter(userPosition);
                    },
                    (error) => {
                        console.warn("No se pudo obtener ubicación:", error);
                    }
                );
            }

            const bounds = new google.maps.LatLngBounds();

            visitas.forEach(visita => {
                if (visita &&
                    !isNaN(parseFloat(visita.latitude)) &&
                    !isNaN(parseFloat(visita.longitude))) {
                    const position = {
                        lat: parseFloat(visita.latitude),
                        lng: parseFloat(visita.longitude)
                    }

                    const marker = new google.maps.Marker({
                        position,
                        map,
                        title: `${visita.categoria_doctor} - ${visita.doctor_name} ${visita.doctor_first_lastname} ${visita.doctor_second_lastname}`
                    });

                    markers.push(marker);
                    bounds.extend(position);

                    const infoWindow = new google.maps.InfoWindow({
                        content: `
        <div style="max-width: 300px;">
            <img src="/images/logo.jpg" alt="Imagen del lugar" style="width: 100%; border-radius: 5px; margin-bottom: 5px;">
            <div class="d-flex justify-content-between align-items-end">
            <strong>${visita.doctor_name} ${visita.doctor_first_lastname || ''} ${visita.doctor_second_lastname || ''}</strong><br>
            <small class="fs-7">${visita.estado}</small>
            </div>
            <div class="d-flex justify-content-between align-items-end mt-2">
            <button class="btn btn-sm btn-primary py-0 route-btn" data-lat=${visita.latitude} data-lng=${visita.longitude} >Como llegar</button>
            <button class="btn btn-sm btn-primary py-0 details-btn" data-id=${visita.id} data-toggle="modal" data-target="#detailsModal">Ver más</button>
            </div>
        </div>
    `
                    });
                    marker.addListener('click', () => {
                        if (activeInfoWindow) {
                            activeInfoWindow.close();
                        }
                        infoWindow.open(map, marker);
                        activeInfoWindow = infoWindow;
                    });
                }
            });

            if (!bounds.isEmpty()) {
                map.fitBounds(bounds);
            }
        }

        $('.visita-btn').each(function() {
            $(this).on('click', function(e) {
                if ($(e.target).closest('.details-btn').length > 0) {
                    return;
                }
                const visitaId = $(this).data('id');
                const visita = visitas.find(v => v.id == visitaId);

                if (visita && visita.latitude && visita.longitude) {
                    const position = {
                        lat: parseFloat(visita.latitude),
                        lng: parseFloat(visita.longitude)
                    };

                    map.setCenter(position);
                    map.setZoom(17);

                    const marker = markers.find(m =>
                        m.getPosition().lat() === position.lat &&
                        m.getPosition().lng() === position.lng
                    );

                    if (marker) {
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                        setTimeout(() => marker.setAnimation(null), 1400);
                        google.maps.event.trigger(marker, 'click');
                    }

                    const isMobile = window.innerWidth <= 1200;
                    const mapContainer = $("#map-container");

                    if (isMobile) {
                        mapContainer[0].scrollIntoView({
                            behavior: "smooth",
                            block: "center"
                        });
                    }
                }
            });
        });

        $(document).on('click', '.details-btn', function(e) {
            const visitaId = $(this).data('id');
            showVisitaDetails(visitaId);
        });

        function showVisitaDetails(visitaId) {
            $.ajax({
                url: `detalle-visita-doctor/${visitaId}`,
                type: 'GET',
                success: function(response) {
                    if (!response.success) {
                        console.error(response);
                        toastr.error(response.message || 'Hubo un error al cargar los dastos de la visita');
                    }

                    const visitaDetails = response.data;
                    $('#doctor-name').text(visitaDetails.doctor_name);
                    $('#doctor-cmp').text(visitaDetails.doctor_cmp);
                    $('#doctor-phone').text(visitaDetails.doctor_phone);
                    $('#doctor-distrito').text(visitaDetails.doctor_distrito);
                    $('#doctor-especialidad').text(visitaDetails.doctor_especialidad);
                    const centroSalud = $('#doctor-centro_de_salud');
                    centroSalud.text(visitaDetails.doctor_centro_salud).attr('href', `https://www.google.com/maps?q=${visitaDetails.latitude},${visitaDetails.longitude}`);
                    const turnoText = visitaDetails.turno ? (visitaDetails.turno == 1 ? 'Tarde' : 'Mañana') : 'No asignado';
                    $('#doctor-turno').text(turnoText);
                    $('#state-badge').text(visitaDetails.estado).removeClass('text-bg-primary text-bg-warning').addClass(visitaDetails.estado == 'Asignado' ? 'text-bg-primary' : 'text-bg-warning');
                    $('#visita-id').text(`ID: ${visitaDetails.id}`)
                    btnSubmit.data('id', visitaDetails.id);

                    const reporgramadoOption = estadoSelect.find('option[value="5"]');
                    if (visitaDetails.estado == 'Reprogramado') {
                        reporgramadoOption.hide();
                    } else {
                        reporgramadoOption.show();
                    }

                    flatpickr("#fecha-visita", {
                        disable: [function(date) {
                            return (date.getDay() === 0 || date.getDay() === 6);
                        }],
                        dateFormat: "Y-m-d",
                        minDate: visitaDetails.fecha_inicio,
                        maxDate: visitaDetails.fecha_fin,
                    });
                },
                error: function(xhr) {
                    let errorMsg = 'Ocurrió un error inesperado.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    toastr.error(errorMsg);
                }
            })
        }

        const form = $('#form-visita');
        form.on('submit', function(e) {
            e.preventDefault();
            btnSubmit.prop('disabled', true);

            const visitaId = $('#submit-btn').data('id');
            const estadoVisita = $('#estado-visita').val();
            const observaciones = $('#observaciones').val();
            const fechaVisita = $('#fecha-visita').val();

            const formData = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                estado_visita: estadoVisita,
                observaciones: observaciones,
            };

            if (estadoVisita == 5 && fechaVisita) {
                formData.fecha_visita_reprogramada = fechaVisita;
            }

            $.ajax({
                url: `/update-visita-doctor/${visitaId}`,
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $(`.visita-btn[data-id="${visitaId}"]`).remove();
                        $('button[data-dismiss="modal"]').click();
                        form.trigger("reset");
                        btnSubmit.prop('disabled', false);
                    } else {
                        toastr.error(response.message || 'Ocurrió un error al guardar');
                        btnSubmit.prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Ocurrió un error inesperado.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    toastr.error(errorMsg);
                    btnSubmit.prop('disabled', false);
                }
            });
        });

        $(document).on("click", ".route-btn", function() {
            const destino = {
                lat: parseFloat($(this).data("lat")),
                lng: parseFloat($(this).data("lng")),
            };

            if (!userPosition) {
                alert("No se pudo obtener tu ubicación. Activa el GPS.");
                return;
            }

            directionsService.route({
                    origin: userPosition,
                    destination: destino,
                    travelMode: google.maps.TravelMode.DRIVING,
                },
                (response, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(response);
                        if (activeInfoWindow) {
                            activeInfoWindow.close();
                            activeInfoWindow = null;
                        }
                    } else {
                        alert("No se pudo calcular la ruta: " + status);
                    }
                }
            );
        });

    });
</script>
@stop