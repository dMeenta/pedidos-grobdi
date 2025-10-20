<div class="container-fluid p-0">
    <!-- Información Principal del Pedido -->
    <div class="card border-primary mb-3">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0"><i class="fas fa-shopping-cart mr-2"></i>Información del Pedido</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="info-box bg-light p-3 rounded">
                        <small class="text-muted d-block mb-1"><i class="fas fa-hashtag"></i> Nro. Pedido</small>
                        <strong class="text-primary">{{ $pedido->orderId }}</strong>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-box bg-light p-3 rounded">
                        <small class="text-muted d-block mb-1"><i class="fas fa-calendar-plus"></i> Fecha Registro</small>
                        <strong>{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="info-box bg-light p-3 rounded">
                        <small class="text-muted d-block mb-1"><i class="fas fa-calendar-check"></i> Fecha Entrega</small>
                        <strong>{{ \Carbon\Carbon::parse($pedido->deliveryDate)->format('d/m/Y') }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Cliente y Doctor -->
    <div class="card border-info mb-3">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-users mr-2"></i>Cliente y Doctor</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="border-left border-info pl-3">
                        <small class="text-muted d-block mb-1"><i class="fas fa-user"></i> Cliente</small>
                        <strong>{{ $pedido->customerName }}</strong>
                        <div class="mt-2">
                            <small class="text-muted"><i class="fas fa-phone"></i> Teléfono:</small>
                            <span class="ml-2">{{ $pedido->customerNumber }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="border-left border-success pl-3">
                        <small class="text-muted d-block mb-1"><i class="fas fa-user-md"></i> Doctor</small>
                        <strong>{{ $pedido->doctorName }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información de Entrega -->
    <div class="card border-warning mb-3">
        <div class="card-header bg-warning text-dark">
            <h6 class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i>Dirección de Entrega</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <small class="text-muted d-block mb-1"><i class="fas fa-map-pin"></i> Distrito</small>
                    <strong>{{ $pedido->district }}</strong>
                </div>
                <div class="col-md-8 mb-3">
                    <small class="text-muted d-block mb-1"><i class="fas fa-home"></i> Dirección</small>
                    <strong>{{ $pedido->address }}</strong>
                </div>
                <div class="col-md-12">
                    <small class="text-muted d-block mb-1"><i class="fas fa-info-circle"></i> Referencia</small>
                    <p class="mb-0">{{ $pedido->reference ?: 'Sin referencia' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Detalles del Pedido (Artículos) -->
    <div class="card border-success mb-3">
        <div class="card-header bg-success text-white">
            <h6 class="mb-0"><i class="fas fa-box mr-2"></i>Artículos del Pedido</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 300px;">
                <table class="table table-sm table-hover">
                    <thead class="thead-light sticky-top">
                        <tr>
                            <th width="50%">Artículo</th>
                            <th width="20%" class="text-center">Cantidad</th>
                            <th width="15%" class="text-right">P. Unit.</th>
                            <th width="15%" class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedido->detailpedidos as $detailPedido)
                        <tr>
                            <td>{{ $detailPedido->articulo }}</td>
                            <td class="text-center">{{ $detailPedido->cantidad }}</td>
                            <td class="text-right">S/ {{ number_format($detailPedido->unit_prize, 2) }}</td>
                            <td class="text-right font-weight-bold">S/ {{ number_format($detailPedido->sub_total, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Sin artículos registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Estado y Precio -->
    <div class="card border-secondary">
        <div class="card-header bg-secondary text-white">
            <h6 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Estado y Pago</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <small class="text-muted d-block mb-2"><i class="fas fa-dollar-sign"></i> Precio Total</small>
                    <h5 class="mb-0 text-success">S/ {{ number_format($pedido->prize, 2) }}</h5>
                </div>
                <div class="col-md-3 mb-3">
                    <small class="text-muted d-block mb-2"><i class="fas fa-credit-card"></i> Estado Pago</small>
                    @php
                        $paymentBadge = match(strtolower($pedido->paymentStatus)) {
                            'pagado' => 'badge-success',
                            'pendiente' => 'badge-warning',
                            default => 'badge-secondary'
                        };
                    @endphp
                    <span class="badge {{ $paymentBadge }} px-3 py-2">{{ $pedido->paymentStatus }}</span>
                </div>
                <div class="col-md-3 mb-3">
                    <small class="text-muted d-block mb-2"><i class="fas fa-truck"></i> Estado Entrega</small>
                    @php
                        $deliveryBadge = match(strtolower($pedido->deliveryStatus)) {
                            'entregado' => 'badge-success',
                            'en camino', 'en ruta' => 'badge-info',
                            'pendiente' => 'badge-warning',
                            default => 'badge-secondary'
                        };
                    @endphp
                    <span class="badge {{ $deliveryBadge }} px-3 py-2">{{ $pedido->deliveryStatus }}</span>
                </div>
                <div class="col-md-3 mb-3">
                    <small class="text-muted d-block mb-2"><i class="fas fa-cogs"></i> Turno</small>
                    <span class="badge {{ $pedido->turno === 0 ? 'badge-primary' : 'badge-dark' }} px-3 py-2">
                        {{ $pedido->turno === 0 ? 'Mañana' : 'Tarde' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
