@extends('adminlte::page')

@section('title', 'Mis rutas')

@section('content_header')
    <h1>Calendario de visitas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Indicadores de Pedidos</label>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                    <div class="mt-4">
                        <h5>Leyenda de estados:</h5>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($estados as $estado)
                                <div class="d-flex align-items-center">
                                    <span style="display:inline-block; width:20px; height:20px; background-color:{{ $estado->color }}; border-radius:4px; margin-right:8px;"></span>
                                    <span>{{ $estado->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal fade" id="doctorModal" tabindex="-1" aria-labelledby="doctorModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="doctorModalLabel">Información del Doctor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body" id="doctor-info">
                                    <form id="form-visita">
                                    <div id="info-doctor"></div>

                                    <div class="mb-3">
                                        <label for="estado" class="form-label">Estado de Visita</label>
                                        <select name="estado_visita_id" id="estado" class="form-select"></select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="observaciones" class="form-label">Observaciones</label>
                                        <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fecha_visita" class="form-label">Fecha de Visita</label>
                                        <input type="text" id="fecha_visita" name="fecha_visita" class="form-control" placeholder="Selecciona una fecha">
                                    </div>
                                    <input type="hidden" name="doctor_id" id="doctor_id">
                                    <input type="hidden" name="visita_id" id="visita_id">

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarDoctor(id) {
            
            fetch('/rutasdoctor/' + id)
                .then(res => res.json())
                .then(data => {
                    const doctor = data.doctor;
                    const visita = data.visita;
                    const estados = data.estados;

                    document.getElementById('info-doctor').innerHTML = `
                        <h5>${doctor.name}</h5>
                        <p><strong>CMP:</strong> ${doctor.CMP}</p>
                        <p><strong>Teléfono:</strong> ${doctor.phone ?? 'No registrado'}</p>
                        <p><strong>Distrito:</strong> ${doctor.distrito?.name ?? 'No asignado'}</p>
                        <p><strong>Especialidad:</strong> ${doctor.especialidad?.name ?? 'No asignada'}</p>
                        <p><strong>Centro de Salud:</strong> ${doctor.centro_salud?.name ?? 'No asignado'}</p>
                    `;

                    // Llenar estado
                    const estadoSelect = document.getElementById('estado');
                    
                    estadoSelect.innerHTML = estados.map(e => `
                        <option value="${e.id}" ${visita?.estado_visita_id == e.id ? 'selected' : ''}>
                            ${e.name}
                        </option>
                    `).join('');
                    // Set campos ocultos
                    document.getElementById('doctor_id').value = doctor.id;
                    document.getElementById('visita_id').value = visita?.id ?? '';
                    document.getElementById('fecha_visita').value = visita?.fecha_visita ?? '';
                    document.getElementById('observaciones').value = visita?.observaciones_visita ?? '';
                    flatpickr("#fecha_visita", {
                        dateFormat: "Y-m-d"
                    });
                    // Mostrar modal
                    const modal = new bootstrap.Modal(document.getElementById('doctorModal'));
                    modal.show();
                });
        }
        let calendar;
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                editable: true,
                events: @json($eventos),
                eventClick: function(info) {
                    mostrarDoctor(info.event.id);
                }
            });
            calendar.render();
            // Para doctores sin fecha asignada
            // document.querySelectorAll('.detalle-doctor').forEach(el => {
            //     el.addEventListener('click', function(e) {
            //         e.preventDefault();
            //         mostrarDoctor(this.dataset.id);
            //     });
            // });
        });
        document.getElementById('form-visita').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/guardar-visita', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        type: 'success',
                        title: '¡Éxito!',
                        text: 'Visita actualizada correctamente',
                        timer: 3000,
                        showConfirmButton: false
                    });
                    // Ocultar modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('doctorModal'));
                    modal.hide();
                    console.log(data.doctor_id.toString());
                    const existingEvent = calendar.getEventById(data.doctor_id.toString());
                    if (existingEvent) {
                        existingEvent.remove();
                    }

                    // Agregar el nuevo evento actualizado
                    calendar.addEvent({
                        id: data.doctor_id.toString(),
                        title: data.doctor_name,
                        start: data.fecha_visita,
                        color: data.color
                    });
                }
            })
            .catch(err => {
                console.error("Error al guardar visita:", err);
                alert('Error al guardar');
            });
        });

    </script>
@stop
