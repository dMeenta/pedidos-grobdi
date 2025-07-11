@extends('adminlte::page')

@section('title', 'Aprobacion Jefe Comercial')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')    
    <div class="container">
        <h1 class="flex-grow-1 text-center"> Estado de las Muestras<hr></h1>
        <div class="header-tools d-flex justify-content-end align-items-center mb-2" style="gap: 10px;">
            <div id="datatable-search-wrapper" class="flex-grow-1"></div>
            <form id="exportExcelForm" method="POST" action="{{ route('muestras.exportarExcelJC') }}">
                @csrf
                <input type="hidden" name="ids" id="excelExportIds">
                <button type="submit" class="btn btn-outline-success" style="white-space:nowrap;">
                    <i class="fas fa-file-excel"></i> Exportar Excel
                </button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0" id="table_muestras">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre de la Muestra</th>
                        <th scope="col">Clasificación</th>
                        <th scope="col">Tipo de Muestra</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col" class="th-small">Aprobado por <br> Jefe Comercial</th>
                        <th scope="col" class="th-small">Aprobado por<br> Coordinadora</th>
                        <th>Creado por</th>
                        <th>Doctor</th>
                        <th scope="col">Fecha/hora Recibida</th>
                        <th scope="col">Acciones</th> <!-- Columna para mostrar el estado con color -->
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($muestras as $index => $muestra)
                        <tr id="muestra_{{ $muestra->id }}">
                            <td>{{ $index + 1 }}</td>
                            <td class="observaciones">{{ $muestra->nombre_muestra }}</td>
                            <td>{{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'Sin clasificación' }}</td>
                            <td>{{ $muestra->tipo_muestra ?? 'No asignado' }}</td> <!-- Mostrar el tipo de muestra -->
                            <td>{{ $muestra->cantidad_de_muestra }}</td>
                            <td>
                                <input type="checkbox" class="aprobacion-jefe" data-id="{{ $muestra->id }}" {{ $muestra->aprobado_jefe_comercial ? 'checked' : '' }}>
                            </td>  
                            <td>
                                <input type="checkbox" class="aprobado_coordinadora" data-id="{{ $muestra->id }}" {{ $muestra->aprobado_coordinadora ? 'checked' : '' }}>
                            </td>
                            <td>{{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</td>
                            <td class="observaciones">{{ $muestra->name_doctor }}</td>
                            <td>
                            {{ $muestra->updated_at ? $muestra->updated_at->format('Y-m-d') : $muestra->created_at->format('Y-m-d') }} <br>
                            {{ $muestra->updated_at ? $muestra->updated_at->format('H:i:s') : $muestra->created_at->format('H:i:s') }}</td>
                            <td>
                                <!-- Cambiar la lógica para mostrar el estado con color -->
                                <span class="badge" 
                                    style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 5px;">
                                    {{ $muestra->estado }}
                                </span>
                            </td>
                            <td>
                                @include('muestras.Jcomercial.showJC')
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#muestraModal{{ $muestra->id }}">
                                    <i class="fas fa-binoculars"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
            // Función para configurar los checkboxes de coordinadora
            function setupCoordinadoraCheckboxes() {
                // Deshabilitar siempre los checkboxes de la coordinadora
                $(".aprobado_coordinadora").prop("disabled", true);

                // Mensaje hover para coordinadora
                $('.aprobado_coordinadora').closest('td').hover(function() {
                    var checkbox = $(this).find('.aprobado_coordinadora');
                    $(this).attr('title', checkbox.prop('disabled') ? '⚠ Solo la coordinadora puede marcar' : '');
                });
            }

            // Función para manejar cambios en checkboxes
            function setupCheckboxChanges() {
                $("input[type='checkbox']").off('change').on("change", function() {
                    var id = $(this).data("id");
                    var value = $(this).is(":checked") ? 1 : 0;

                    if ($(this).hasClass("aprobacion-jefe")) {
                        $.ajax({
                            url:`{{ url('muestras') }}/${id}/actualizar-aprobacion`,
                            type: "POST",
                            data: { 
                                _method: "PUT",
                                _token: "{{ csrf_token() }}", 
                                field: "aprobado_jefe_comercial", 
                                value: value 
                            },
                            success: function(response) {
                                console.log(response.message);
                            },
                            error: function(xhr) {
                                console.error("Error al actualizar:", xhr.responseText);
                                toastr.error("Error al actualizar la aprobación");
                                // Revertir el cambio en caso de error
                                $(this).prop('checked', !$(this).prop('checked'));
                            }
                        });
                    }
                });
            }

                        // Configuración de Pusher
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
                setupCoordinadoraCheckboxes();
                setupCheckboxChanges();
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
                        'Nueva Muestra Creada', 
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
    <script>
    $(document).ready(function() {
        var table = $('#table_muestras').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
            },
            ordering: false,
            responsive: true,
            dom: '<"row"<"col-sm-12 col-md-12"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            pageLength: 10,
            initComplete: function() {
                // Mueve el buscador al wrapper personalizado
                $('.dataTables_filter').appendTo('#datatable-search-wrapper').addClass('text-right ml-auto')
                    .find('input').attr('placeholder', 'Buscar por nombre de la muestra').end()
                    .find('label').contents().filter(function() { return this.nodeType === 3; }).remove().end().prepend('Buscar:');
            }
        });

        function stripHtml(html) {
            return String(html).replace(/<[^>]+>/g, ' ').replace(/\s+/g, ' ').trim();
        }
        $('#exportExcelForm').on('submit', function(e) {
            var data = table.rows({ search: 'applied' }).nodes();
            var ids = [];
            data.each(function(row) {
                var id = $(row).attr('id');
                if (id && id.startsWith('muestra_')) {
                    ids.push(id.replace('muestra_', ''));
                }
            });
            $('#excelExportIds').val(JSON.stringify(ids));
        });
    });
</script>
@stop