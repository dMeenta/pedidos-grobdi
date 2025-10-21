@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')

    <!-- <h1>Pedidos</h1> -->
@stop

@php
    $role = auth()->user()->role->name;
@endphp

@php
    $role = auth()->user()->role->name;
@endphp

@section('content')
    <div class="card card-outline card-danger">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Pedidos del día:
                    {{ request()->query('fecha') ? request()->query('fecha') : date('Y-m-d') }}
                </h2>
                <div>
                    @can('motorizado.viewFormHojaDeRuta')
                        <a href="{{ route('motorizado.viewFormHojaDeRuta') }}" class="btn btn-outline-success"><i
                                class="fas fa-file-excel mr-1"></i>Descargar Hoja de Ruta del día</a>
                    @endcan
                    <a class="btn btn-success" href="{{ route('cargarpedidos.create') }}"> <i class="fas fa-upload"></i>
                        Cargar datos</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-lg-9">
                    <div class="card card-danger h-100">
                        <div class="card-header">
                            <h6 class="card-title"><i class="fa fa-search"></i> Filtrar Pedidos</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cargarpedidos.index') }}" method="GET">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="filtro" class="form-label"><i class="fa fa-calendar-alt"></i> Tipo de
                                            Fecha</label>
                                        <select name="filtro" class="form-select shadow-sm" style="width: 100%;">
                                            <option value="deliveryDate">Fecha de Entrega</option>
                                            <option value="created_at"
                                                {{ request()->query('filtro') == 'created_at' ? 'selected' : '' }}>
                                                Fecha
                                                de Registro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha"><i class="fa fa-calendar"></i>
                                                Fecha</label>
                                            <div class="input-group date shadow-sm" data-target-input="nearest">
                                                <input class="form-control datetimepicker-input" type="date"
                                                    name="fecha" id="fecha"
                                                    value="{{ request()->query('fecha') ? request()->query('fecha') : date('Y-m-d') }}"
                                                    required>
                                                <div class="input-group-append" data-target="#fecha">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="turno" class="form-label"><i class="fa fa-clock"></i> Turno</label>
                                        <select name="turno" class="form-select shadow-sm" style="width: 100%;">
                                            <option value="">Todos</option>
                                            <option value="0" {{ request()->query('turno') == '0' ? 'selected' : '' }}>
                                                Mañana
                                            </option>
                                            <option value="1" {{ request()->query('turno') == '1' ? 'selected' : '' }}>
                                                Tarde
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <button type="submit" class="btn btn-outline-danger w-100 shadow-sm">
                                            <i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card card-dark h-100">
                        <div class="card-header">
                            <h6 class="card-title mb-0"><i class="fa fa-download"></i> Descargar Documento</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cargarpedidos.downloadWord') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <label class="form-label"><i class="fa fa-clock"></i>
                                            Turno</label>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-danger" type="radio"
                                                name="turno" id="turno0" value="0" checked>
                                            <label class="custom-control-label text-primary fw-bold" for="turno0">
                                                Mañana
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input custom-control-input-danger" type="radio"
                                                name="turno" id="turno1" value="1">
                                            <label class="custom-control-label text-warning fw-bold" for="turno1">
                                                Tarde
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if (request()->get('fecha'))
                                            <input type="hidden" value="{{ request()->get('fecha') }}" name="fecha">
                                        @else
                                            <input type="hidden" value="{{ date('Y-m-d') }}" name="fecha">
                                        @endif
                                        <button class="btn btn-outline-dark w-100" type="submit"><i
                                                class="fa fa-file-word"></i>
                                            Descargar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @error('message')
                        <div class="alert alert-danger mt-2 mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table table-responsive">
                        <table class="table table-striped table-hover table-grobdi" id="miTabla">
                            <thead>
                                <tr>
                                    <th class="text-center">Nro</th>
                                    <th class="text-center">Id Pedido</th>
                                    <th>Cliente</th>
                                    <th>Doctor</th>
                                    <th>Est. Pago</th>
                                    <th>Turno</th>
                                    <th>Est. Entrega</th>
                                    <th width="200px">distrito</th>
                                    <th class="text-center" width="200px">Voucher</th>
                                    <th class="text-center" width="200px">Estado Producción</th>
                                    <th width="200px">Receta</th>
                                    <th class="text-center" width="200px">Zona</th>
                                    <th class="text-center" width="200px">Usuario</th>
                                    <th width="220px">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $arr)
                                    <tr>
                                        <td class="text-center">{{ $arr['nroOrder'] }}</td>
                                        <td class="text-center">{{ $arr['orderId'] }}</td>
                                        <td>{{ $arr['customerName'] }}</td>
                                        <td>{{ $arr['doctorName'] }}</td>
                                        <td>{{ $arr['paymentStatus'] }}</td>
                                        <form action="{{ route('cargarpedidos.actualizarTurno', $arr->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <select class="form-select form-select-sm" aria-label=".form-select-sm"
                                                    name="turno" id="turno" onchange="this.form.submit()">
                                                    <option disabled>Cambiar turno</option>
                                                    <option value=0 {{ $arr->turno === 0 ? 'selected' : '' }}>Mañana
                                                    </option>
                                                    <option value=1 {{ $arr->turno === 1 ? 'selected' : '' }}>Tarde
                                                    </option>
                                                </select>
                                            </td>
                                        </form>
                                        <td class="align-middle" style="min-height: 80px;">
                                            <div class="d-flex flex-column justify-content-center h-100">
                                                @php
                                                    $estado = $arr['deliveryStatus'] ?? 'Sin estado';

                                                    $color = match ($estado) {
                                                        'Reprogramado' => 'bg-warning',
                                                        'Entregado' => 'bg-success',
                                                        default => 'bg-dark',
                                                    };
                                                @endphp
                                                <span
                                                    class="badge {{ $color }} mb-2 text-wrap">{{ $estado }}</span>
                                                @can('pedidos.showDeliveryStates')
                                                    <button class="btn btn-info btn-sm btn-show-delivery-records w-100"
                                                        data-id="{{ $arr['id'] }}">
                                                        Historial
                                                    </button>
                                                @endcan
                                            </div>
                                        </td>
                                        <td>{{ $arr['district'] }}</td>
                                        <td class="text-center">
                                            @php
                                                $hasVoucher = $arr['voucher'] == 0;
                                            @endphp
                                            <span
                                                class="badge rounded-pill bg-{{ $hasVoucher ? 'danger' : 'success' }}">{{ $hasVoucher ? 'Sin Imagen' : 'Imagen' }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{ $arr['productionStatus'] == true ? 'Realizado' : 'Pendiente' }}</td>
                                        <td class="text-center">
                                            @php
                                                $hasReceta = $arr['receta'] == 0;
                                            @endphp
                                            <span
                                                class="badge rounded-pill bg-{{ $hasReceta ? 'danger' : 'success' }}">{{ $hasReceta ? 'Sin Imagen' : 'Imagen' }}</span>
                                        </td>
                                        <td class="text-center">{{ $arr->zone->name }}</td>
                                        <td class="text-center">{{ $arr->user->name }}</td>
                                        <td>
                                            <form action="{{ route('cargarpedidos.destroy', $arr->id) }}" method="POST">
                                                <a class="btn btn-danger btn-sm w-100"
                                                    href="{{ route('cargarpedidos.uploadfile', $arr->id) }}"><i
                                                        class="fa fa-upload"></i>Carga</a>
                                                <a class="btn btn-info btn-sm w-100 my-2"
                                                    href="{{ route('cargarpedidos.show', $arr->id) }}" target="_blank"><i
                                                        class="fa fa-eye"></i> Ver</a>

                                                <a class="btn btn-primary btn-sm w-100"
                                                    href="{{ route('cargarpedidos.edit', $arr->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                    Editar</a>

                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="delivery-records-modal" tabindex="-1" role="dialog"
        aria-labelledby="delivery-records-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content overflow-hidden">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Historial de estados del pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="height: 50dvh;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" rowspan="2" class="align-content-center">Usuario</th>
                                    <th scope="col" rowspan="2" class="align-content-center">Estado del pedido</th>
                                    <th scope="col" rowspan="2" class="align-content-center">Fecha del estado</th>
                                    <th scope="col" rowspan="2" class="align-content-center">Observaciones</th>
                                    <th scope="col" colspan="3" class="p-1 align-content-center">Evidencias</th>
                                </tr>
                                <tr class="text-center" class="p-0">
                                    <th scope="col" class="p-1">Domicilio</th>
                                    <th scope="col" class="p-1">Entrega del producto</th>
                                    <th scope="col" class="p-1">Receptor</th>
                                </tr>
                            </thead>
                            <tbody class="text-center" id="delivery-record-tbody">
                                @include('empty-table', ['dataLength' => 0, 'colspan' => 7])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deliveryPhotoModal" tabindex="-1" role="dialog"
        aria-labelledby="deliveryPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content overflow-hidden">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="deliveryPhotoModalLabel">Detalle de evidencia</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center p-3" id="detailsDeliveryStateContent">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style type="text/css">
        .observaciones-cell {
            max-width: 300px;
            min-width: 150px;
            white-space: normal;
        }

        .observaciones-col {
            width: 100%;
            max-height: 90px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            text-align: left;
            box-sizing: border-box;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@stop

@section('plugins.Flatpickr', true)

@section('js')
    <script src="{{ asset('js/table-helpers.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            const pedidoId = $(this).data('id');
            const modal = $('#deliveryStatesModal');
            const modalContent = $('#modal-content');

            flatpickr('#fecha', {
                altInput: true,
                dateFormat: "Y-m-d",
                altFormat: "d/m/Y",
                locale: 'es',
            });

            $('#miTabla').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                },
                pageLength: 25, // 👈 Número por defecto (puedes cambiar a 25, 50, etc.)
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ] // Opciones de cantidad
            });

            const deliveryRecordsTbody = $('#delivery-record-tbody');

            function openDeliveryRecords(pedidoId) {
                tableShowloader(deliveryRecordsTbody, 7, 'historial de estados', "text-info");

                const modal = new bootstrap.Modal(document.getElementById('delivery-records-modal'));
                modal.show();

                $.ajax({
                    url: "{{ route('pedidos.showDeliveryStates', ['id' => '__ID__']) }}".replace('__ID__',
                        pedidoId),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);

                        console.log(response.states.length);
                        tableRenderRows(deliveryRecordsTbody, response.states,
                            (i) => `
                                <tr data-id="${i.id}">
                                    <td class="align-content-center">${i.user}</td>
                                    <td class="align-content-center">${i.state.toUpperCase()}</td>
                                    <td class="align-content-center">${i.created_at_formatted}</td>
                                    <td class="px-2 py-1 observaciones-cell">
                                        <p class="observaciones-col">${i.observacion ?? ''}</p>
                                    </td>
                                    <td class="text-center align-content-center">
                                        ${i.foto_domicilio ? 
                                            `<button class="btn btn-info btn-sm btn-show-details" data-img="${i.foto_domicilio.url}" data-datetime="${i.foto_domicilio.datetime}" data-lat="${i.foto_domicilio.location.lat}" data-lng="${i.foto_domicilio.location.lng}">Ver</button>`
                                        : '—'}
                                    </td>
                                    <td class="text-center align-content-center">
                                        ${i.foto_entrega ? 
                                            `<button class="btn btn-info btn-sm btn-show-details" data-img="${i.foto_entrega.url}" data-datetime="${i.foto_entrega.datetime}" data-lat="${i.foto_entrega.location.lat}" data-lng="${i.foto_entrega.location.lng}">Ver</button>`
                                        : '—'}
                                    </td>
                                    <td class="text-center align-content-center">
                                        ${i.receptor_info ? 
                                            `<button class="btn btn-info btn-sm btn-show-details" data-img="${i.receptor_info.firma}" data-nombre="${i.receptor_info.nombre}">Ver</button>`
                                        : '—'}
                                    </td>
                                </tr>`);
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message || xhr.statusText ||
                            "Error desconocido";
                        tableShowError(provinciasDetailPedidosByDepartamentoBody, 7, message);
                    }
                });
            }

            $(document).on('click', '.btn-show-delivery-records', function(e) {
                openDeliveryRecords($(this).data('id'));
            });

            $(document).on('click', '.btn-show-details', function() {
                const imgUrl = $(this).data('img');
                const datetime = $(this).data('datetime');
                const nombre = $(this).data('nombre')
                const lat = $(this).data('lat');
                const lng = $(this).data('lng');

                const detailsContent = $('#detailsDeliveryStateContent');

                detailsContent.html(
                    `<img src="${imgUrl}" class="img-fluid rounded mb-3" style="max-height:60vh;">
                            ${datetime ?
                                `<p><strong>Fecha y hora:</strong> ${datetime}</p>` :
                                `<p><strong>Nombre del receptor: </strong> ${nombre}</p>`
                            }
                            ${lat && lng ? 
                                `<a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank">Ver ubicación de la foto</a>`:
                                ''
                            }`
                );
                $('#deliveryPhotoModal').modal('show');
            });

            $('#detailsDeliveryState').on('click', function() {
                $(this).fadeOut();
            });
        });
    </script>
@stop
