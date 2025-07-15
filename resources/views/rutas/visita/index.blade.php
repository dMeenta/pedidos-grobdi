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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: @json($eventos),
                eventClick: function(info) {
                    fetch('/rutasdoctor/' + info.event.id)
                        .then(res => {
                            if (!res.ok) throw new Error('Error en la respuesta');
                            return res.json();
                        })
                        .then(data => {
                            document.getElementById('doctor-info').innerHTML = `
                                <h4>${data.name}</h4>
                                <p><strong>CMP:</strong> ${data.CMP}</p>
                                <p><strong>Teléfono:</strong> ${data.phone ?? 'No registrado'}</p>
                                <p><strong>Tipo:</strong> ${data.tipo_medico}</p>
                                <p><strong>Categoría:</strong> ${data.categoria_medico}</p>
                                <p><strong>Distrito:</strong> ${data.distrito ?? 'No asignado'}</p>
                                <p><strong>Especialidad:</strong> ${data.especialidad ?? 'No asignada'}</p>
                                <p><strong>Centro de Salud:</strong> ${data.centro_salud ?? 'No asignado'}</p>
                            `;
                            document.getElementById('doctor-info').style.display = 'block';
                        })
                        .catch(error => {
                            console.error('Error al obtener datos del doctor:', error);
                        });
                }
            });
            calendar.render();

            // Evento para doctores sin fecha
            document.querySelectorAll('.detalle-doctor').forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch('/rutasdoctor/' + this.dataset.id)
                        .then(res => res.json())
                        .then(data => {
                        document.getElementById('doctor-info').innerHTML = `
                            <h4>${data.name}</h4>
                            <p><strong>CMP:</strong> ${data.CMP}</p>
                            <p><strong>Teléfono:</strong> ${data.phone ?? 'No registrado'}</p>
                            <p><strong>Tipo:</strong> ${data.tipo_medico}</p>
                            <p><strong>Categoría:</strong> ${data.categoria_medico}</p>
                            <p><strong>Distrito:</strong> ${data.distrito ?? 'No asignado'}</p>
                            <p><strong>Especialidad:</strong> ${data.especialidad ?? 'No asignada'}</p>
                            <p><strong>Centro de Salud:</strong> ${data.centro_salud ?? 'No asignado'}</p>
                        `;
                            document.getElementById('doctor-info').style.display = 'block';
                        });
                });
            });
        });
    </script>
</body>
</html>
