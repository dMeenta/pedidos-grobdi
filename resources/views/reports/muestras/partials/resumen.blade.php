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
    <div class="col-6">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="mb-0">aaa</h5>
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
                                    style="padding-top: .35rem; padding-bottom: .35rem;" id="resumen-dataset-selector">
                                    <option value="0">Cantidad de muestras</option>
                                    <option value="1">Montos de muestras</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-auto mb-1 mb-md-0 order-1 order-md-2" style="text-align: end;">
                                <span class="badge bg-light px-3 py-2" id="productos-table-data-counter">
                                    0 Productos
                                </span>
                            </div>
                        </div>
                    </div>
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
<div class="row">
    <div class="col-12">
        <div class="card card-danger">
            <div class="card-header">
                <div class="col">
                    <h5 class="mb-0 align-content-end">
                        <i class="fas fa-chart-line"></i> Tendencia de ingresos por muestras
                    </h5>
                    <small>
                        <i>Comparativa detallada con el mes anterior</i>
                    </small>
                </div>
            </div>
            <div class="card-body">
                <font dir="auto" style="vertical-align: inherit;">
                    <font dir="auto" style="vertical-align: inherit;">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="amountSpentByDoctorGroupedByMonthChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; box-sizing: border-box; width: 643px;"
                                width="643" height="250" class="chartjs-render-monitor"></canvas>
                        </div>
                    </font>
                </font>
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
    <script>
        const data = @json($data);
        console.log(data);
        const resumeTiposMuestraLabels = data.data.by_tipo_muestra.map(i => i.tipo);
        const resumeTiposFrascoLabels = data.data.by_tipo_frasco.map(i => i.tipo_frasco);
        const datasets = [{
            label: 'Cantidad de muestras',
            data: [12, 13, 15],
            borderColor: '#fff',
            backgroundColor: generateHslColors(resumeTiposMuestraLabels)
        }]
        const barChartDataset = [{
                label: 'Cantidad de muestras',
                data: [20, 10],
                borderColor: generateHslColors(resumeTiposFrascoLabels),
                borderWidth: 1.5,
                backgroundColor: generateHslColors(resumeTiposFrascoLabels, 0.5),
                hidden: false
            },
            {
                label: 'Montos de muestras',
                data: [36, 50],
                borderColor: generateHslColors(resumeTiposFrascoLabels),
                borderWidth: 1.5,
                backgroundColor: generateHslColors(resumeTiposFrascoLabels, 0.5),
                hidden: true
            },
        ]

        const resumeTipoMuestrasChart = createChart('#resume-tipo-muestras-chart', resumeTiposMuestraLabels,
            datasets, 'pie');

        const resumeTipoFrascoChart = createToggleableChart('#resume-tipo-frasco-chart', resumeTiposFrascoLabels,
            barChartDataset, 'bar');

        $('#resumen-dataset-selector').on('change', function(e) {
            const selectedIndex = Number.parseInt($(this).val());
            updateActiveDataset(resumeTipoFrascoChart, selectedIndex);
        })
    </script>
@endpush('partial-js')
