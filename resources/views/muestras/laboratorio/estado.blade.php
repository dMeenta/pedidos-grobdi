@extends('adminlte::page')

@section('title', 'Laboratorio - Muestras')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
                <div class="text-center flex-grow-1">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn p-0 border-0 bg-transparent" data-bs-dismiss="alert" aria-label="Cerrar">
                    <i class="bi bi-x-lg" style="font-size: 1.2rem; color: #0f5132;"></i>
                </button>
            </div>
        @endif

        <h1 class="flex-grow-1 text-center mb-3"> Estado de las Muestras<br></h1>
        <form id="exportExcelFormLab" method="POST" action="{{ route('muestras.exportarExcelLAB') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-success mb-2">
                <i class="fas fa-file-excel"></i> Exportar Excel (7 días)
            </button>
        </form>
        <div class="table-responsive">
            <table class="table table-hover" id="table_muestras">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de la Muestra</th>
                        <th scope="col">Clasificación</th>
                        <th scope="col">Tipo de Muestra</th> <!-- Nueva columna -->
                        <th scope="col" class="th-small">Aprobado<br> J. Comercial</th>
                        <th scope="col" class="th-small">Aprobado<br> Coordinadora</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Estado</th> 
                        <th scope="col">Acciones</th>
                        <th scope="col">Creado por</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Fecha/hora Entrega</th>
                        <th scope="col">Ver Muestras</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($muestras as $index => $muestra)
                        <tr id="muestra_{{ $muestra->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td class="observaciones">{{ $muestra->nombre_muestra }}</td>
                            <td>{{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'Sin clasificación' }}</td>
                            <td>{{ $muestra->tipo_muestra ?? 'No asignado' }}</td> <!-- Mostrar el tipo de muestra -->
                            <td>
                                <input type="checkbox" class="aprobacion-jefe" data-id="{{ $muestra->id }}" disabled {{ $muestra->aprobado_jefe_comercial ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="checkbox" class="aprobado_coordinadora" data-id="{{ $muestra->id }}" disabled {{ $muestra->aprobado_coordinadora ? 'checked' : '' }}>
                            </td>
                            <td>{{ $muestra->cantidad_de_muestra }}</td>
                            <td>
                                <select name="estado" 
                                        onchange="actualizarEstado({{ $muestra->id }}, this.value)" 
                                        class="custom-select">
                                    <option value="" disabled {{ empty($muestra->estado) ? 'selected' : '' }}>Seleccione estado</option>
                                    <option value="Pendiente" {{ $muestra->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="Elaborado" {{ $muestra->estado == 'Elaborado' ? 'selected' : '' }}>Elaborado</option>
                                </select>
                            </td>
                            <td>
                                <span class="badge" 
                                    style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 5px;">
                                    {{ $muestra->estado }}
                                </span>
                            </td>
                            <td>{{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</td>
                            <td class="observaciones">{{ $muestra->name_doctor }}</td>
                            <td>
                                @if($muestra->fecha_hora_entrega)
                                    {{ \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('Y-m-d') }} <br>
                                    {{ \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('H:i:s') }}
                                @else
                                    Sin fecha asignada
                                @endif
                            </td>
                            <td>
                               @include('muestras.laboratorio.showlab')
                                <button type="button" class="btn" style="background-color:rgb(152, 236, 62); color: white; border-radius: 5px;" data-toggle="modal" data-target="#contenidoModal{{ $muestra->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!!$muestras->appends(request()->except('page'))->links()!!}
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/muestras/labora.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script>
                    // Seleccionamos todos los botones con la clase 'verFotoBtn'
                document.querySelectorAll('.verFotoBtn').forEach(function(button) {
                    button.addEventListener('click', function() {
                        // Encontramos el contenedor de foto correspondiente al botón
                        var fotoContainer = this.nextElementSibling;
                        var isVisible = fotoContainer.style.display === 'block';

                        // Alterna entre mostrar y ocultar la foto
                        fotoContainer.style.display = isVisible ? 'none' : 'block';

                        // Cambiar el texto del botón según el estado de la foto
                        this.innerHTML = isVisible ? '<i class="bi bi-eye"></i> Ver Foto' : '<i class="bi bi-eye-slash"></i> Ocultar Foto';
                    });
                });

                           // Función para enviar la actualización
                           function actualizarEstado(id, nuevoEstado) {
                    $.ajax({
                        url:`{{ url('laboratorio') }}/${id}/actualizar-estado`,
                        type: "POST",
                        data: {
                            _method: "PUT",
                            _token: '{{ csrf_token() }}',
                            estado: nuevoEstado
                        },
                        success: function() {
                            // No necesitamos hacer nada aquí porque el evento se encargará
                        },
                        error: function(xhr) {
                            toastr.error('Error: ' + (xhr.responseJSON?.message || 'Error desconocido'));
                        }
                    });
                }
                
                function a2(){
                        //touch para celulares
                    $('.aprobado_coordinadora, .aprobacion-jefe').on('click touchstart', function(e) {
                        // Evita la acción predeterminada del evento
                        e.preventDefault();

                        // Verificar si el checkbox tiene la clase 'aprobado_coordinadora' o 'aprobacion-jefe'
                        if ($(this).hasClass('aprobado_coordinadora')) {
                            alert('⚠ Solo la Coordinadora puede marcar este campo');
                        } else if ($(this).hasClass('aprobacion-jefe')) {
                            alert('⚠ Solo el Jefe Comercial puede marcar este campo');
                        } else {
                            alert('⚠ Este campo no puede ser activado');
                        }
                    });
                }
                function a3(){
                    $('.aprobado_coordinadora, .aprobacion-jefe').closest('td').on('mouseenter click touchstart', function(e) {
                        var checkbox = $(this).find('input[type="checkbox"]');
                        
                        // Evita la acción predeterminada si se hace clic o se toca el checkbox
                        if (e.type === 'click' || e.type === 'touchstart') {
                            e.preventDefault(); // No permitir que se marque el checkbox
                        }

                        // Verificar si el checkbox está deshabilitado
                        if (checkbox.prop('disabled')) {
                            if (checkbox.hasClass('aprobado_coordinadora')) {
                                $(this).attr('title', '⚠ Solo la Coordinadora puede marcar este campo');
                            } else if (checkbox.hasClass('aprobacion-jefe')) {
                                $(this).attr('title', '⚠ Solo el Jefe Comercial puede marcar este campo');
                            }
                        } else {
                            $(this).removeAttr('title'); // Eliminar el título si el checkbox no está deshabilitado
                        }
                    });

                    //habilitar/deshabilitar los campos
                    function verificarCheckboxes() {
                            $('tr').each(function() {
                                var row = $(this);
                                var aprobadoCoordinadora = row.find('.aprobado_coordinadora').prop('checked');
                                var aprobadoJefe = row.find('.aprobacion-jefe').prop('checked');
                                
                                // select de estado y fecha de entrega
                                row.find('select[name="estado"]').prop('disabled', !(aprobadoCoordinadora && aprobadoJefe));
                                row.find('input[name="fecha_hora_entrega"]').prop('disabled', !(aprobadoCoordinadora && aprobadoJefe));
                            });
                    }

                    // Verificar al cargar la página
                    verificarCheckboxes();

                    // Verificar cuando cambia cualquier checkbox
                    $('.aprobado_coordinadora, .aprobacion-jefe').change(verificarCheckboxes);
                }

                // Configuración de Pusher----
            Pusher.logToConsole = true;
            var pusher = new Pusher('e4c5eef429639dfca470', { cluster: 'us2' });
            var channel = pusher.subscribe('muestras');

            // Configuración de notificaciones
            var MAX_NOTIFICATIONS = 4;
            var STORAGE_KEY = 'persistentNotificationsQueue';

            // Función para actualizar la tabla via AJAX
            function refreshTable() {
                $.ajax({
                    url: window.location.href,
                    type: 'GET',
                    success: function(data) {
                        var newTable = $(data).find('#table_muestras').html();
                        $('#table_muestras').html(newTable);
                        
                        // Adjuntar manejadores de eventos después de refrescar
                        attachEventHandlers();
                    }
                });
            }

            // Función para adjuntar los manejadores de eventos
            function attachEventHandlers() {
                // Función para enviar la actualización
                function actualizarEstado(id, nuevoEstado) {
                    $.ajax({
                        url:`{{ url('laboratorio') }}/${id}/actualizar-estado`,
                        type: "POST",
                        data: {
                            _method: "PUT",
                            _token: '{{ csrf_token() }}',
                            estado: nuevoEstado
                        },
                        success: function() {
                            // No necesitamos hacer nada aquí porque el evento se encargará
                        },
                        error: function(xhr) {
                            toastr.error('Error: ' + (xhr.responseJSON?.message || 'Error desconocido'));
                        }
                    });
                }
              
               a2();
               a3();
            }
            // Función para manejar la cola de notificaciones
            function manageNotificationQueue(type, title, message) {
                // Obtener cola actual de localStorage
                var notificationsQueue = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                
                // Crear ID único para la notificación
                var notificationId = type + '-' + title + '-' + message;
                
                // Verificar si ya existe en la cola
                var exists = notificationsQueue.some(n => n.id === notificationId);
                if (exists) return;
                
                // Agregar nueva notificación
                notificationsQueue.push({
                    id: notificationId,
                    type: type,
                    title: title,
                    message: message,
                    timestamp: new Date().getTime()
                });
                
                // Limpiar notificaciones antiguas si excedemos el máximo
                if (notificationsQueue.length > MAX_NOTIFICATIONS) {
                    // Eliminar la más antigua (FIFO)
                    notificationsQueue.shift();
                }
                
                // Guardar en localStorage
                localStorage.setItem(STORAGE_KEY, JSON.stringify(notificationsQueue));
                
                // Mostrar todas las notificaciones en cola
                displayNotificationQueue();
            }

            // Función para mostrar la cola de notificaciones
            function displayNotificationQueue() {
                // Limpiar notificaciones actuales
                toastr.clear();
                
                // Obtener cola de notificaciones
                var notificationsQueue = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                
                // Mostrar cada notificación
                notificationsQueue.forEach(notification => {
                    toastr[notification.type](notification.message, notification.title, {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 0,
                        extendedTimeOut: 0,
                        positionClass: 'toast-top-right',
                        enableHtml: true,
                        onHidden: function() {
                            // Al cerrar una notificación, eliminarla de la cola
                            removeNotificationFromQueue(notification.id);
                        }
                    });
                });
            }


            // Función para eliminar una notificación de la cola
            function removeNotificationFromQueue(notificationId) {
                var notificationsQueue = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
                notificationsQueue = notificationsQueue.filter(n => n.id !== notificationId);
                localStorage.setItem(STORAGE_KEY, JSON.stringify(notificationsQueue));
            }

            // Cargar notificaciones al iniciar
            function loadPersistentNotifications() {
                displayNotificationQueue();
            }

            // Eventos de Pusher
            channel.bind('muestra.creada', function(data) {
                console.log('Nueva muestra creada:', data);
                var muestra = data.muestra;
                
                refreshTable();
                
                setTimeout(function() {
                    var lastRow = $('#table_muestras tbody tr').last();

                    manageNotificationQueue(
                        'success', 
                        '<strong>Nueva Muestra Creada</strong>', 
                        `Nombre: <strong>${muestra.nombre_muestra}</strong><br><small><strong>Fecha de creación:</strong> ${muestra.fecha_creacion}</small>`
                    );
                }, 500);
            });

            channel.bind('muestra.actualizada', function(data) {
                console.log('Muestra actualizada:', data);
                var muestra = data.muestra;
                
                refreshTable();
                
                setTimeout(function() {
                    var row = $('#muestra_' + muestra.id);
                    if (row.length > 0) {
                        
                        var fechaActualizacion = new Date(muestra.fecha_actualizacion).toLocaleString();
                        
                        manageNotificationQueue(
                            'info', 
                            '<strong>Muestra Actualizada</strong>', 
                            `Nombre: <strong>${muestra.nombre_muestra}</strong><br><small><strong>Fecha de creación: </strong>${fechaActualizacion}</small>`
                        );
                    }
                }, 500);
            });

            $(document).ready(function() {
                // Limpiar notificaciones existentes al cargar
                toastr.clear();                
                // Cargar notificaciones persistentes
                loadPersistentNotifications();                
                // Adjuntar manejadores de eventos
                attachEventHandlers();
                
            });

            </script>
@stop