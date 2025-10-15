<div class="row">
    <div class="col-12">
        <div class="card bg-dark card-outline card-danger">
            <div class="card-header py-1">
                <div class="row">
                    <div class="col-6 align-content-center">
                        <h6 class="card-title">
                            <i class="fas fa-filter"></i> Filtros
                        </h6>
                    </div>
                    <div class="col-6">
                        <small class="badge bg-light text-dark p-2 float-sm-right">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="d-none d-md-inline">Mostrando datos del mes: </span>
                            <i id="resumen-filter-indicator">{{ ucfirst(now()->translatedFormat('F')) }}</i>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-body py-1">
                <form id="resumen-filter">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="resumen-month-year-picker">Mes y Año</label>
                                <div class="input-group date" id="resumen-month-year-picker">
                                    <input type="text" id="resumen-month-year" name="resumen-month-year"
                                        class="form-control datetimepicker-input" value="{{ now()->format('m/Y') }}"
                                        required="">
                                    <div class="input-group-append" data-target="#resumen-month-year-picker"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 align-content-end align-content-md-end mb-md-3">
                            <button class="btn btn-danger w-100" type="submit">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-danger">
            <div class="card-header">
                <div class="col">
                    <h5 class="mb-0 align-content-end">
                        <i class="fas fa-chart-line"></i> Tendencia de ingresos por muestras
                    </h5>
                    <small>
                        <i>Comparativa detallada con el año anterior</i>
                    </small>
                </div>
            </div>
            <div class="card-body">
                <canvas id="resume-yearly-comparative-chart" height="350" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie"></i> Comparativa por Tipos de Muestras
                </h5>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <canvas id="resume-tipo-muestras-chart" height="300px">
                    </canvas>
                    @include('empty-chart', [
                        'dataLength' => $data['general_stats']['total_muestras'],
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="far fa-chart-bar"></i> Comparativa por Tipos de Frasco
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="position-relative">
                <canvas id="resume-tipo-frasco-chart" height="300px">
                </canvas>
                @include('empty-chart', [
                    'dataLength' => $data['general_stats']['total_muestras'],
                ])
            </div>
        </div>
    </div>
</div>
</div>

@push('partial-js')
    <script>
        const data = @json($data);
        console.log(data);
        const resumeTipoMuestraLabels = data.data.by_tipo_muestra.map(i => i.tipo);
        const resumeTipoFrascoLabels = data.data.by_tipo_frasco.map(i => i.tipo_frasco);
        const resumeTipoMuestraChartDataset = [{
            label: 'Cantidad de muestras',
            data: [20, 10, 25],
            backgroundColor: generateHslColors(resumeTipoMuestraLabels, 0.5),
            hoverOffset: 4
        }];
        resumeTipoFrascoChartOptions = {
            plugins: {
                tooltip: {
                    displayColors: false,
                }
            }
        };
        const resumeTipoFrascoChartDataset = [{
            label: 'Cantidad de muestras',
            data: [20, 10],
            borderColor: generateHslColors(resumeTipoFrascoLabels),
            borderWidth: 1.5,
            backgroundColor: generateHslColors(resumeTipoFrascoLabels, 0.5),
            hidden: false
        }];

        const resumeYearlyComparativeChartDatasets = [{
            label: 'Cantidad de muestras',
            data: data.data.comparative_with_last_year.map(i => i.total_current_year),
            backgroundColor: 'rgba(212, 12, 13, 0.5)',
            borderColor: 'rgba(212, 12, 13, 1)',
            borderWidth: 2,
            pointStyle: 'circle',
            pointRadius: 8,
            pointHoverRadius: 12,
        }, {
            label: 'Cantidad de muestras',
            data: data.data.comparative_with_last_year.map(i => i.total_last_year),
            backgroundColor: 'rgba(53, 53, 53, 0.55)',
            borderColor: 'rgba(53, 53, 53, 1)',
            borderWidth: 2,
            pointStyle: 'circle',
            pointRadius: 8,
            pointHoverRadius: 12,
        }];

        resumeYearlyComparativeChartOptions = {
            interaction: {
                mode: 'index',
                intersect: false
            },
            stacked: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        };

        const resumeTipoMuestraChart = createChart('#resume-tipo-muestras-chart', resumeTipoMuestraLabels,
            resumeTipoMuestraChartDataset, 'pie');

        const resumeTipoFrascoChart = createChart('#resume-tipo-frasco-chart', resumeTipoFrascoLabels,
            resumeTipoFrascoChartDataset, 'bar', resumeTipoFrascoChartOptions);

        function monthLabel(monthNumber) {
            return new Date(2025, parseInt(monthNumber) - 1, 1)
                .toLocaleString("es-ES", {
                    month: "long"
                });
        }

        const resumeYearlyComparativeChart = createChart('#resume-yearly-comparative-chart', data.data
            .comparative_with_last_year.map(i => monthLabel(i.month)), resumeYearlyComparativeChartDatasets, 'line',
            resumeYearlyComparativeChartOptions);

        $('#resumen-tipo-muestra-dataset-selector').on('change', function(e) {
            const selectedIndex = parseInt($(this).val());
            $('#resume-tipo-muestra-showing-label').text($(this).find('option:selected').text());
            updateActiveDataset(resumeTipoMuestraChart, selectedIndex);
        })
        $('#resumen-tipo-frasco-dataset-selector').on('change', function(e) {
            const selectedIndex = parseInt($(this).val());
            $('#resume-tipo-frasco-showing-label').text($(this).find('option:selected').text());
            updateActiveDataset(resumeTipoFrascoChart, selectedIndex);
        })
    </script>
@endpush('partial-js')
