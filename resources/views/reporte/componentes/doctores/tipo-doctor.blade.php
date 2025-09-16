<!-- Tab Tipo Doctor -->
<div class="tab-pane fade show active" id="tipo-doctor" role="tabpanel">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-stethoscope text-info"></i> Reporte por Tipo de Doctor
        </h4>
        <div class="text-end">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i> 
                Use los filtros para consultar datos específicos o vea "Todos" por defecto
            </small>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header bg-gradient-primary text-white">
            <h6 class="mb-0">
                <i class="fas fa-filter"></i> Filtros de Consulta (Rango de Fechas)
            </h6>
        </div>
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label for="fecha_inicio_tipo_doctor" class="form-label fw-bold">
                        <i class="fas fa-calendar-day"></i> Fecha Inicio
                    </label>
                    <input type="text" class="form-control form-control-lg" id="fecha_inicio_tipo_doctor" placeholder="YYYY-MM-DD" autocomplete="off">
                    <small class="form-text text-muted">Seleccione una fecha inicial (opcional)</small>
                </div>
                <div class="col-md-4">
                    <label for="fecha_fin_tipo_doctor" class="form-label fw-bold">
                        <i class="fas fa-calendar-check"></i> Fecha Fin
                    </label>
                    <input type="text" class="form-control form-control-lg" id="fecha_fin_tipo_doctor" placeholder="YYYY-MM-DD" autocomplete="off">
                    <small class="form-text text-muted">Seleccione una fecha final (opcional)</small>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-lg w-100" id="filtrar_tipo_doctor">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <button class="btn btn-outline-secondary btn-sm w-100 mt-2" id="limpiar_filtros_tipo_doctor">
                        <i class="fas fa-refresh"></i> Mostrar Todos
                    </button>
                    <small class="form-text text-muted mt-1">
                        <i class="fas fa-info-circle"></i> Puede filtrar por un rango de fechas (inicio, fin o ambos)
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica Principal por Mes -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar"></i> Ventas por Tipo de Doctor (Mensual)
                        </h5>
                        <small class="text-light d-block" id="subtitulo-grafico-tipo">
                            <i class="fas fa-info-circle"></i> Evolución mensual de ventas
                        </small>
                    </div>
                    <div class="text-end small">
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
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> Distribución por Tipo
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
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Estadísticas por Tipo
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
                                        <i class="fas fa-user-md"></i> Tipo
                                    </th>
                                    <th style="min-width: 80px;" class="text-center">
                                        <i class="fas fa-users"></i> Total
                                    </th>
                                    <th style="min-width: 60px;" class="text-center">
                                        <i class="fas fa-percentage"></i> %
                                    </th>
                                    <th style="min-width: 120px;" class="text-end">
                                        <i class="fas fa-dollar-sign"></i> Promedio
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
                                        <i class="fas fa-info-circle"></i> No hay datos disponibles
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
                                            <i class="fas fa-calculator"></i> {{ $total['tipo'] }}
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center py-3">
                    <div class="btn-group" role="group">
                        <button class="btn btn-success btn-lg" id="descargar-excel-tipo-doctor">
                            <i class="fas fa-file-excel"></i> Descargar Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>