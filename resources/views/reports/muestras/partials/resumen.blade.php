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
                            <span class="d-none d-md-inline">Data de: </span>
                            <i
                                id="resumen-start-date-indicator">{{ ucfirst(now()->startOfMonth()->format('d/m/Y')) }}</i>
                            - <i id="resumen-end-date-indicator">{{ ucfirst(now()->format('d/m/Y')) }}</i>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-body py-1">
                <div class="row">
                    <div class="col-12 col-md-9">
                        <form id="resume-filter">
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
                        <button class="btn btn-outline-light w-100" id="resume-clean-filter">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
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
        flatpickr('#resume-filter input[name="start_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });
        flatpickr('#resume-filter input[name="end_date"]', {
            dateFormat: 'Y-m-d',
            locale: 'es',
            maxDate: "today"
        });
        const data = @json($data);

        const resumeTipoMuestras = data.data.by_tipo_muestra;
        const resumeTipoFrasco = data.data.by_tipo_frasco;
        const resumeTipoMuestraLabels = resumeTipoMuestras.map(i => i.tipo);
        const resumeTipoFrascoLabels = resumeTipoFrasco.map(i => i.tipo_frasco);
        const resumeTipoMuestraChartDataset = [{
            label: 'Cantidad de muestras',
            data: resumeTipoMuestras.map(i => i.total),
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
            data: resumeTipoFrasco.map(i => i.total),
            borderColor: generateHslColors(resumeTipoFrascoLabels),
            borderWidth: 1.5,
            backgroundColor: generateHslColors(resumeTipoFrascoLabels, 0.5),
        }];

        const resumeTipoMuestraChart = createChart('#resume-tipo-muestras-chart', resumeTipoMuestraLabels,
            resumeTipoMuestraChartDataset, 'pie');

        const resumeTipoFrascoChart = createChart('#resume-tipo-frasco-chart', resumeTipoFrascoLabels,
            resumeTipoFrascoChartDataset, 'bar', resumeTipoFrascoChartOptions);

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

        function resumeTipoMuestraUpdateChart(data) {
            resumeTipoMuestraChart.data.labels = data.map(i => i.tipo);
            resumeTipoMuestraChart.data.datasets[0].data = data.map(i => i.total);
            resumeTipoMuestraChart.data.datasets[0].backgroundColor = generateHslColors(data, 0.5);
            resumeTipoMuestraChart.update();
            detectChartDataLength(resumeTipoMuestraChart);
        }

        function resumeTipoFrascoUpdateChart(data) {
            resumeTipoMuestraChart.data.labels = data.map(i => i.tipo_frasco);
            resumeTipoFrascoChart.data.datasets[0].data = data.map(i => i.total);
            resumeTipoFrascoChart.data.datasets[0].backgroundColor = generateHslColors(data, 0.5);
            resumeTipoFrascoChart.data.datasets[0].borderColor = generateHslColors(data);
            resumeTipoFrascoChart.update();
            detectChartDataLength(resumeTipoFrascoChart);
        }

        function resumeUpdateGraphics(response) {
            $("#resumen-start-date-indicator").text(new Date(response.filters.start_date).toLocaleDateString(
                'es-PE'));
            $("#resumen-end-date-indicator").text(new Date(response.filters.end_date).toLocaleDateString(
                'es-PE'));

            resumeTipoMuestraUpdateChart(response.data.by_tipo_muestra);
            resumeTipoFrascoUpdateChart(response.data.by_tipo_frasco);
        }

        $('#resume-filter').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serializeArray();
            const start_date = formData.find(i => i.name === 'start_date').value;
            const end_date = formData.find(i => i.name === 'end_date').value;

            $.ajax({
                url: "{{ route('reports.muestras.api') }}",
                method: "GET",
                data: {
                    start_date,
                    end_date
                },
                success: function(response) {
                    resumeUpdateGraphics(response);
                },
                error: function(xhr) {
                    $('#productos-filter button[type="submit"]').prop('disabled', false)
                        .html('<i class="fas fa-filter"></i> Filtrar');
                    const message = xhr.responseJSON?.message || xhr.statusText ||
                        "Error desconocido";
                    toast(message, ToastIcon.ERROR);
                }
            });
        });

        const resumeCleanFilter = $('#resume-clean-filter');
        resumeCleanFilter.on('click', function(e) {
            e.preventDefault();

            // Desactivar botón mientras carga
            resumeCleanFilter.prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);

            // Resetear valores en los flatpickr
            const startPicker = $('#resume-filter input[name="start_date"]')[0]._flatpickr;
            const endPicker = $('#resume-filter input[name="end_date"]')[0]._flatpickr;

            if (startPicker) startPicker.setDate(startOfMonth, true);
            if (endPicker) endPicker.setDate(today, true);

            // Enviar formulario
            $('#resume-filter').trigger('submit');

            // Restaurar botón
            resumeCleanFilter.prop('disabled', false)
                .html('<i class="fas fa-eraser"></i> Limpiar');
        });
    </script>
@endpush('partial-js')
