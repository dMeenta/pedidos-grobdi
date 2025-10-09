@php
    $tipoDoctorReport = $data['tipoDoctorReport'];
@endphp
<div class="card card-outline card-dark mb-3">
    <div class="card-body py-2">
        <div class="row">
            <div class="col-12 col-md-8">
                <form id="tipo-doctor-filter">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="tipo-doctor-year" class="form-label"><i class="fas fa-calendar-check"></i>
                                    Año</label>
                                <input type="text" id="tipo-doctor-year" class="form-control"
                                    placeholder="Seleccione un año" value="{{ date('Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 align-content-end align-content-md-end mb-md-3">
                            <button class="btn btn-danger btn-block w-100" type="submit">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 mt-3 mt-md-0 align-content-md-end mb-md-3">
                <button class="btn btn-outline-dark btn-block w-100" id="tipo-doctor-clean-filter">
                    <i class="fas fa-eraser"></i> Limpiar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Gráfica Principal por Mes -->
<div class="row ">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-danger border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar"></i> Ventas por Tipo de Doctor - Mensual
                        </h5>
                        <small><i>Evolución mensual de ventas</i></small>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-12 col-md-auto" style="text-align: end;">
                                <span class="badge bg-light px-3 py-2 text-sm">
                                    Mostrando datos del año: <span id="tipo-doctor-table-year-indicator">
                                        {{ now()->year }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="height: 450px; position: relative;">
                @include('empty-chart', ['dataLength' => $tipoDoctorReport['resume']['total_amount']])
                <canvas id="tipo-doctor-bar-chart" style="max-height: 400px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Gráficas Complementarias -->
<div class="row mb-4">
    <div class="col-12 col-lg-6">
        <div class="card card-outline card-danger h-100">
            <div class="card-header bg-dark border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-pie"></i> Distribución por Tipo de Doctor
                        </h5>
                        <small><i>Mostrando: <span id="tipo-doctor-pie-chart-showing-label">Ingresos
                                    Totales</span></i></small>
                    </div>
                    <div class="col-auto">
                        <div class="row">
                            <div class="col-12 col-md-auto order-2 order-md-1" style="text-align: end;">
                                <select class="badge bg-light border-0"
                                    style="padding-top: .35rem; padding-bottom: .35rem;"
                                    id="tipo-doctor-pie-chart-select">
                                    <option value="total_amount">Ingresos Totales</option>
                                    <option value="total_pedidos">Cantidad de Pedidos</option>
                                    <option value="total_doctores">Total de Doctores</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center"
                style="height: 400px; position: relative;">
                @include('empty-chart', ['dataLength' => $tipoDoctorReport['resume']['total_amount']])
                <canvas id="tipo-doctor-pie-chart" style="max-height: 350px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card card-danger card-outline h-100">
            <div class="card-header bg-dark">
                <h5 class="m-0">
                    <i class="fas fa-table"></i> <span class="d-none d-sm-inline">Tabla de detalles por Tipo de
                        Doctor</span>
                </h5>
                <small><i>Estadisticas generales</i></small>
            </div>
            <div class="table-responsive card-body p-0">
                <div style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-head-fixed text-nowrap table-light table-striped ">
                        <thead>
                            <tr>
                                <th>
                                    <i class="fas fa-user-md"></i> Tipo
                                </th>
                                <th class="text-center">
                                    <i class="fas fa-users"></i> Cantidad
                                </th>
                                <th class="text-center">
                                    <i class="fas fa-boxes"></i> Pedidos
                                </th>
                                <th class="text-center">
                                    <i class="fas fa-dollar-sign"></i> Ingresos
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-dark" id="tipo-doctor-table-body">
                            @include('empty-table', [
                                'colspan' => 4,
                                'dataLength' => count($tipoDoctorReport['resume']['tipos_resume']),
                            ])
                            @if (isset($tipoDoctorReport) && count($tipoDoctorReport['resume']['tipos_resume']) > 0)
                                @foreach ($tipoDoctorReport['resume']['tipos_resume'] as $tipoDoctor)
                                    <tr>
                                        <td>
                                            <strong>
                                                {{ $tipoDoctor['tipo_medico'] }}
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            {{ $tipoDoctor['total_doctores'] }}
                                        </td>
                                        <td class="text-center">{{ $tipoDoctor['total_pedidos'] }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-success">
                                                S/ {{ number_format($tipoDoctor['total_amount'], 2) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot class="table-dark">
                            <tr>
                                <th>
                                    <i class="fas fa-calculator mr-1"></i> TOTAL
                                </th>
                                <th class="text-center" id="tipo-doctor-tfoot-total-doctores">
                                    {{ $tipoDoctorReport['resume']['total_doctores'] }} Drs.
                                </th>
                                <th class="text-center" id="tipo-doctor-tfoot-total-pedidos">
                                    {{ $tipoDoctorReport['resume']['total_pedidos'] }}
                                </th>
                                <th class="text-center" id="tipo-doctor-tfoot-total-amount">
                                    S/ {{ number_format($tipoDoctorReport['resume']['total_amount'], 2) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Acciones adicionales -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-3">
                <div class="btn-group flex-column flex-sm-row" role="group">
                    <button class="btn btn-success btn-lg mb-2 mb-sm-0 me-sm-2" id="descargar-excel-tipo-doctor">
                        <i class="fas fa-file-excel"></i> <span class="d-none d-sm-inline">Descargar Excel</span>
                        <span class="d-sm-none">Excel</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('partial-js')
    <script>
        let tipoDoctorReport = @json($tipoDoctorReport);
        const tipoDoctorPieChartSelect = $('#tipo-doctor-pie-chart-select');
        const tipoDoctorTableBody = $('#tipo-doctor-table-body');
        const tipoDoctorYearPicker = $('#tipo-doctor-year');
        tipoDoctorYearPicker.datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            startDate: new Date(2020, 0, 1),
            endDate: new Date(new Date().getFullYear(), 11, 31),
            autoclose: true,
            language: "es"
        });

        const tipoDoctorBarChartOptions = {
            responsive: true,
            onResize: function(chart, size) {
                const isMobile = size.width < 768;

                chart.options.plugins.title.font.size = isMobile ? 13 : 16;
                chart.options.plugins.legend.labels.font.size = isMobile ? 12 : 14;

                if (isMobile) {
                    chart.data.labels = chart.data.labels.map(label => label.substring(0, 3));
                } else {
                    chart.data.labels = tipoDoctorReport.data.map(i => monthLabel(i.month));
                }
                chart.update();
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 0
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas Mensuales por Tipo de Doctor',
                    font: {
                        size: window.innerWidth < 768 ? 13 : 16
                    }
                },
                legend: {
                    labels: {
                        font: {
                            size: window.innerWidth < 768 ? 12 : 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': S/ ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        };

        const tipoDoctorTipos = tipoDoctorReport.resume.tipos_resume.map(t => t.tipo_medico);
        const tipoDoctorColorsByTipo = generateHslColors(tipoDoctorTipos);

        const tipoDoctorBarChartDatasets = tipoDoctorTipos.map((tipo, idx) => ({
            label: tipo,
            backgroundColor: tipoDoctorColorsByTipo[idx],
            data: tipoDoctorReport.data.map(mes =>
                mes.tipos_resume.find(t => t.tipo_medico === tipo)?.total_amount || 0
            )
        }));

        function monthLabel(monthNumber) {
            return new Date(2025, parseInt(monthNumber) - 1, 1)
                .toLocaleString("es-ES", {
                    month: "long"
                });
        }

        tipoDoctorBarChart = createChart('#tipo-doctor-bar-chart', tipoDoctorReport.data.map(i => monthLabel(i.month)),
            tipoDoctorBarChartDatasets, 'bar', tipoDoctorBarChartOptions);

        const tipoDoctorPieChartDataset = [{
            data: tipoDoctorReport.resume.tipos_resume.map(i => i.total_amount),
            backgroundColor: tipoDoctorColorsByTipo
        }]

        const tipoDoctorPieChartOptions = {
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            size: window.innerWidth < 768 ? 12 : 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.parsed;
                            return 'Monto total: S/ ' + value.toLocaleString();
                        }
                    }
                }
            }
        };

        tipoDoctorPieChart = createChart('#tipo-doctor-pie-chart', tipoDoctorTipos, tipoDoctorPieChartDataset, 'pie',
            tipoDoctorPieChartOptions);

        function tipoDoctorUpdatePieChart(tipos_resume, data) {
            tipoDoctorPieChart.data.labels = tipos_resume.map(i => i.tipo_medico);
            tipoDoctorPieChart.data.datasets[0].data = data;
            tipoDoctorPieChart.data.datasets[0].backgroundColor = generateHslColors(tipos_resume.map(i => i.tipo_medico));
            tipoDoctorPieChart.update();
            detectChartDataLength(tipoDoctorPieChart);
        }

        tipoDoctorPieChartSelect.on('change', function(e) {
            const optionSelected = $(this).val();
            $('#tipo-doctor-pie-chart-showing-label').text($(this).find('option:selected').text());
            let data = tipoDoctorReport.resume.tipos_resume.map(i => i[optionSelected]);

            const tooltipMessages = {
                total_pedidos: 'Total de pedidos',
                total_doctores: 'Total de doctores',
                default: 'Monto total: S/',
            };
            const message = tooltipMessages[optionSelected] || tooltipMessages.default;

            tipoDoctorPieChart.options.plugins.tooltip.callbacks.label = (context) => {
                const value = context.parsed.toLocaleString();
                return optionSelected === 'total_amount' ?
                    `Monto total: S/ ${value}` :
                    `${message}: ${value}`;
            };

            tipoDoctorUpdatePieChart(tipoDoctorReport.resume.tipos_resume, data);
        });

        $('#tipo-doctor-filter').on('submit', function(e) {
            e.preventDefault()
            const btnPressed = e.originalEvent?.submitter;
            const year = $('#tipo-doctor-year').val();

            if (btnPressed) {
                $(btnPressed).prop('disabled', true)
            }

            $.ajax({
                url: "{{ route('reports.doctores.tipo-doctor') }}",
                method: 'GET',
                data: {
                    year: year
                },
                success: function(response) {
                    toast(`Mostrando datos del año: ${response.filters.year}`, ToastIcon.SUCCESS);
                    tipoDoctorReport = response;
                    updateGraphics(response);
                },
                error: function(xhr) {
                    toast('Hubo un error al traer datos del doctor solicitado', ToastIcon.ERROR);
                },
                complete: function() {
                    if (btnPressed) {
                        $(btnPressed).prop('disabled', false).html('Buscar');
                    }
                }
            });
        });

        function updateGraphics(response) {
            $('#tipo-doctor-table-year-indicator').text(response.filters.year);
            tipoDoctorUpdateBarChart(tipoDoctorReport.resume.tipos_resume.map(t => t.tipo_medico), response.data);
            tipoDoctorUpdatePieChart(response.resume.tipos_resume, response.resume.tipos_resume.map(i => i.total_amount));
            tipoDoctorUpdateTable(response.resume);
        }

        function tipoDoctorUpdateTable(resume) {
            tableRenderRows(tipoDoctorTableBody, resume.tipos_resume, (i) => `
                <tr>
                    <td>
                        <strong>${i.tipo_medico}</strong>
                    </td>
                    <td class="text-center">${i.total_doctores}</td>
                    <td class="text-center">${i.total_pedidos}</td>
                    <td class="text-center">
                        <span class="badge bg-success">
                            S/ ${getFormattedMoneyValue(i.total_amount)}
                        </span>
                    </td>
                </tr>`);
            $('#tipo-doctor-tfoot-total-doctores').text(`${resume.total_doctores} Drs.`);
            $('#tipo-doctor-tfoot-total-pedidos').text(resume.total_pedidos);
            $('#tipo-doctor-tfoot-total-amount').text(`S/ ${resume.total_amount}`);
        }

        function tipoDoctorUpdateBarChart(tipoDoctorTipos, data) {
            const tipoDoctorColorsByTipo = generateHslColors(tipoDoctorTipos);

            tipoDoctorBarChart.data.datasets = tipoDoctorTipos.map((tipo, idx) => ({
                label: tipo,
                backgroundColor: tipoDoctorColorsByTipo[idx],
                data: data.map(mes => mes.tipos_resume.find(t => t.tipo_medico === tipo)?.total_amount || 0)
            }));

            tipoDoctorBarChart.update();
            detectChartDataLength(tipoDoctorBarChart);
        }

        $('#tipo-doctor-clean-filter').on('click', function(e) {
            e.preventDefault();

            const defaultYear = new Date().getFullYear();
            tipoDoctorYearPicker.datepicker('update', new Date(defaultYear, 0, 1));
            tipoDoctorYearPicker.trigger('changeDate');
            $('#tipo-doctor-filter').trigger('submit');
        })
    </script>
@endpush('partial-js')
