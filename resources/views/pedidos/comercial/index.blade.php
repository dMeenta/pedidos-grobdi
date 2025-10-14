@extends('adminlte::page')

@section('title', 'Pedidos Comercial')

@section('content')
<div class="card pedidos-comercial-card mt-4">
    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
        <h3 class="card-title mb-0">Pedidos Comercial</h3>
        <div class="d-flex flex-column flex-sm-row">
            <a
                href="{{ route('pedidoscomercial.export', $filters ?? []) }}"
                class="btn btn-success btn-sm mb-2 mb-sm-0 mr-sm-2"
            >
                <i class="fa fa-file-excel"></i> Exportar Excel
            </a>
            <a
                href="{{ route('pedidoscomercial.index') }}"
                class="btn btn-outline-secondary btn-sm"
            >
                Limpiar filtros
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('pedidoscomercial.index') }}" method="GET" class="mb-4">
            <div class="p-3 p-md-4 bg-light border rounded shadow-sm">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="fecha_inicio" class="text-muted font-weight-bold">Fecha inicio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input
                                type="date"
                                name="fecha_inicio"
                                id="fecha_inicio"
                                class="form-control"
                                value="{{ $filters['fecha_inicio'] ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="fecha_fin" class="text-muted font-weight-bold">Fecha fin</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-calendar-check-o"></i></span>
                            </div>
                            <input
                                type="date"
                                name="fecha_fin"
                                id="fecha_fin"
                                class="form-control"
                                value="{{ $filters['fecha_fin'] ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="order_id" class="text-muted font-weight-bold">Order ID</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-barcode"></i></span>
                            </div>
                            <input
                                type="text"
                                name="order_id"
                                id="order_id"
                                class="form-control"
                                placeholder="Buscar order ID"
                                value="{{ $filters['order_id'] ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="cliente" class="text-muted font-weight-bold">Cliente</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-user"></i></span>
                            </div>
                            <input
                                type="text"
                                name="cliente"
                                id="cliente"
                                class="form-control"
                                placeholder="Buscar cliente"
                                value="{{ $filters['cliente'] ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="visitadora" class="text-muted font-weight-bold">Visitadora</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-id-badge"></i></span>
                            </div>
                            <input
                                type="text"
                                name="visitadora"
                                id="visitadora"
                                class="form-control"
                                placeholder="Buscar visitadora"
                                value="{{ $filters['visitadora'] ?? '' }}"
                            >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="doctor" class="text-muted font-weight-bold">Doctor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white"><i class="fa fa-stethoscope"></i></span>
                            </div>
                            <input
                                type="text"
                                name="doctor"
                                id="doctor"
                                class="form-control"
                                placeholder="Buscar doctor"
                                value="{{ $filters['doctor'] ?? '' }}"
                            >
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary shadow-sm mr-2">
                        <i class="fa fa-search"></i> Aplicar filtros
                    </button>
                    <a href="{{ route('pedidoscomercial.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-undo"></i> Restablecer
                    </a>
                </div>
            </div>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $modalPedidos = [];
        @endphp

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Cliente</th>
                        <th>Visitadora</th>
                        <th>Doctor</th>
                        <th>Distrito</th>
                        <th>Estado</th>
                        <th>Precio total</th>
                        <th>Zona de entrega</th>
                        <th>Usuario registrado</th>
                        <th>Productos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pedidos as $pedido)
                        @php
                            $modalPedidos[] = $pedido;
                        @endphp
                        <tr>
                            <td>{{ $pedido->orderId }}</td>
                            <td>
                                <div class="font-weight-bold">{{ $pedido->customerName }}</div>
                                <small class="text-muted">{{ $pedido->customerNumber }}</small>
                            </td>
                            <td>{{ optional($pedido->visitadora)->name ?? 'Sin asignar' }}</td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-outline-primary btn-sm"
                                    data-toggle="modal"
                                    data-target="#doctorModal-{{ $pedido->id }}"
                                >
                                    Ver doctor
                                </button>
                            </td>
                            <td>{{ $pedido->district ?? optional(optional($pedido->doctor)->distrito)->name }}</td>
                            <td>
                                @if ($pedido->status)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Inactivo</span>
                                @endif
                            </td>
                            <td>S/ {{ number_format($pedido->prize ?? 0, 2) }}</td>
                            <td>{{ optional($pedido->zone)->name ?? 'Sin zona' }}</td>
                            <td>{{ optional($pedido->user)->name ?? 'Sin registrar' }}</td>
                            <td>
                                <button
                                    type="button"
                                    class="btn btn-outline-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#productosModal-{{ $pedido->id }}"
                                >
                                    Ver productos
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No se encontraron pedidos con los filtros seleccionados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @foreach ($modalPedidos as $modalPedido)
            <div
                class="modal fade"
                id="doctorModal-{{ $modalPedido->id }}"
                tabindex="-1"
                role="dialog"
                aria-labelledby="doctorModalLabel-{{ $modalPedido->id }}"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="doctorModalLabel-{{ $modalPedido->id }}">Información del doctor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($modalPedido->doctor)
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <strong>Nombre:</strong>
                                        <div>{{ $modalPedido->doctor->name }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Tipo médico:</strong>
                                        <div>{{ $modalPedido->doctor->tipo_medico ?? 'Sin definir' }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Especialidad:</strong>
                                        <div>{{ optional(optional($modalPedido->doctor)->especialidad)->name ?? 'No registrada' }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Centro de salud:</strong>
                                        <div>{{ optional(optional($modalPedido->doctor)->centrosalud)->name ?? 'No registrado' }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Distrito:</strong>
                                        <div>{{ optional(optional($modalPedido->doctor)->distrito)->name ?? ($modalPedido->district ?? 'No registrado') }}</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <strong>Secretaria:</strong>
                                        <div>{{ $modalPedido->doctor->name_secretariat ?? 'No registrada' }}</div>
                                    </div>
                                </div>
                            @elseif(!empty($modalPedido->doctorName))
                                <div class="border rounded p-3 bg-white">
                                    <h5 class="mb-3">Doctor registrado en el pedido</h5>
                                    <p class="mb-2"><strong>Nombre:</strong> {{ $modalPedido->doctorName }}</p>
                                    <p class="mb-2"><strong>Distrito:</strong> {{ $modalPedido->district ?? 'No registrado' }}</p>
                                    <p class="mb-0 text-muted">Este doctor aún no está vinculado al catálogo. Relaciónalo desde mantenimiento para ver más detalles.</p>
                                </div>
                            @else
                                <p class="mb-0">El pedido no tiene un doctor asignado.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="modal fade"
                id="productosModal-{{ $modalPedido->id }}"
                tabindex="-1"
                role="dialog"
                aria-labelledby="productosModalLabel-{{ $modalPedido->id }}"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productosModalLabel-{{ $modalPedido->id }}">
                                Productos del pedido {{ $modalPedido->orderId }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if ($modalPedido->detailpedidos->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio unitario</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modalPedido->detailpedidos as $detalle)
                                                @php
                                                    $detalleTotal = $detalle->sub_total;
                                                    if ($detalleTotal === null) {
                                                        $detalleTotal = ($detalle->unit_prize ?? 0) * ($detalle->cantidad ?? 0);
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $detalle->articulo }}</td>
                                                    <td>{{ $detalle->cantidad }}</td>
                                                    <td>S/ {{ number_format($detalle->unit_prize ?? 0, 2) }}</td>
                                                    <td>S/ {{ number_format($detalleTotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="mb-0">No hay productos activos para este pedido.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if (method_exists($pedidos, 'links'))
            <div class="d-flex justify-content-center">
                {{ $pedidos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@section('css')
    <style>
        .pedidos-comercial-card .card-header {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: #fff;
            border-bottom: 0;
        }

        .pedidos-comercial-card .card-title {
            font-weight: 600;
        }

        .pedidos-comercial-card .btn-outline-secondary {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .pedidos-comercial-card .btn-outline-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .pedidos-comercial-card .table thead th {
            background-color: #f8f9fc;
            border-top: none;
        }

        .pedidos-comercial-card .table tbody tr:hover {
            background-color: #f1f4ff;
        }

        .pedidos-comercial-card .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.6em;
        }

        @media (max-width: 767.98px) {
            .pedidos-comercial-card .card-header {
                text-align: center;
            }

            .pedidos-comercial-card .card-header .d-flex {
                align-items: stretch;
            }

            .pedidos-comercial-card .card-header a {
                width: 100%;
            }
        }
    </style>
@endsection
