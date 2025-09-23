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
<div class="card mt-2">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Pedidos del día: {{ request()->query('fecha')?request()->query('fecha'):date('Y-m-d') }}</h2>
            @if(in_array($role, ['admin', 'Administracion']))
            @if(in_array($role, ['admin', 'Administracion']))
            <a href="{{ route('export.hojaDeRuta') }}" class="btn btn-outline-success"><i class="fas fa-file-excel mr-1"></i>Descargar Hoja de Ruta del día</a>
            @endif
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('cargarpedidos.create') }}"> <i class="fa fa-plus"></i> Cargar datos</a>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <form action="{{ route('cargarpedidos.index') }}" method="GET">
                    <div class="row">
                        <div class="col-xs-1 col-sm-1 col-md-1">
                            <label for="fecha">Fecha:</label>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <select name="filtro" class="form-control">
                                <option value="deliveryDate">Fecha de Entrega</option>
                                <option value="created_at" {{ request()->query('filtro')=='created_at'?'selected':'' }}>Fecha de Registro</option>
                            </select>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <input class="form-control" type="date" name="fecha" id="fecha" value="{{ request()->query('fecha')?request()->query('fecha'):date('Y-m-d') }}" required>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <form action="{{ route('cargarpedidos.downloadWord') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <b>Seleccione Turno</b>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="turno" id="turno0" value=0 checked>
                                <label class="form-check-label" for="turno0">
                                    Mañana
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="turno" id="turno1" value=1>
                                <label class="form-check-label" for="turno1">
                                    Tarde
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            @if(request()->get('fecha'))
                            <input type="hidden" value={{ request()->get('fecha') }} name="fecha">
                            @else
                            <input type="hidden" value={{ date('Y-m-d') }} name="fecha">
                            @endif
                            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-file-word"></i> Descargar Word</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @error('message')
        <p style="color: red;">{{ $message }}</p>
        @enderror

        <br>
        <div class="table table-responsive">
            <table class="table table-striped table-hover" id="miTabla">
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Id Pedido</th>
                        <th>Cliente</th>
                        <th>Doctor</th>
                        <th>Est. Pago</th>
                        <th>Turno</th>
                        <th>Est. Entrega</th>
                        <th width="200px">distrito</th>
                        <th width="200px">Voucher</th>
                        <th width="200px">Estado Producción</th>
                        <th width="200px">Receta</th>
                        <th width="200px">Zona</th>
                        <th width="200px">Usuario</th>
                        <th width="220px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $arr)
                    <tr>
                        <td>{{ $arr["nroOrder"] }}</td>
                        <td>{{ $arr["orderId"] }}</td>
                        <td>{{ $arr["customerName"] }}</td>
                        <td>{{ $arr["doctorName"] }}</td>
                        <td>{{ $arr["paymentStatus"] }}</td>
                        <form action="{{ route('cargarpedidos.actualizarTurno',$arr->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <td>
                                <select class="form-select form-select-sm" aria-label=".form-select-sm" name="turno" id="turno" onchange="this.form.submit()">
                                    <option disabled>Cambiar turno</option>
                                    <option value=0 {{ $arr->turno ===  0  ? 'selected' : '' }}>Mañana</option>
                                    <option value=1 {{ $arr->turno ===  1  ? 'selected' : '' }}>Tarde</option>
                                </select>
                            </td>
                        </form>
                        @if($arr->user->role->name == 'motorizado' && $arr["paymentStatus"] === "Reprogramado")
                        <td class="table-danger">{{ $arr["deliveryStatus"] }}</td>
                        @else
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <button class="btn btn-info btn-sm btn-show-delivery-states" data-id="{{ $arr['id'] }}">
                                    Ver estado
                                </button>
                            </div>
                        </td>
                        @endif
                        <td>{{ $arr["district"] }}</td>
                        <td>
                            @if ( $arr["voucher"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                            @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                            @endif
                        </td>
                        <td>{{ $arr["productionStatus"] == true ? 'Realizado' : 'Pendiente' }}</td>
                        <td>
                            @if ( $arr["receta"] == 0)
                            <span class="badge rounded-pill bg-danger">Sin imagen</span>
                            @else
                            <span class="badge rounded-pill bg-success">Imagen</span>
                            @endif
                        </td>
                        <td>{{ $arr->zone->name }}</td>
                        <td>{{ $arr->user->name }}</td>
                        <td>
                            <form action="{{ route('cargarpedidos.destroy',$arr->id) }}" method="POST">
                                <a class="btn btn-danger btn-sm" href="{{ route('cargarpedidos.uploadfile',$arr->id) }}"><i class="fa fa-upload"></i>Carga</a>
                                <a class="btn btn-info btn-sm" href="{{ route('cargarpedidos.show',$arr->id) }}" target="_blank"><i class="fa fa-eye"></i> Ver</a>

                                <a class="btn btn-primary btn-sm" href="{{ route('cargarpedidos.edit',$arr->id) }}"><i class="fa-pencil"></i> Editar</a>

                                @csrf
                                @method('DELETE')

                                <!-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button> -->
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @endif
        @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
    </div>
</div>
<div class="modal fade" id="deliveryStatesModal" tabindex="-1" role="dialog" aria-labelledby="deliveryStateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content overflow-hidden">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Historial de estados del pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-content">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deliveryPhotoModal" tabindex="-1" role="dialog" aria-labelledby="deliveryPhotoModalLabel" aria-hidden="true">
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
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        const pedidoId = $(this).data('id');
        const modal = $('#deliveryStatesModal');
        const modalContent = $('#modal-content');
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

        $(document).on('click', '.btn-show-details', function() {
            const imgUrl = $(this).data('img');
            const datetime = $(this).data('datetime');
            const nombre = $(this).data('nombre')
            const lat = $(this).data('lat');
            const lng = $(this).data('lng');

            const detailsContent = $('#detailsDeliveryStateContent');

            detailsContent.html(`
            <img src="${imgUrl}" class="img-fluid rounded mb-3" style="max-height:60vh;">
                ${datetime ? `<p><strong>Fecha y hora:</strong> ${datetime}</p>` : `<p><strong>Nombre del receptor: </strong> ${nombre}</p>` }
                ${lat && lng ? `<a href="https://www.google.com/maps?q=${lat},${lng}" target="_blank">
                        Ver ubicación de la foto
                    </a>` : ''}`);
            $('#deliveryPhotoModal').modal('show');
        });

        $('#detailsDeliveryState').on('click', function() {
            $(this).fadeOut();
        });

        $('.btn-show-delivery-states').on('click', function() {
            const pedidoId = $(this).data('id');
            $.ajax({
                url: `pedido/${pedidoId}/state`,
                type: 'GET',
                success: function(response) {
                    if (!response.success) {
                        toastr.error('No se pudieron cargar los estados del pedido.');
                        return;
                    }
                    modalContent.html(`${response.states.length !== 0 ? `
                    <div class="table-responsive" style="height: 50dvh;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col" rowspan="2" class="align-content-center">Usuario</th>
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
                            <tbody class="text-center">
                                ${response.states.map(estado => 
                                `
                                <tr data-id="${estado.id}">
                                    <td class="align-content-center">${estado.user}</td>
                                    <td class="align-content-center">${estado.state.toUpperCase()}</td>
                                    <td class="align-content-center">${estado.created_at_formatted}</td>
                                    <td class="px-2 py-1 observaciones-cell">
                                        <p class="observaciones-col">${estado.observacion ?? ''}</p>
                                    </td>
                                    <td class="text-center align-content-center">${estado.foto_domicilio ? `
                                        <button class="btn btn-info btn-sm btn-show-details" 
                                            data-img="${estado.foto_domicilio.url}"
                                            data-datetime="${estado.foto_domicilio.datetime}"
                                            data-lat="${estado.foto_domicilio.location.lat}"
                                            data-lng="${estado.foto_domicilio.location.lng}">
                                            Ver
                                        </button>` : '—'}
                                    </td>
                                    <td class="text-center align-content-center">${estado.foto_entrega ? `
                                        <button class="btn btn-info btn-sm btn-show-details" 
                                            data-img="${estado.foto_entrega.url}"
                                            data-datetime="${estado.foto_entrega.datetime}"
                                            data-lat="${estado.foto_entrega.location.lat}"
                                            data-lng="${estado.foto_entrega.location.lng}">
                                            Ver
                                        </button>` : '—'}
                                    </td>
                                    <td class="text-center align-content-center">
                                        ${estado.receptor_info ? `
                                        <button class="btn btn-info btn-sm btn-show-details" 
                                            data-img="${estado.receptor_info.firma}"
                                            data-nombre="${estado.receptor_info.nombre}"
                                            >
                                            Ver
                                        </button>` : '—'}
                                    </td>
                                </tr>`).join("")}
                            </tbody>
                        </table>
                    </div>` : `
                        <div class="d-flex justify-content-center align-items-center text-center" style="height:50dvh;">
                            <h3 class="">
                                <strong>No hay estados para mostrar</strong>
                            </h3>
                        </div>`}`);
                    modal.modal('show');
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON || 'No se pudieron cargar los estados del pedido.');
                    console.error(xhr.responseJSON);

                }
            });
        });
    });
</script>
@stop