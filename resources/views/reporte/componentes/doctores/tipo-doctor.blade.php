<!-- Tab Tipo Doctor -->
<div class="tab-pane fade show active" id="tipo-doctor" role="tabpanel">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4">
        <h4 class="mb-2 mb-sm-0">
            <i class="fas fa-stethoscope text-info"></i> <span class="d-none d-sm-inline">Reporte por Tipo de Doctor</span>
            <span class="d-sm-none">Tipo Doctor</span>
        </h4>
        <div class="text-start text-sm-end">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> 
                <span class="d-none d-sm-inline">Use los filtros para consultar datos específicos o vea "Todos" por defecto</span>
                <span class="d-sm-none">Use filtros para datos específicos</span>
            </small>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header bg-gradient-primary text-white">
            <h6 class="mb-0">
                <i class="fas fa-filter"></i> <span class="d-none d-sm-inline">Filtros de Consulta (Rango de Fechas)</span>
                <span class="d-sm-none">Filtros</span>
            </h6>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <label for="fecha_inicio_tipo_doctor" class="form-label fw-bold">
                        <i class="fas fa-calendar-day"></i> Fecha Inicio
                    </label>
                    <input type="text" class="form-control form-control-lg" id="fecha_inicio_tipo_doctor" placeholder="YYYY-MM-DD" autocomplete="off">
                    <small class="form-text text-muted">Seleccione una fecha inicial (opcional)</small>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <label for="fecha_fin_tipo_doctor" class="form-label fw-bold">
                        <i class="fas fa-calendar-check"></i> Fecha Fin
                    </label>
                    <input type="text" class="form-control form-control-lg" id="fecha_fin_tipo_doctor" placeholder="YYYY-MM-DD" autocomplete="off">
                    <small class="form-text text-muted">Seleccione una fecha final (opcional)</small>
                </div>
                <div class="col-12 col-lg-4 mb-3">
                    <button class="btn btn-primary btn-lg w-100 mb-2" id="filtrar_tipo_doctor">
                        <i class="fas fa-filter"></i> <span class="d-none d-sm-inline">Filtrar</span>
                        <span class="d-sm-none">Filtrar</span>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm w-100" id="limpiar_filtros_tipo_doctor">
                        <i class="fas fa-refresh"></i> <span class="d-none d-sm-inline">Mostrar Todos</span>
                        <span class="d-sm-none">Limpiar</span>
                    </button>
                    <small class="form-text text-muted mt-1">
                        <i class="fas fa-info-circle"></i> <span class="d-none d-sm-inline">Puede filtrar por un rango de fechas (inicio, fin o ambos)</span>
                        <span class="d-sm-none">Filtrar por fechas</span>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica Principal por Mes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <div class="mb-2 mb-sm-0">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar"></i> <span class="d-none d-sm-inline">Ventas por Tipo de Doctor (Mensual)</span>
                            <span class="d-sm-none">Ventas Mensuales</span>
                        </h5>
                        <small class="text-light d-block" id="subtitulo-grafico-tipo">
                            <i class="fas fa-info-circle"></i> Evolución mensual de ventas
                        </small>
                    </div>
                    <div class="text-start text-sm-end small">
                        <span class="d-block">Última actualización:</span>
                        <span id="ultima-actualizacion" class="fw-bold">--</span>
                    </div>
                </div>
                <div class="card-body" style="height: 450px; position: relative;">
                    <canvas id="tipoDoctorChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas Complementarias -->
    <div class="row mb-4">
        <div class="col-12 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h5 class="mb-1 mb-sm-0">
                        <i class="fas fa-chart-pie"></i> <span class="d-none d-sm-inline">Distribución por Tipo</span>
                        <span class="d-sm-none">Distribución</span>
                    </h5>
                    <small class="text-light">
                        <i class="fas fa-users"></i> Total de doctores
                    </small>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 400px; position: relative;">
                    <canvas id="tipoDoctorPieChart" style="max-height: 350px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning text-white d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                    <h5 class="mb-1 mb-sm-0">
                        <i class="fas fa-table"></i> <span class="d-none d-sm-inline">Estadísticas por Tipo</span>
                        <span class="d-sm-none">Estadísticas</span>
                    </h5>
                    <small class="text-dark">
                        <i class="fas fa-calculator"></i> Resumen detallado
                    </small>
                </div>
                <div class="card-body p-0">
                    <!-- Contenedor con scroll para la tabla -->
                    <div style="max-height: 350px; overflow-y: auto;">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-dark sticky-top">
                                <tr>
                                    <th style="min-width: 120px;">
                                        <i class="fas fa-user-md"></i> <span class="d-none d-sm-inline">Tipo</span>
                                        <span class="d-sm-none">Tipo</span>
                                    </th>
                                    <th style="min-width: 80px;" class="text-center">
                                        <i class="fas fa-users"></i> <span class="d-none d-sm-inline">Total</span>
                                        <span class="d-sm-none">Tot</span>
                                    </th>
                                    <th style="min-width: 60px;" class="text-center">
                                        <i class="fas fa-percentage"></i> %
                                    </th>
                                    <th style="min-width: 120px;" class="text-end">
                                        <i class="fas fa-dollar-sign"></i> <span class="d-none d-sm-inline">Promedio</span>
                                        <span class="d-sm-none">Prom</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tablaTipoDoctorBody">
                                @if(isset($data['estadisticasTabla']) && count($data['estadisticasTabla']) > 0)
                                    @foreach($data['estadisticasTabla'] as $estadistica)
                                        @if($estadistica['tipo'] !== 'Total')
                                        <tr>
                                            <td>
                                                <span class="badge badge-soft-primary">{{ $estadistica['tipo'] }}</span>
                                            </td>
                                            <td class="text-center">
                                                <strong>{{ $estadistica['total_doctores'] }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info">{{ $estadistica['porcentaje'] }}%</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-success fw-bold">S/ {{ number_format($estadistica['promedio_ventas'], 2) }}</span>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle"></i> <span class="d-none d-sm-inline">No hay datos disponibles</span>
                                        <span class="d-sm-none">Sin datos</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- Footer fijo fuera del scroll -->
                    @if(isset($data['estadisticasTabla']) && count($data['estadisticasTabla']) > 0)
                        @php
                            $total = collect($data['estadisticasTabla'])->firstWhere('tipo', 'Total');
                        @endphp
                        @if($total)
                        <div class="bg-light border-top">
                            <table class="table mb-0">
                                <tfoot>
                                    <tr class="table-secondary">
                                        <th style="min-width: 120px;">
                                            <i class="fas fa-calculator"></i> <span class="d-none d-sm-inline">{{ $total['tipo'] }}</span>
                                            <span class="d-sm-none">Total</span>
                                        </th>
                                        <th style="min-width: 80px;" class="text-center">
                                            <span class="badge bg-primary">{{ $total['total_doctores'] }}</span>
                                        </th>
                                        <th style="min-width: 60px;" class="text-center">
                                            <span class="badge bg-dark">{{ $total['porcentaje'] }}%</span>
                                        </th>
                                        <th style="min-width: 120px;" class="text-end">
                                            <span class="text-primary fw-bold">S/ {{ number_format($total['promedio_ventas'], 2) }}</span>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @endif
                    @endif
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
</div>

<script>
// Agregar estilos responsivos
document.addEventListener('DOMContentLoaded', function() {
    // Estilos CSS responsivos para móviles
    const style = document.createElement('style');
    style.textContent = `
        @media (max-width: 768px) {
            .card-body canvas {
                height: 250px !important;
                max-height: 50vh !important;
            }
            .card h5 {
                font-size: 1.1rem;
            }
            .card h4 {
                font-size: 1.3rem;
            }
            .table th, .table td {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
            .badge {
                font-size: 0.8rem;
            }
        }
        @media (max-width: 576px) {
            .card-body canvas {
                height: 200px !important;
                max-height: 40vh !important;
            }
            .card h5 {
                font-size: 1rem;
            }
            .card h4 {
                font-size: 1.2rem;
            }
            .btn {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }
            .card-header {
                padding: 0.75rem;
            }
            .card-body {
                padding: 1rem;
            }
        }
        @media (max-width: 480px) {
            .card-body canvas {
                height: 180px !important;
                max-height: 35vh !important;
            }
            .table th, .table td {
                padding: 0.25rem;
                font-size: 0.8rem;
            }
        }
    `;
    document.head.appendChild(style);

    // Función para hacer gráficos responsivos
    function makeChartsResponsive() {
        // Configuración común para todos los gráficos
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: window.innerWidth < 768 ? 12 : 14
                        }
                    }
                }
            }
        };

        // Gráfico principal de tipo doctor
        const tipoDoctorChartCanvas = document.getElementById('tipoDoctorChart');
        if (tipoDoctorChartCanvas && window.tipoDoctorChart) {
            window.tipoDoctorChart.options = { 
                ...window.tipoDoctorChart.options, 
                ...commonOptions,
                scales: {
                    ...window.tipoDoctorChart.options.scales,
                    x: {
                        ticks: {
                            maxRotation: 45,
                            minRotation: 0,
                            autoSkip: window.innerWidth < 768
                        }
                    }
                }
            };
            window.tipoDoctorChart.update();
        }

        // Gráfico de pie
        const pieChartCanvas = document.getElementById('tipoDoctorPieChart');
        if (pieChartCanvas && window.tipoDoctorPieChart) {
            window.tipoDoctorPieChart.options = { 
                ...window.tipoDoctorPieChart.options, 
                ...commonOptions 
            };
            window.tipoDoctorPieChart.update();
        }
    }

    // Ejecutar cuando la ventana cambie de tamaño
    window.addEventListener('resize', makeChartsResponsive);
    
    // Ejecutar inicialmente
    makeChartsResponsive();
});
</script>