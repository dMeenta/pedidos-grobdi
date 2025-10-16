@php
    $productosReport = $data['productosReport'];

    function getRankData($index)
    {
        return match ((int) $index) {
            0 => ['🥇', 'bg-light'],
            1 => ['🥈', 'bg-warning'],
            2 => ['🥉', 'bg-info'],
            default => ['', 'bg-secondary'],
        };
    }
@endphp
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
                                    {{ $productosReport['general_stats']['total_grouped_products'] }}
                                </h3>
                                <p class="m-0">Productos</p>
                            </div>
                            <div class="col-12 col-md-6 order-2 order-md-1 order-md-2 text-center">
                                <h3 class="m-0" id="productos-total-amount-header-label">S/
                                    {{ number_format($productosReport['general_stats']['total_amount'], 2) }}
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
                    {{ $productosReport['general_stats']['total_grouped_products'] }}
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
                    {{ number_format($productosReport['general_stats']['total_amount'], 2) }}
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
                    {{ $productosReport['general_stats']['total_products'] }}
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
                                    <option value="0" data-order="desc">Monto total descendente</option>
                                    <option value="0" data-order="asc">Monto total ascendente</option>
                                    <option value="1" data-order="desc">Cantidad descendente</option>
                                    <option value="1" data-order="asc">Cantidad ascendente</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-auto mb-1 mb-md-0 order-1 order-md-2" style="text-align: end;">
                                <span class="badge bg-light px-3 py-2" id="productos-rank-chart-data-counter">
                                    20 de {{ $productosReport['general_stats']['total_grouped_products'] }} Productos
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
                    @include('empty-chart', ['dataLength' => count($productosReport['data'])])
                </div>
            </div>
            <div class="card-footer py-2 chart-footer rounded-bottom bg-dark">
                <div class="row text-center">
                    <div class="col-6">
                        <small>
                            <i class="fas fa-chart-bar text-info mr-1"></i>
                            Total de unidades vendidas:
                            <span id="productosVisibles">
                                {{ $productosReport['general_stats']['total_products'] }}
                            </span>
                        </small>
                    </div>
                    <div class="col-6">
                        <small>
                            <i class="fas fa-dollar-sign text-success mr-1"></i>Ingresos Totales: S/
                            <span id="productos-table-total-amount">
                                {{ number_format($productosReport['general_stats']['total_amount'], 2) }}
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
                        <div class="row">
                            <div class="col-12 col-md-auto order-2 order-md-1" style="text-align: end;">
                                <select class="badge bg-light border-0"
                                    style="padding-top: .35rem; padding-bottom: .35rem;" id="productos-order-table">
                                    <option value="total_amount" data-order="desc">Monto total descendente</option>
                                    <option value="total_amount" data-order="asc">Monto total ascendente</option>
                                    <option value="total_products" data-order="desc">Cantidad descendente</option>
                                    <option value="total_products" data-order="asc">Cantidad ascendente</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-auto mb-1 mb-md-0 order-1 order-md-2" style="text-align: end;">
                                <span class="badge bg-light px-3 py-2" id="productos-rank-chart-data-counter">
                                    {{ $productosReport['general_stats']['total_grouped_products'] }} Productos
                                </span>
                            </div>
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
                        @include('empty-table', [
                            'colspan' => 6,
                            'dataLength' => count($productosReport['data']),
                        ])
                        @if (isset($productosReport['data']) && count($productosReport['data']) > 0)
                            @foreach ($productosReport['data'] as $index => $producto)
                                @php
                                    [$rankIcon, $badgeClass] = getRankData($index);
                                @endphp
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
                                {{ $productosReport['general_stats']['total_products'] }}
                            </th>
                            <th class="py-3 text-center align-content-center" id="productos-tfoot-total-amount">
                                S/ {{ number_format($productosReport['general_stats']['total_amount'], 2) }}
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
<!-- Botones de acción mejorados -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-4">
                <h6 class="mb-3 text-muted">
                    <i class="fas fa-download me-2"></i> Exportar Datos
                </h6>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <button class="btn btn-success btn-lg px-4" id="descargar-excel-producto">
                        <i class="fas fa-file-excel me-2"></i> Descargar Excel Completo
                    </button>
                </div>
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

    .chart-container-enhanced {
        position: relative;
        height: 70vh;
        max-height: 800px;
        overflow-y: auto;
        overflow-x: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border: 1px solid #e3e6f0;
    }


    /* Responsive mejoras */
    @media (max-width: 768px) {
        .chart-container-enhanced {
            height: 60vh;
        }

        .chart-footer {
            font-size: 0.8rem;
        }
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
    <script>
        let productosReport = @json($productosReport);
        const productosTableBody = $('#productos-table-body');
        const orderTableSelect = $('#productos-order-table');
        const orderChartSelect = $('#productos-order-chart');

        flatpickr('#productos-filter input[name="start_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });
        flatpickr('#productos-filter input[name="end_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });

        function getBackgroundColor(array) {
            const colors = [];
            const rest = array.length - 3;
            const half = Math.ceil(rest / 2);
            array.forEach((_, index) => {
                if (index < 3) {
                    colors.push('rgba(220, 53, 69, 0.9)');
                } else if (index < 3 + half) {
                    colors.push('rgba(52, 58, 64, 0.9)');
                } else {
                    colors.push('rgba(255, 193, 7, 0.9)');
                }
            });
            return colors;
        }

        const productosColors = getBackgroundColor(productosReport.data.slice(0, 20));

        const productosRankChartDatasets = [{
                label: 'Ingresos por producto',
                data: productosReport.data.slice(0, 20).map(i => i.total_amount),
                backgroundColor: productosColors,
                borderRadius: 3,
                hidden: false,
            },
            {
                label: 'Cantidades vendidas',
                data: productosReport.data.slice(0, 20).map(i => i.total_products),
                backgroundColor: productosColors,
                borderRadius: 3,
                hidden: true,
            }
        ]
        const ProductosChartHelpers = {
            ticks: {
                money(value) {
                    if (value >= 1000000) return 'S/ ' + (value / 1000000).toFixed(1) + 'M';
                    if (value >= 1000) return 'S/ ' + (value / 1000).toFixed(1) + 'K';
                    return 'S/ ' + value.toLocaleString('es-PE');
                },
                quantity(value) {
                    return value;
                }
            }
        };
        const productosRankChartOptions = {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: ProductosChartHelpers.ticks.money
                    }
                },
                y: {
                    ticks: {
                        font: {
                            size: 12
                        },
                        callback: function(value, index) {
                            const label = this.getLabelForValue(value);
                            return `#${index + 1} - ${label.substring(0, 40)}`;
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    displayColors: false,
                    callbacks: {
                        title: function(context) {
                            const index = context[0].dataIndex;
                            const rankData = getRankData(index);
                            return `${rankData.icon} #${index + 1} - ${context[0].label.replace(/^#\d+\s/, '')}`;
                        },
                        label: function(context) {
                            const datasetIndex = context.datasetIndex;
                            const value = context.parsed.x;
                            return `${context.dataset.label}: ${datasetIndex === 0 ? 'S/ '+ getFormattedMoneyValue(value) : value}`;
                        }
                    }
                }
            }
        }
        let productosRankChart = createChart('#productos-rank-chart', productosReport.data.slice(0, 20)
            .map(i => i.product), productosRankChartDatasets, 'bar', productosRankChartOptions);

        $('#productos-order-table').on('change', function(e) {
            const $selectedOption = $(this).find('option:selected');
            const orderDirection = $selectedOption.data('order');
            const fieldToSort = $(this).val();
            $('#productos-table-order-label').text($selectedOption.text());

            productosOrderTableData(productosReport.data, orderDirection, fieldToSort);

            productosUpdateTable(productosReport);
        })

        $('#productos-order-chart').on('change', function(e) {
            const $selectedOption = $(this).find('option:selected');
            const selectedIndex = parseInt($(this).val());
            const orderDirection = $selectedOption.data('order');
            $('#productos-chart-order-label').text($selectedOption.text());

            if (selectedIndex === 0) {
                productosRankChart.options.scales.x.ticks.callback = ProductosChartHelpers.ticks.money;
            } else {
                productosRankChart.options.scales.x.ticks.callback = ProductosChartHelpers.ticks.quantity;
            }

            productosOrderChartData(productosRankChart, orderDirection, selectedIndex);

            updateActiveDataset(productosRankChart, selectedIndex);
        });

        function productosOrderTableData(data, order = 'desc', field) {
            return data.sort((a, b) => {
                return order === 'asc' ? a[field] - b[field] : b[field] - a[field];
            });
        }

        function productosOrderChartData(chart, order = 'desc', datasetIndex) {
            const dataset = chart.data.datasets[datasetIndex];

            const combined = chart.data.labels.map((label, i) => ({
                label,
                value: dataset.data[i],
            }));

            combined.sort((a, b) => (order === 'asc' ? a.value - b.value : b.value - a.value));

            chart.data.labels = combined.map(item => item.label);
            dataset.data = combined.map(item => item.value);
        }

        function getRankData(rank) {
            const rankMap = {
                0: {
                    icon: '🥇',
                    badgeClass: 'bg-light'
                },
                1: {
                    icon: '🥈',
                    badgeClass: 'bg-warning'
                },
                2: {
                    icon: '🥉',
                    badgeClass: 'bg-info'
                },
            };
            return rankMap[rank] || {
                icon: '',
                badgeClass: 'bg-secondary'
            };
        }

        function formatearMoneda(value) {
            if (value >= 1000000) return 'S/ ' + (value / 1000000).toFixed(1) + 'M';
            if (value >= 1000) return 'S/ ' + (value / 1000).toFixed(1) + 'K';
            return 'S/ ' + value.toLocaleString('es-PE');
        }

        function productosUpdateTable(response) {
            $('#productos-tfoot-total-products').text(response.general_stats.total_products);
            $('#productos-tfoot-total-amount').text('S/ ' + getFormattedMoneyValue(response.general_stats
                .total_amount));
            tableRenderRows(productosTableBody, response.data,
                (i, index) => {
                    const {
                        icon,
                        badgeClass
                    } = getRankData(index);
                    return `
                        <tr>
                            <td class="text-center align-content-center py-3">
                                <span class="badge ${badgeClass} px-3 py-2 w-100">
                                    ${icon} ${index+1}
                                </span>
                            </td>
                            <td class="align-content-center py-3">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-box"></i>
                                        </div>
                                    </div>
                                    <div class="ml-2">
                                        <h6 class="m-0">${i.product}</h6>
                                        <small class="text-muted"><i>Ranking: #${index+1}</i></small>
                                    </div>
                                </div>
                            </td>
                            <td class="align-content-center text-center py-3">${i.total_products}</td>
                            <td class="align-content-center text-center py-3">
                                <span class="badge bg-success py-1 px-3">
                                    S/ ${getFormattedMoneyValue(i.total_amount)}
                                </span>
                            </td>
                            <td class="align-content-center text-center py-3">
                                <span class="badge bg-success py-1 px-3">
                                    S/ ${getFormattedMoneyValue(i.average_price_per_unit)}
                                </span>
                            </td>
                            <td class="align-content-center text-center py-3">
                                <div class="progress position-relative bg-secondary w-100" style="height: 1.6rem;">
                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                        style="width: ${getFormattedMoneyValue(i.percentage_amount, 1, 1)}%"
                                        aria-valuenow="${getFormattedMoneyValue(i.percentage_amount, 1, 1)}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
                                        <span class="text-white">
                                            <strong>${getFormattedMoneyValue(i.percentage_amount, 1, 1)}%</strong>
                                        </span>
                                    </div>
                                </div>
                            </td>
                        </tr>`
                });
        };

        function productosUpdateRankChart(response) {
            const slicedResponse = {
                ...response,
                data: response.data.slice(0, 20)
            }

            const labels = slicedResponse.data.map(i => i.product);
            const colors = getBackgroundColor(slicedResponse.data);

            productosRankChart.data.labels = labels;

            productosRankChart.data.datasets[0].data = slicedResponse.data.map(i => i.total_amount);
            productosRankChart.data.datasets[1].data = slicedResponse.data.map(i => i.total_products);
            productosRankChart.data.datasets[0].backgroundColor = colors;
            productosRankChart.data.datasets[1].backgroundColor = colors;

            productosRankChart.update();
            detectChartDataLength(productosRankChart);
        }

        $('#productos-filter').on('submit', function(e) {
            e.preventDefault();
            const start_date = $(this).find('input[name="start_date"]').val();
            const end_date = $(this).find('input[name="end_date"]').val();

            $('#productos-filter button[type="submit"]').prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Cargando...');

            $.ajax({
                url: "{{ route('reports.ventas.productos') }}",
                method: "GET",
                data: {
                    start_date,
                    end_date
                },
                success: function(response) {
                    $('#productos-filter button[type="submit"]').prop('disabled', false)
                        .html('<i class="fas fa-filter"></i> Filtrar');
                    productosUpdateGraphics(response);
                },
                error: function(xhr) {
                    $('#productos-filter button[type="submit"]').prop('disabled', false)
                        .html('<i class="fas fa-filter"></i> Filtrar');
                    const message = xhr.responseJSON?.message || xhr.statusText ||
                        "Error desconocido";
                    toast(message, ToastIcon.ERROR);
                }
            });
        })

        function productosUpdateGraphics(response) {
            productosReport = response;

            $('#productos-start-date-indicator').text(new Date(response.filters.start_date).toLocaleDateString(
                'es-PE'));
            $('#productos-end-date-indicator').text(new Date(response.filters.end_date).toLocaleDateString(
                'es-PE'));
            $('#productos-total-products-header-label')
                .text(response.general_stats.total_grouped_products);
            $('#productos-total-amount-header-label')
                .text(formatearMoneda(response.general_stats.total_amount));
            $('#productos-total-products-card-label')
                .text(response.general_stats.total_grouped_products);
            $('#productos-total-amount-card-label')
                .text('S/ ' + getFormattedMoneyValue(response.general_stats.total_amount));
            $('#productos-total-units-card-label').text(response.general_stats.total_products);
            $('#productos-table-data-counter')
                .text(response.general_stats.total_grouped_products + ' Productos');

            productosUpdateRankChart(response);
            productosUpdateTable(response);
        }

        const productosCleanFilter = $('#productos-clean-filter');
        productosCleanFilter.on('click', function(e) {
            e.preventDefault();

            // Desactivar botón mientras carga
            productosCleanFilter.prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            // Resetear valores en los flatpickr
            const startPicker = $('#productos-filter input[name="start_date"]')[0]._flatpickr;
            const endPicker = $('#productos-filter input[name="end_date"]')[0]._flatpickr;

            if (startPicker) startPicker.setDate(startOfMonth, true);
            if (endPicker) endPicker.setDate(today, true);

            // Enviar formulario
            $('#productos-filter').trigger('submit');

            // Restaurar botón
            productosCleanFilter.prop('disabled', false)
                .html('<i class="fas fa-eraser"></i> Limpiar');
        });
    </script>
@endpush('partial-js')
