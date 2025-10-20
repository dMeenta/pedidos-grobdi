@php
    $provinciasReport = $data['provinciasReport'];
@endphp
<!-- Filtros -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-dark">
            <div class="card-body text-white">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3>Reporte Detallado de Provincias</h3>
                        <p>Análisis completo de ventas y departamentos</p>
                        <small class="badge bg-light text-dark p-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="d-none d-md-inline">Mostrando datos en el rango:</span>
                            <i id="provincias-start-date-indicator">
                                {{ now()->startOfMonth()->format('d/m/Y') }}
                            </i> - <i id="provincias-end-date-indicator">{{ date('d/m/Y') }}</i>
                        </small>
                    </div>
                    <div class="col-4 text-end">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 order-1 order-md-2 mb-2 mb-md-0 text-center">
                                <h3 class="m-0" id="provincias-total-pedidos-header-label">
                                    {{ $provinciasReport['general_stats']['total_pedidos'] }}
                                </h3>
                                <p class="m-0">Pedidos</p>
                            </div>
                            <div class="col-12 col-md-6 order-2 order-md-1 order-md-2 text-center">
                                <h3 class="m-0" id="provincias-total-amount-header-label">S/
                                    {{ number_format($provinciasReport['general_stats']['total_amount'], 2) }}
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
<div class="row mb-1">
    <div class="col-12">
        <div class="card card-outline card-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <form id="provincias-filter">
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
                        <button class="btn btn-outline-dark w-100" id="provincias-clean-filter">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gráfico de Barras Principal -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar mr-1"></i>Ventas por Departamento
                </h5>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <canvas id="provincias-total-amount-chart" style="height: 300px;"></canvas>
                    @include('empty-chart', ['dataLength' => count($provinciasReport['data'])])
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de Pie y Tabla -->
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="m-0">
                            <i class="fas fa-percentage mr-1"></i>Porcentajes por departamento
                        </h5>
                        <small>
                            <i>Porcentajes por:
                                <span id="provincias-percentages-depend-on-label">Monto total</span>
                            </i>
                        </small>
                    </div>
                    <div class="col-auto">
                        <div class="col-12 col-md-auto order-2 order-md-1" style="text-align: end;">
                            <select class="badge bg-light border-0" style="padding-top: .35rem; padding-bottom: .35rem;"
                                id="provincias-percentages-depend-on-select">
                                <option value="0">Monto total</option>
                                <option value="1">Cantidad de pedidos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <canvas id="provincias-percentages-chart" style="min-height: 500px;" width="100%"
                        height="500"></canvas>
                    @include('empty-chart', ['dataLength' => count($provinciasReport['data'])])
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-table"></i> Estadísticas por departamento
                </h5>
            </div>
            <div class="card-body table-responsive p-0" style="max-height: 564px;">
                <table class="table table-head-fixed table-text-nowrap table-striped table-dark">
                    <thead class="table-dark">
                        <tr>
                            <th>Departamento</th>
                            <th class="text-center align-content-center">Ventas &#40;S/&#41;</th>
                            <th class="text-center align-content-center">Pedidos</th>
                            <th class="text-center align-content-center">Detalles</th>
                        </tr>
                    </thead>
                    <tbody id="provincias-detailed-table-body">
                        @include('empty-table', [
                            'colspan' => 5,
                            'dataLength' => count($provinciasReport['data']),
                        ])
                        @if (isset($provinciasReport['data']) && count($provinciasReport['data']) > 0)
                            @foreach ($provinciasReport['data'] as $provincia)
                                <tr>
                                    <td>{{ $provincia['provincia'] }}</td>
                                    <td class="text-center align-content-center">
                                        <span class="badge bg-success py-1 w-100">
                                            S/
                                            {{ number_format($provincia['total_amount'], 2) }}
                                    </td>
                                    </span>
                                    <td class="text-center align-content-center">{{ $provincia['total_pedidos'] }}</td>
                                    <td class="text-center align-content-center">
                                        <button
                                            class="btn btn-sm btn-outline-info provincias-show-detail-pedidos-by-departamento-btn"
                                            data-departamento="{{ $provincia['provincia'] }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot class="table-foot-fixed bg-danger">
                        <tr>
                            <th class="align-content-center py-3">TOTAL</th>
                            <th class="text-center align-content-center py-3" id="provincias-tfooter-total-amount">
                                S/ {{ number_format($provinciasReport['general_stats']['total_amount'], 2) }}</th>
                            <th class="text-center align-content-center py-3" id="provincias-tfooter-total-pedidos">
                                {{ $provinciasReport['general_stats']['total_pedidos'] }}
                            </th>
                            <th class="text-center align-content-center"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <button class="btn btn-success" id="descargar-excel-provincia">
        <i class="fas fa-download"></i> Descargar Detallado Excel
    </button>
</div>
<div class="modal fade" id="provincias-modal-detail-pedidos-by-departamento" tabindex="-1"
    aria-labelledby="provincias-modal-detail-pedidos-by-departamento-label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="provincias-modal-detail-pedidos-by-departamento-label">
                    <i class="fas fa-list-alt me-2"></i>
                    Pedidos Detallados - <span id="modal-departamento-title"></span>
                </h5>
                <button type="button" class="btn btn-outline-warning btn-close" data-bs-dismiss="modal"
                    aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col">
                        <div class="card bg-dark" style="height: 100%;">
                            <div class="card-body text-center align-content-center"
                                id="provincias-modal-total-pedidos-card">
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card bg-danger" style="height: 100%;">
                            <div class="card-body text-center align-content-center"
                                id="provincias-modal-total-amount-card">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card card-outline card-dark">
                            <div class="card-body table-responsive p-0" style="height: 40dvh;">
                                <table class="table table-striped table-head-fixed">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-content-center">ID</th>
                                            <th class="text-center align-content-center">Total &#40;S/&#41;</th>
                                            <th class="align-content-center">Distrito Original</th>
                                            <th class="text-center align-content-center">Creado por</th>
                                            <th class="text-center align-content-center">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody id="provincias-detail-pedidos-by-departamento-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('partial-js')
    <script>
        const provinciasReport = @json($provinciasReport);
        const provinciasModalTotalPedidosCard = $('#provincias-modal-total-pedidos-card');
        const provinciasModalTotalAmountCard = $('#provincias-modal-total-amount-card');
        const provinciasDetailPedidosByDepartamentoBody = $('#provincias-detail-pedidos-by-departamento-body');

        const provinciasTotalAmountChartDataset = [{
            label: 'Ingresos',
            data: provinciasReport.data.map(i => i.total_amount),
            backgroundColor: 'rgba(212, 12, 13, 0.5)',
            borderColor: 'rgba(255, 0, 0, 1)',
            borderWidth: 1
        }];
        const provinciasTotalAmountChartOptions = {
            plugins: {
                title: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': S/ ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
        const provinciasLabels = provinciasReport.data.map(i => i.provincia);
        const provinciasColors = generateHslColors(provinciasReport.data);

        let provinciasTotalAmountChart = createChart('#provincias-total-amount-chart', provinciasLabels,
            provinciasTotalAmountChartDataset, 'bar', provinciasTotalAmountChartOptions);

        const provinciasPercentagesChartDatasets = [{
                label: 'Porcentaje del monto total',
                data: provinciasReport.data.map(i => i.percentage_amount),
                borderColor: '#fff',
                backgroundColor: provinciasColors,
                borderWidth: 2,
                hidden: false
            },
            {
                label: 'Porcentaje de pedidos',
                data: provinciasReport.data.map(i => i.percentage_pedidos),
                borderColor: '#fff',
                backgroundColor: provinciasColors,
                borderWidth: 2,
                hidden: true
            }
        ];
        const provinciasPercentagesChartOptions = {
            plugins: {
                title: {
                    display: true,
                    text: 'Porcentaje del monto total'
                },
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed}%`
                        }
                    }
                }
            }
        }
        let provinciasPercentagesChart = createChart('#provincias-percentages-chart', provinciasLabels,
            provinciasPercentagesChartDatasets, 'pie', provinciasPercentagesChartOptions);

        const provinciasStartDate = $('#provincias-filter input[name="start_date"]');
        flatpickr('#provincias-filter input[name="start_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });
        const provinciasEndDate = $('#provincias-filter input[name="end_date"]');
        flatpickr('#provincias-filter input[name="end_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });

        const provinciasDetailedTableBody = $('#provincias-detailed-table-body');
        $('#provincias-filter').on('submit', function(e) {
            e.preventDefault();
            let startDate = provinciasStartDate.val();
            let endDate = provinciasEndDate.val();

            $.ajax({
                url: `{{ route('reports.ventas.provincias') }}`,
                type: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                },
                success: function(response) {
                    provinciasUpdateGraphics(response);
                },
                error: function(xhr) {
                    const message = xhr.responseJSON?.message || xhr.statusText ||
                        "Error desconocido";
                    toast(message, ToastIcon.ERROR);
                }
            })
        });

        function provinciasUpdateGraphics(response) {
            $('#provincias-start-date-indicator').text(new Date(response.filters.start_date).toLocaleDateString(
                'es-PE'));
            $('#provincias-end-date-indicator').text(new Date(response.filters.end_date).toLocaleDateString(
                'es-PE'));
            $('#provincias-total-pedidos-header-label').text(response.general_stats.total_pedidos)
            $('#provincias-total-amount-header-label')
                .text(getFormattedMoneyValue('S/ ' + getFormattedMoneyValue(response.general_stats.total_amount)))
            provinciasUpdateTable(response.data, response.general_stats);

            const newLabels = response.data.map(i => i.provincia);
            const newColors = generateHslColors(response.data);

            provinciasUpdateTotalAmountChart(response.data.map(i => i.total_amount), newLabels);
            provinciasUpdatePercentagesChart(
                [response.data.map(i => i.percentage_amount), response.data.map(i => i.percentage_pedidos)],
                newColors, newLabels);
        }

        function provinciasUpdateTable(data, generalData) {
            tableRenderRows(provinciasDetailedTableBody, data,
                (i) => `
                <tr>
                    <td>${i.provincia}</td>
                    <td class="text-center align-content-center">
                        <span class="badge bg-success py-1 w-100">
                            S/ ${getFormattedMoneyValue(i.total_amount)}
                        </span>
                    </td>
                    <td class="text-center align-content-center">
                        ${i.total_pedidos}
                    </td>
                    <td class="text-center align-content-center">
                        <button class="btn btn-sm btn-outline-info provincias-show-detail-pedidos-by-departamento-btn"
                            data-departamento="${i.provincia}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>`);
            $('#provincias-tfooter-total-amount')
                .text('S/ ' + getFormattedMoneyValue(generalData.total_amount));
            $('#provincias-tfooter-total-pedidos').text(generalData.total_pedidos);
        }

        function provinciasUpdateTotalAmountChart(datasetData, labels) {
            provinciasTotalAmountChart.data.datasets[0].data = datasetData;
            provinciasTotalAmountChart.data.labels = labels;
            provinciasTotalAmountChart.update();
            detectChartDataLength(provinciasTotalAmountChart);
        }

        function provinciasUpdatePercentagesChart(datasetData, bgColors, labels) {
            if (datasetData.length !== 2) {
                console.error('El gráfico necesita exactamente 2 datasets');
                return;
            }

            provinciasPercentagesChart.data.datasets.forEach((ds, index) => {
                ds.data = datasetData[index];
                ds.backgroundColor = bgColors;
            });

            provinciasPercentagesChart.data.labels = labels;

            provinciasPercentagesChart.update();
            detectChartDataLength(provinciasPercentagesChart);
        }

        $('#provincias-percentages-depend-on-select').on('change', function(e) {
            const selectedIndex = parseInt($(this).val());

            $('#provincias-percentages-depend-on-label').text($(this).find('option:selected').text());

            const activeDataset = provinciasPercentagesChart.data.datasets[selectedIndex];
            provinciasPercentagesChart.options.plugins.title.text = activeDataset.label;

            updateActiveDataset(provinciasPercentagesChart, selectedIndex);
        });

        function openDetailsPedidosByDepartamento(departamento) {
            $('#modal-departamento-title').text(departamento);
            provinciasDetailPedidosByDepartamentoBody.html(`
                            <tr>
                                <td colspan="5" class="text-center py-6">
                                    <div class="spinner-border text-danger" role="status"></div>
                                    <p class="text-muted mt-3 mb-0">Cargando detalles...</p>
                                </td>
                            </tr>`);
            provinciasModalTotalPedidosCard.html(`
                            <div class="spinner-border text-light" role="status"></div>
                                <p class="mt-3 mb-0">Cargando total de pedidos del departamento...</p>`);
            provinciasModalTotalAmountCard.html(`
                            <div class="spinner-border text-light" role="status"></div>
                                <p class="mt-3 mb-0">Cargando monto total del departamento...</p>`);

            const modal = new bootstrap.Modal(document.getElementById('provincias-modal-detail-pedidos-by-departamento'));
            modal.show();

            $.ajax({
                url: `{{ route('reports.ventas.provincias.departamento') }}`,
                type: 'GET',
                data: {
                    departamento: departamento,
                    start_date: provinciasStartDate.val(),
                    end_date: provinciasEndDate.val()
                },
                success: function(response) {
                    if (response.data.length < 1) {
                        provinciasModalTotalPedidosCard.html(`
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5> No hay datos disponibles </h5>
                                    <p>Ajusta los filtros para mostrar información</p>`);
                        provinciasModalTotalAmountCard.html(`
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5> No hay datos disponibles </h5>
                                    <p>Ajusta los filtros para mostrar información</p>`);
                        return;
                    }
                    provinciasModalTotalPedidosCard.html(`
                        <i class="fas fa-boxes fa-2x mb-2"></i>
                        <h4>${response.general_stats.total_pedidos}</h4>
                        <small>Total de Pedidos</small>`)
                    provinciasModalTotalAmountCard.html(`
                        <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                        <h4>S/ ${getFormattedMoneyValue(response.general_stats.total_amount)}</h4>
                        <small>Total de Ingresos</small>`)
                    provinciasUpdateDetailsPedidosByDepartamentoTable(response.data);
                },
                error: function(xhr) {
                    console.error('Error al cargar pedidos:', xhr);
                    tableShowError(provinciasDetailPedidosByDepartamentoBody, 5,
                        'Error de conexión al servidor');
                }
            });
        };

        function provinciasUpdateDetailsPedidosByDepartamentoTable(data) {
            tableRenderRows(
                provinciasDetailPedidosByDepartamentoBody, data,
                (i) => `
                <tr>
                    <td class="text-center align-content-center">${i.id}</td>
                    <td class="text-center align-content-center">S/ ${getFormattedMoneyValue(i.total_amount)}</td>
                    <td class="align-content-center">${i.distrito}</td>
                    <td class="text-center align-content-center">${i.created_by}</td>
                    <td class="text-center align-content-center">${new Date(i.created_at).toLocaleDateString('es-PE')}</td>
                </tr>`
            );
        }

        $(document).on('click', '.provincias-show-detail-pedidos-by-departamento-btn', function(e) {
            openDetailsPedidosByDepartamento($(this).data('departamento'));
        });

        document.addEventListener('DOMContentLoaded', function() {
            const provinciasCloseModalBtn = $('#provincias-modal-detail-pedidos-by-departamento .btn-close')
            provinciasCloseModalBtn.on('click', function(e) {
                const modalElement = document.getElementById(
                    'provincias-modal-detail-pedidos-by-departamento'
                );
                modalElement.style.display = 'none';
                modalElement.classList.remove('show');
                modalElement.setAttribute('aria-hidden', 'true');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }

                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });

        const provinciasCleanFilter = $('#provincias-clean-filter');
        provinciasCleanFilter.on('click', function(e) {
            e.preventDefault();

            // Desactivar botón mientras carga
            provinciasCleanFilter.prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            // Resetear valores en los flatpickr
            const startPicker = $('#provincias-filter input[name="start_date"]')[0]._flatpickr;
            const endPicker = $('#provincias-filter input[name="end_date"]')[0]._flatpickr;

            if (startPicker) startPicker.setDate(startOfMonth, true);
            if (endPicker) endPicker.setDate(today, true);

            // Enviar formulario
            $('#provincias-filter').trigger('submit');

            // Restaurar botón
            provinciasCleanFilter.prop('disabled', false)
                .html('<i class="fas fa-eraser"></i> Limpiar');
        });
    </script>
@endpush('partial-js')
