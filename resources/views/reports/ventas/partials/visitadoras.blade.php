@php
    $visitadorasReport = $data['visitadorasReport'];
@endphp
<div class="row mb-2">
    <div class="card card-outline card-dark col-8 col-sm-6 col-lg-4">
        <div class="card-body">
            <form id="visitadoras-filter">
                <div class="form-group">
                    <label>Rango de fecha:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="visitadoras-date-range-input">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <button class="btn btn-danger w-100" type="submit">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-dark w-100" id="visitadoras-clean-filter">
                        <i class="fas fa-eraser"></i> Limpiar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-4 col-sm-6 col-lg-8">
        <div class="row">
            <div class="col-12">
                <div class="card bg-danger">
                    <div class="card-body text-center">
                        <h3 id="visitadoras-total-amount-card-label">
                            S/ {{ number_format($visitadorasReport['general_stats']['total_amount'], 2) }}
                        </h3>
                        <p class="mb-0">Monto Total</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card bg-dark">
                    <div class="card-body text-center">
                        <h3 id="visitadoras-total-pedidos-card-label">
                            {{ $visitadorasReport['general_stats']['total_pedidos'] }}
                        </h3>
                        <p class="mb-0">Total de Pedidos</p>
                    </div>
                </div>
            </div>
            <div class="col- col-md-6">
                <div class="card bg-dark">
                    <div class="card-body text-center">
                        <h3 id="visitadoras-top-visitadora">
                            {{ count($visitadorasReport['data']) > 0 ? collect($visitadorasReport['data'])->max('visitadora') : 'Aún no hay' }}
                        </h3>
                        <p class="mb-0">Mejor Visitadora</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-6">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar text-danger"></i> Monto por Visitadora
                </h5>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <canvas id="visitadoras-total-amount-chart" style="height: 400px;"></canvas>
                    @include('empty-chart', ['dataLength' => count($visitadorasReport['data'])])
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-outline card-dark">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar text-danger"></i> Cantidad de pedidos por Visitadora
                </h5>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <canvas id="visitadoras-percentages-chart" style="height: 400px;"></canvas>
                    @include('empty-chart', ['dataLength' => count($visitadorasReport['data'])])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="mb-0">
                    <i class="fas fa-table"></i> Estadísticas Detalladas
                </h5>
            </div>
            <div class="card-body p-0">
                <table class="table-dark table-hover table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Visitadora</th>
                            <th colspan="2" class="text-center">Monto total</th>
                            <th class="text-center">Cantidad de Pedidos</th>
                        </tr>
                    </thead>
                    <tbody id="visitadoras-table-body">
                        @include('empty-table', [
                            'dataLength' => count($visitadorasReport['data']),
                            'colspan' => 4,
                        ])
                        @if ($visitadorasReport['data'] && count($visitadorasReport['data']) > 0)
                            @foreach ($visitadorasReport['data'] as $visitadora)
                                <tr>
                                    <td>{{ $visitadora['visitadora'] }}</td>
                                    <td class="text-center">S/ {{ $visitadora['total_amount'] }}</td>
                                    <td class="text-center"><span
                                            class="badge bg-danger">{{ $visitadora['pedidos_percentage'] }}%</span></td>
                                    <td class="text-center">{{ $visitadora['total_pedidos'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Botón Descargar Excel -->
<div class="text-center mt-4">
    <button class="btn btn-success" id="descargar-excel-visitadora">
        <i class="fas fa-download"></i> Descargar Detallado Excel
    </button>
</div>

@push('partial-js')
    <script>
        const visitadorasTableBody = $('#visitadoras-table-body')
        const visitadorasDateRangeInput = $('#visitadoras-date-range-input')
        visitadorasDateRangeInput.daterangepicker({
            startDate: moment().startOf('month'),
            endDate: moment(),
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                monthNames: [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
                firstDay: 1
            }
        });

        const visitadorasReport = @json($visitadorasReport);
        const visitadorasLabels = visitadorasReport.data.map(i => i.visitadora)
        const visitadorasTotalAmountChartDataset = [{
            label: 'Monto Total',
            data: visitadorasReport.data.map(i => i.total_amount),
            backgroundColor: 'rgba(212, 12, 13, 0.4)',
            borderColor: 'rgba(255, 0, 0, 1)',
            borderWidth: 0.9
        }];

        const visitadorasPercentagesChartDataset = [{
            label: 'Pedidos por visitadora (%)',
            data: visitadorasReport.data.map(i => i.pedidos_percentage),
            backgroundColor: generateHslColors(visitadorasReport.data.map(i => i.visitadora)),
            borderColor: '#fff',
            borderWidth: 2
        }]

        const visitadorasTotalAmountChartOptions = {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': S/ ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        };

        const visitadorasPercentagesChartOptions = {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed;
                            return context.label + ': ' + value.toLocaleString() + '%';
                        }
                    }
                }
            }
        };

        let visitadorasTotalAmountChart = createChart('#visitadoras-total-amount-chart', visitadorasLabels,
            visitadorasTotalAmountChartDataset,
            'bar', visitadorasTotalAmountChartOptions);
        let visitadorasPercentagesChart = createChart('#visitadoras-percentages-chart', visitadorasLabels,
            visitadorasPercentagesChartDataset, 'pie', visitadorasPercentagesChartOptions);

        $('#visitadoras-filter').on('submit', function(e) {
            e.preventDefault();
            const range = visitadorasDateRangeInput.val().split(' - ');
            const start_date = range[0].split('/').reverse().join('-');
            const end_date = range[1].split('/').reverse().join('-');

            $.ajax({
                url: "{{ route('reports.ventas.visitadoras') }}",
                method: "GET",
                data: {
                    start_date,
                    end_date
                },
                success: function(response) {
                    visitadorasUpdateGraphics(response);
                },
                error: function(xhr) {
                    const message = xhr.responseJSON?.message || xhr.statusText || "Error desconocido";
                    toast(message, ToastIcon.ERROR);
                }
            });
        })

        function visitadorasUpdateCharts(chart, labels, dataset, arrayForColors) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = dataset;
            if (arrayForColors) {
                chart.data.datasets[0].backgroundColor = generateHslColors(arrayForColors);
            }
            chart.update();
            detectChartDataLength(chart);
        }

        function visitadorasUpdateGraphics(res) {
            $('#visitadoras-total-amount-card-label').text('S/ ' + getFormattedMoneyValue(res.general_stats.total_amount));
            $('#visitadoras-total-pedidos-card-label').text(res.general_stats.total_pedidos);
            $('#visitadoras-top-visitadora').text(res.general_stats.top_visitadora);

            const labels = res.data.map(i => i.visitadora);

            visitadorasUpdateCharts(visitadorasTotalAmountChart, labels, res.data.map(i => i.total_amount));

            visitadorasUpdateCharts(visitadorasPercentagesChart, labels, res.data.map(i => i.pedidos_percentage), labels);

            tableRenderRows(visitadorasTableBody, res.data,
                (i) => `
                <tr>
                    <td>${i.visitadora}</td>
                    <td class="text-center">${i.total_amount}</td>
                    <td class="text-center"><span class="badge bg-primary">${i.pedidos_percentage}%</span></td>
                    <td class="text-center">${i.total_pedidos}</td>
                </tr>`);
        }

        $('#visitadoras-clean-filter').on('click', function(e) {
            e.preventDefault();

            // Desactivar botón mientras carga
            $('#visitadoras-clean-filter').prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Cargando...');

            const picker = visitadorasDateRangeInput.data('daterangepicker');
            picker.setStartDate(moment().startOf('month'));
            picker.setEndDate(moment());
            visitadorasDateRangeInput.val(
                moment().startOf('month').format('YYYY-MM-DD') + ' - ' + moment().format('YYYY-MM-DD')
            );

            $('#visitadoras-filter').trigger('submit');

            $('#visitadoras-clean-filter').prop('disabled', false)
                .html('<i class="fas fa-eraser"></i> Limpiar');
        });
    </script>
@endpush('partial-js')
