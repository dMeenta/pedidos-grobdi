<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-dark">
            <div class="card-body text-white">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3>Reporte Detallado por Producto</h3>
                        <p>Análisis completo de ventas y rendimiento por producto</p>
                        <small class="badge bg-light text-dark p-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="d-none d-md-inline">Mostrando datos en el rango:</span>
                            <i id="productos-start-date-indicator">
                                {{ now()->startOfMonth()->format('d/m/Y') }}
                            </i> - <i id="productos-end-date-indicator">{{ date('d/m/Y') }}</i>
                        </small>
                    </div>
                    <div class="col-4 text-end">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-1 order-md-2 mb-2 mb-md-0 text-center">
                                <h3 class="m-0" id="productos-total-products-header-label">
                                    12
                                </h3>
                                <p class="m-0">Productos</p>
                            </div>
                            <div class="col-12 col-md-6 order-2 order-md-1 order-md-2 text-center">
                                <h3 class="m-0" id="productos-total-amount-header-label">S/
                                    12.22
                                </h3>
                                <p class="m-0">Ingresos totales</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Filters -->
<div class="row mb-1">
    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <form id="productos-filter">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Fecha Inicio
                                        </label>
                                        <input type="date" class="form-control"
                                            name="start_date"value="{{ now()->startOfMonth()->toDateString() }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Fecha Fin
                                        </label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ now()->toDateString() }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 align-content-end align-content-md-end mb-md-3">
                                    <button class="btn btn-danger w-100" type="submit">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0 align-content-md-end mb-md-3">
                        <button class="btn btn-outline-dark w-100" id="productos-clean-filter">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cards de estadísticas rápidas -->
<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card h-100 bg-dark">
            <div class="card-body text-center align-content-center">
                <div class="mb-2">
                    <i class="fas fa-boxes fa-2x"></i>
                </div>
                <h4 class="mb-1" id="productos-total-products-card-label">
                    12
                </h4>
                <p class="m-0">Productos</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 bg-danger">
            <div class="card-body text-center align-content-center">
                <div class="mb-2">
                    <i class="fas fa-dollar-sign fa-2x"></i>
                </div>
                <h4 class="mb-1" id="productos-total-amount-card-label">S/
                    133.22
                </h4>
                <p class="m-0">Ingresos Totales</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 bg-dark">
            <div class="card-body text-center align-content-center">
                <div class="mb-2">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                </div>
                <h4 class="mb-1" id="productos-total-units-card-label">
                    44
                </h4>
                <p class="m-0">Unidades Vendidas</p>
            </div>
        </div>
    </div>
</div>
<!-- Gráfica principal mejorada -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">
                            <i class="fas fa-medal"></i> Ranking de Ventas por Producto
                        </h5>
                        <small>
                            <i>Ordenados por: <span id="productos-chart-order-label">Monto total descendente</span></i>
                        </small>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-12 col-md-auto order-2 order-md-1" style="text-align: end;">
                                <select class="badge bg-light border-0"
                                    style="padding-top: .35rem; padding-bottom: .35rem;" id="productos-order-chart">
                                    <option value="0">Monto total descendente</option>
                                    <option value="1">Monto total ascendente</option>
                                    <option value="2">Cantidad descendente</option>
                                    <option value="3">Cantidad ascendente</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-auto mb-1 mb-md-0 order-1 order-md-2" style="text-align: end;">
                                <span class="badge bg-light px-3 py-2" id="productos-table-data-counter">
                                    30 Productos
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Contenedor mejorado con scroll -->
                <div class="chart-container-enhanced position-relative" id="chartContainer">
                    <canvas id="productos-rank-chart"></canvas>
                    @include('empty-chart', ['dataLength' => 0])
                </div>
            </div>
            <div class="card-footer py-2 chart-footer rounded-bottom bg-dark">
                <div class="row text-center">
                    <div class="col-6">
                        <small>
                            <i class="fas fa-chart-bar text-info mr-1"></i>
                            Total de unidades vendidas:
                            <span id="productosVisibles">
                                33
                            </span>
                        </small>
                    </div>
                    <div class="col-6">
                        <small>
                            <i class="fas fa-dollar-sign text-success mr-1"></i>Ingresos Totales: S/
                            <span id="productos-table-total-amount">
                                S/ 22.22
                            </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tabla detallada mejorada -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="m-0">
                            <i class="fas fa-table"></i> Detalle completo de Productos
                        </h5>
                        <small>
                            <i>Información detallada ordenada por:
                                <span id="productos-table-order-label">Monto total descendente</span>
                            </i>
                        </small>
                    </div>
                    <div class="col-auto">
                        <div class="col-12 col-md-auto order-2 order-md-1" style="text-align: end;">
                            <select class="badge bg-light border-0"
                                style="padding-top: .35rem; padding-bottom: .35rem;" id="productos-order-table">
                                <option value="0">Monto total descendente</option>
                                <option value="1">Monto total ascendente</option>
                                <option value="2">Cantidad descendente</option>
                                <option value="3">Cantidad ascendente</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0" style="max-height: 600px;">
                <table class="table table-head-fixed table-text-nowrap table-stripped table-dark m-0">
                    <thead>
                        <tr>
                            <th class="align-content-center text-center py-3">
                                <i class="fas fa-hashtag"></i> Rank
                            </th>
                            <th class="align-content-center py-3">
                                <i class="fas fa-box"></i> Producto
                            </th>
                            <th class="text-center align-content-center py-3">
                                <i class="fas fa-cubes"></i> Unidades
                            </th>
                            <th class="text-center align-content-center py-3">
                                <i class="fas fa-money-bill-wave"></i> Ingresos &#40;S/&#41;
                            </th>
                            <th class="text-center align-content-center py-3">
                                <i class="fas fa-tag"></i> Precio/Und Prom.
                            </th>
                            <th class="align-content-center text-center py-3">
                                <i class="fas fa-chart-pie"></i> % Total
                            </th>
                        </tr>
                    </thead>
                    <tbody id="productos-table-body" class="table-dark">
                        @include('empty-table', ['colspan' => 6, 'dataLength' => 6])
                        @if (isset($productosReport['data']) && count($productosReport['data']) > 0)
                            @foreach ($productosReport['data'] as $index => $producto)
                                <tr>
                                    <td class="text-center align-content-center py-3">
                                        <span class="badge {{ $badgeClass }} px-3 py-2 w-100">
                                            {{ $rankIcon }} {{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td class="align-content-center py-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                            </div>
                                            <div class="ml-2">
                                                <h6 class="m-0">{{ $producto['product'] }}</h6>
                                                <small class="text-muted"><i>Ranking: #{{ $index + 1 }}</i></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-content-center text-center py-3">
                                        {{ number_format($producto['total_products']) }}
                                    </td>
                                    <td class="align-content-center text-center py-3">
                                        <span class="badge bg-success py-1 px-3">
                                            S/ {{ number_format($producto['total_amount'], 2) }}
                                        </span>
                                    </td>
                                    <td class="align-content-center text-center py-3">
                                        <span class="badge bg-success py-1 px-3">
                                            S/ {{ number_format($producto['average_price_per_unit'], 2) }}
                                        </span>
                                    </td>
                                    <td class="align-content-center text-center py-3">
                                        <div class="progress position-relative bg-secondary w-100"
                                            style="height: 1.6rem;">
                                            <div class="progress-bar bg-success progress-bar-striped"
                                                role="progressbar"
                                                style="width: {{ number_format($producto['percentage_amount'], 1) }}%;"
                                                aria-valuenow="{{ number_format($producto['percentage_amount'], 1) }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                            <div
                                                class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
                                                <span class="text-white">
                                                    <strong>{{ number_format($producto['percentage_amount'], 1) }}%</strong>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot class="table-foot-fixed table-dark">
                        <tr>
                            <th colspan="2" class="py-3 align-content-center">
                                <i class="fas fa-calculator"></i> RESUMEN TOTAL
                            </th>
                            <th class="py-3 text-center align-content-center" id="productos-tfoot-total-products">
                                22
                            </th>
                            <th class="py-3 text-center align-content-center" id="productos-tfoot-total-amount">
                                S/ 33.21
                            </th>
                            <th></th>
                            <th class="py-3 text-center align-content-center">100%</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table-foot-fixed {
        position: sticky;
        bottom: 0;
        z-index: 2;
    }

    .table-responsive::-webkit-scrollbar {
        width: 6px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #d40c0c63;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #D40C0D;
    }
</style>

@push('partial-js')
@endpush('partial-js')
