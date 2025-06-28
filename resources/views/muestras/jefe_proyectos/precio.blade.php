@extends('adminlte::page')

@section('title', 'Jefe Operaciones')

@section('content_header')
<h1></h1>
@stop

@section('content')
    <div class="container">
    <h1 class="flex-grow-1 text-center" style="color: #fe495f; font-weight: bold; margin: 0;">Estado de las Muestras<hr></h1>
        <div class="table-responsive">
            <table class="table table-hover" id="table_muestras">
                <thead>
                    <tr>
                        <th class="th-custom" scope="col">#</th>
                        <th class="th-custom" scope="col">Nombre de la Muestra</th>
                        <th class="th-custom" scope="col">Clasificación</th>
                        <th class="th-custom" scope="col">Tipo de Muestra</th>
                        <th class="th-custom" class="th-small">Unidad de<br>Medida</th>
                        <th class="th-custom">Cantidad</th>
                        <th class="th-custom">Precio</th>
                        <th class="th-custom">Precio Total</th>
                        <th class="th-custom">Creado por</th>
                        <th class="th-custom">Doctor</th>
                        <th class="th-custom">Fecha/hora<br>Recibida</th>
                        <th class="th-custom">Estado</th>
                        <th class="th-custom">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($muestras as $index => $muestra)
                    <tr id="muestra_{{ $muestra->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="observaciones">{{ $muestra->nombre_muestra }}</td>
                        <td>{{ $muestra->clasificacion?->nombre_clasificacion ?? 'Sin clasificación' }}</td>
                        <td>{{ $muestra->tipo_muestra ?? 'No asignado' }}</td>
                        <td>{{ $muestra->clasificacion?->unidadMedida?->nombre_unidad_de_medida ?? 'No asignada' }}</td>
                        <td>{{ $muestra->cantidad_de_muestra }}</td>
                        <td><input type="number" class="form-control precio-input" data-id="{{ $muestra->id }}" value="{{ $muestra->precio }}" required></td>
                        <td id="total_{{ $muestra->id }}">{{ $muestra->cantidad_de_muestra * $muestra->precio }}</td>
                        <td>{{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</td>
                        <td class="observaciones">{{ $muestra->name_doctor }}</td>
                        <td>
                            {{ ($muestra->updated_at ?? $muestra->created_at)->format('Y-m-d') }}<br>
                            {{ ($muestra->updated_at ?? $muestra->created_at)->format('H:i:s') }}
                        </td>
                        <td>
                            <span class="badge" style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 5px;">
                                {{ $muestra->estado }}
                            </span>
                        </td>
                        <td>
                            @include('muestras.jefe_proyectos.showJO')
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#muestraModal{{ $muestra->id }}">
                                <i class="bi bi-binoculars"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!!$muestras->appends(request()->except('page'))->links()!!}
        </div>
        
        <div id="success-message" class="alert alert-success d-none mt-3"></div>
        <div id="error-message" class="alert alert-danger d-none mt-3"></div>
    </div>
@stop

@section('css')
    <link rel="shortcut icon" href="{{ asset('imgs/favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/muestras/labora.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        const MAX_NOTIFICATIONS = 4;
        const STORAGE_KEY = 'persistentNotificationsQueue';
        let debounceTimer;
        
        // Configuración inicial
        $(document).ready(function() {
            initPusher();
            attachEventHandlers();
            loadPersistentNotifications();
            checkMissingPrices();
        });

        // iniciar Pusher 
        function initPusher() {
            Pusher.logToConsole = true;
            const pusher = new Pusher('e4c5eef429639dfca470', { cluster: 'us2' });
            const channel = pusher.subscribe('muestras');
            
            channel.bind('muestra.creada', handleNewSample);
            channel.bind('muestra.actualizada', handleUpdatedSample);
        }

        // Eventhandlers espera medio segundo para ejecutar el cambio de precio
        function attachEventHandlers() {
            $(document).on('change', '.precio-input', debounce(handlePriceChange, 500));
        }

        // manejar el cambio de precio
        function handlePriceChange() {
            const $input = $(this);
            const id = $input.data('id');
            const precio = parseFloat($input.val()) || 0;
            const cantidad = parseFloat($input.closest('tr').find('td:nth-child(6)').text());
            // var link = `/muestras/${id}/actualizar-precio`;
            $.ajax({
                url: `{{ url('muestras') }}/${id}/actualizar-precio`,
                type: 'POST',
                data: {
                    _method: "PUT",
                    _token: '{{ csrf_token() }}',
                    precio: precio
                },
                success: (response) => {
                    $('#total_' + id).text((precio * cantidad).toFixed(2));
                    showSuccessMessage(response.message);
                    checkMissingPrices();
                },
                error: () => showErrorMessage('Error al actualizar el precio')
            });
        }

        // evento muestra creada
        function handleNewSample(data) {
            refreshTable(() => {
                const muestra = data.muestra;
                const lastRow = $('#table_muestras tbody tr').last();
                
                addNotification(
                    'success', 
                    '<strong>Nueva Muestra Creada</strong>', 
                    `Nombre: <strong>${muestra.nombre_muestra}</strong><br><small><strong>Fecha:</strong> ${muestra.fecha_creacion}</small>`
                );
            });
        }
        // muestra actualizada
        function handleUpdatedSample(data) {
            refreshTable(() => {
                const muestra = data.muestra;
                const row = $(`#muestra_${muestra.id}`);
                
                if (row.length) {
                    
                    const fecha = new Date(muestra.fecha_actualizacion).toLocaleString();
                    
                    addNotification(
                        'info', 
                        '<strong>Muestra Actualizada</strong>', 
                        `Nombre: <strong>${muestra.nombre_muestra}</strong><br><small><strong>Fecha:</strong> ${fecha}</small>`
                    );
                }
            });
        }

        // refresca la tabla
        function refreshTable(callback) {
            $.get(window.location.href, (data) => {
                $('#table_muestras').html($(data).find('#table_muestras').html());
                if (callback) callback();
            });
        }

        // Notificatioes almacenamiento
        function addNotification(type, title, message) {
            const notifications = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
            const notificationId = `${type}-${title}-${message}`;
            
            if (!notifications.some(n => n.id === notificationId)) {
                notifications.push({ id: notificationId, type, title, message, timestamp: Date.now() });
                if (notifications.length > MAX_NOTIFICATIONS) notifications.shift();
                localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
            }
            
            displayNotifications();
        }
        //visualiza las notificaciones
        function displayNotifications() {
            toastr.clear();
            JSON.parse(localStorage.getItem(STORAGE_KEY) || []).forEach(notification => {
                toastr[notification.type](notification.message, notification.title, {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 0,
                    positionClass: 'toast-top-right',
                    enableHtml: true,
                    onHidden: () => removeNotification(notification.id)
                });
            });
        }

        function removeNotification(id) {
            const notifications = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]')
                .filter(n => n.id !== id);
            localStorage.setItem(STORAGE_KEY, JSON.stringify(notifications));
        }

        function loadPersistentNotifications() {
            displayNotifications();
        }

        // validacion de precios faltantes
        function checkMissingPrices() {
            const missing = $('.precio-input').filter((_, el) => !$(el).val() || parseFloat($(el).val()) <= 0).length;
            
            if (missing) {
                toastr.warning(
                    `Faltan <strong>${missing}</strong> ${missing === 1 ? 'precio' : 'precios'} por completar`, 
                    'Atención', 
                    { timeOut: 0, preventDuplicates: true }
                );
            } else {
                toastr.clear();
            }
        }

        // Debounce, ´para evitar múltiples llamadas
        function debounce(func, delay) {
            return function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(this, arguments), delay);
            };
        }

        function showSuccessMessage(msg) {
            $('#success-message').removeClass('d-none').text(msg).fadeIn().delay(3000).fadeOut();
        }

        function showErrorMessage(msg) {
            $('#error-message').removeClass('d-none').text(msg).fadeIn().delay(3000).fadeOut();
        }
    </script>
@stop