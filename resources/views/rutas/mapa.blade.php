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

<div class="row gap-3 gap-lg-0 position-relative" style=" background-color: white;">
    @if ($data->isEmpty())
    <div class="d-flex justify-content-center align-items-center w-100 py-5">
        <h3>No hay visitas pendientes para el día de hoy</h3>
    </div>
    @else
    <div class="col-12 col-xl-3 px-0 overflow-y-scroll visita-list px-1" style="background-color: #dddfe2ff;">
        @foreach ($data as $visita)
        <div data-id="{{ $visita->id }}" role="button"
            class="visita-btn d-flex justify-content-between align-items-center px-2 py-2 border shadow"
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
        <div id="map"></div>
    </div>
    <div id="info-panel">
        <span id="close-panel">&times;</span>
        <div id="panel-content" style="height: 100%;"></div>
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
<style>
    .visita-list {
        height: 80dvh;
    }

    #map {
        height: 80dvh;
    }


    @media (max-width: 1200px) {
        .visita-list {
            height: 30dvh;
        }

        #map {
            height: 60dvh;
        }
    }


    /* Panel inferior oculto inicialmente */
    #info-panel {
        position: fixed;
        bottom: -100%;
        /* escondido fuera de la pantalla */
        left: 0;
        width: 100%;
        height: 50%;
        /* hasta la mitad de la pantalla */
        background: white;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        transition: bottom 0.4s ease-in-out;
        z-index: 1000;
        overflow-y: auto;
        padding: 15px;
    }

    @media (min-width: 992px) {
        #info-panel {
            left: 250px;
            /* ancho del sidebar */
            width: calc(100% - 250px);
        }
    }

    #info-panel.active {
        bottom: 0;
    }

    #close-panel {
        position: absolute;
        top: 8px;
        right: 15px;
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        z-index: 999;
    }
</style>
@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFYHepFxrAp3eEIPF5Dynw3Qi85Bhf6rI&libraries=places"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(() => {
        const infoPanel = $('#info-panel');
        const panelContent = $('#panel-content');
        const closePanel = $('#close-panel');
        const estadoSelect = $('#estado-visita');
        const fechaInput = $('#fecha-visita');
        fechaInput.prop('disabled', true);
        const btnSubmit = $('#submit-btn');

        closePanel.on('click', () => {
            infoPanel.removeClass('active');
        })

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
        const groupedVisitasByCentroSaludId = visitas.reduce((acc, visita) => {
            const id = visita.centrosalud_id;
            if (!acc[id]) {
                acc[id] = {
                    name: visita.centrosalud_name,
                    coords: {
                        lat: visita.centrosalud_lat,
                        lng: visita.centrosalud_lng,
                    },
                    visitas: []
                };
            }
            acc[id].visitas.push(visita);
            return acc;
        }, {});

        let map;
        let markers = [];
        let directionsService;
        let directionsRenderer;
        let userPosition = null;

        initMap();

        function initMap() {
            const defaultCoords = {
                lat: -12.0715225,
                lng: -77.0506430
            };

            userPosition = defaultCoords;

            // Crear mapa con centro en defaultCoords
            map = new google.maps.Map(document.getElementById("map"), {
                center: userPosition,
                zoom: 14,
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Intentar obtener ubicación del usuario
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
                        console.warn("No se pudo obtener ubicación, usando defaultCoords", error);

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
                    }
                );
            } else {
                console.warn("Geolocalización no soportada, usando defaultCoords");

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
            }

            const bounds = new google.maps.LatLngBounds();

            Object.entries(groupedVisitasByCentroSaludId).map(([id, group]) => {
                const {
                    lat,
                    lng
                } = group.coords;
                if (
                    group &&
                    !isNaN(parseFloat(lat)) &&
                    !isNaN(parseFloat(lng))
                ) {
                    const position = {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    };

                    const marker = new google.maps.Marker({
                        position,
                        map,
                        title: group.name
                    });

                    markers.push(marker);
                    bounds.extend(position);

                    marker.addListener("click", () => {
                        console.log(group);
                        panelContent.html(`
                            <div class="d-flex flex-column justify-content-between" style="height: 100%;">
                                <div class="border-bottom border-dark text-center pb-2">
                                    <strong>${group.name}</strong>
                                </div>
                                <div class="overflow-y-auto py-2" style="flex: 1;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Doctor</th>
                                            <th scope="col" class="text-center">Estado</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        ${group.visitas.map(visita => `
                                            <tr data-id="${visita.id}">
                                                <th>${visita.doctor_name} ${visita.doctor_first_lastname ?? ''} ${visita.doctor_second_lastname ?? ''}</th>
                                                <td style="align-content: center;">
                                                    <div class="d-flex justify-content-center" style="width:100%; height=full">
                                                        <div class="rounded-circle" style="width:1rem; height:1rem; background-color: ${visita.estado_color}"></div>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-primary py-0 details-btn" data-id=${visita.id} 
                                                        data-toggle="modal" data-target="#detailsModal">
                                                            Ver más
                                                    </button>
                                                </td>
                                            </tr>`).join("")}
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-primary route-btn py-2" data-lat=${lat} data-lng=${lng}>
                                    Como llegar
                                </button>
                            </div>`);

                        infoPanel.addClass("active");

                        map.panTo(position);
                        map.setZoom(16);
                        map.panBy(0, 150);
                    });
                }
            })

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

                if (visita && visita.centrosalud_lat && visita.centrosalud_lng) {
                    const position = {
                        lat: parseFloat(visita.centrosalud_lat),
                        lng: parseFloat(visita.centrosalud_lng)
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
                    centroSalud.text(visitaDetails.doctor_centro_salud)
                    if (visitaDetails.centrosalud_lat && visitaDetails.centrosalud_lng) {
                        centroSalud.attr('href', `https://google.com/maps?q=${visitaDetails.centrosalud_lat},${visitaDetails.centrosalud_lng}`);
                    } else {
                        centroSalud.removeAttr('href')
                        toastr.error("Este centro de salud no tiene coordenadas")
                    }
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

            if (estadoVisita == 4) {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        formData.update_latitude = latitude;
                        formData.update_longitude = longitude;

                        sendForm(visitaId, formData);
                    }, function(error) {
                        toastr.error('No se pudo obtener la ubicación. Asegurate de habilitar los servicios de ubicación');
                        btnSubmit.prop('disabled', false);
                    });
                } else {
                    toastr.error('La geolocalización no está disponible en tu navegador');
                    btnSubmit.prop('disabled', false);
                }
            } else {
                sendForm(visitaId, formData);
            }
        });

        function sendForm(visitaId, formData) {
            $.ajax({
                url: `/update-visita-doctor/${visitaId}`,
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        $(`.visita-btn[data-id="${visitaId}"]`).remove();
                        $(`tr[data-id="${visitaId}"]`).remove();
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
        }

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
                        closePanel.click();
                    } else {
                        alert("No se pudo calcular la ruta: " + status);
                    }
                }
            );
        });
    });
</script>
@stop