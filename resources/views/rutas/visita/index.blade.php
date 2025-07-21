<!-- resources/views/visitas_calendario.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Calendario de Visitas</h2>

    <div id="calendar"></div>
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
    <h3>Doctores sin fecha asignada</h3>
    <ul>
        @foreach ($doctoresSinFecha as $doctor)
            <li>
                <a href="#" class="detalle-doctor" data-id="{{ $doctor->id }}">{{ $doctor->name }}</a>
            </li>
        @endforeach
    </ul>

    <!-- Modal o div para info doctor -->
    <div id="doctor-info" style="display:none; border:1px solid #ccc; padding:10px;"></div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                    document.getElementById('observaciones').value = visita?.observaciones ?? '';

                    // Mostrar modal
                    const modal = new bootstrap.Modal(document.getElementById('doctorModal'));
                    modal.show();
                });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: @json($eventos),
                eventClick: function(info) {
                    mostrarDoctor(info.event.id);
                }
            });
            calendar.render();

            // Para doctores sin fecha asignada
            document.querySelectorAll('.detalle-doctor').forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    mostrarDoctor(this.dataset.id);
                });
            });
        });

    </script>
</body>
</html>
