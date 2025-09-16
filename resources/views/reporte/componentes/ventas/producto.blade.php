<!-- Tab Producto Mejorado -->
<div class="tab-pane fade" id="producto" role="tabpanel">

    <!-- Header con título y estadísticas generales -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm bg-success">
                <div class="card-body text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-1">
                                <i class="fas fa-chart-bar me-2"></i> Reporte Detallado por Producto
                            </h3>
                            <p class="mb-0 opacity-75">Análisis completo de ventas y rendimiento por producto</p>
                            <div class="mt-2">
                                <small class="badge bg-light text-dark px-3 py-1">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Datos por defecto: <strong>{{ date('d/m/Y', strtotime(date('Y-m-01'))) }} - {{ date('d/m/Y') }}</strong>
                                    <span class="text-muted">(Mes actual)</span>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="text-center">
                                        <h5 class="mb-0" id="header_total_productos">
                                            {{ count($data['productos']['labels'] ?? []) }}</h5>
                                        <small class="opacity-75">Productos</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center">
                                        <h5 class="mb-0" id="header_total_ventas">S/
                                            {{ number_format(array_sum($data['productos']['ventas'] ?? []), 0) }}</h5>
                                        <small class="opacity-75">Ventas Totales</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros con mejor diseño -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-bottom-0">
                    <h6 class="mb-0 text-muted">
                        <i class="fas fa-filter me-2"></i> Filtros de Búsqueda
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="fecha_inicio_producto" class="form-label fw-medium">
                                <i class="fas fa-calendar-alt text-primary me-1"></i> Fecha Inicio
                            </label>
                            <input type="date" class="form-control border-2" id="fecha_inicio_producto">
                        </div>
                        <div class="col-md-3">
                            <label for="fecha_fin_producto" class="form-label fw-medium">
                                <i class="fas fa-calendar-check text-primary me-1"></i> Fecha Fin
                            </label>
                            <input type="date" class="form-control border-2" id="fecha_fin_producto">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary w-100 fw-medium" id="filtrar_producto">
                                <i class="fas fa-search me-2"></i> Buscar Datos
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-secondary w-100 fw-medium" id="limpiar_producto">
                                <i class="fas fa-refresh me-2"></i> Limpiar Filtros
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de estadísticas rápidas -->
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-primary">
                <div class="card-body text-white text-center">
                    <div class="mb-2">
                        <i class="fas fa-boxes fa-2x opacity-75"></i>
                    </div>
                    <h4 class="mb-1" id="stat_total_productos">{{ count($data['productos']['labels'] ?? []) }}</h4>
                    <p class="mb-0 small opacity-75">Total Productos</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-success">
                <div class="card-body text-white text-center">
                    <div class="mb-2">
                        <i class="fas fa-shopping-cart fa-2x opacity-75"></i>
                    </div>
                    <h4 class="mb-1" id="stat_total_unidades">
                        {{ number_format(array_sum($data['productos']['unidades'] ?? [])) }}</h4>
                    <p class="mb-0 small opacity-75">Unidades Vendidas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-info">
                <div class="card-body text-white text-center">
                    <div class="mb-2">
                        <i class="fas fa-dollar-sign fa-2x opacity-75"></i>
                    </div>
                    <h4 class="mb-1" id="stat_total_ingresos">S/
                        {{ number_format(array_sum($data['productos']['ventas'] ?? []), 0) }}</h4>
                    <p class="mb-0 small opacity-75">Ingresos Totales</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 bg-warning">
                <div class="card-body text-white text-center">
                    <div class="mb-2">
                        <i class="fas fa-chart-line fa-2x opacity-75"></i>
                    </div>
                    <h4 class="mb-1" id="stat_precio_promedio">
                        S/
                        {{ array_sum($data['productos']['unidades'] ?? []) > 0 ? number_format(array_sum($data['productos']['ventas'] ?? []) / array_sum($data['productos']['unidades'] ?? []), 2) : '0.00' }}
                    </h4>
                    <p class="mb-0 small opacity-75">Precio Promedio</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica principal mejorada -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-bottom-0 bg-success">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 text-white">
                                <i class="fas fa-chart-bar me-2"></i> Ranking de Ventas por Producto
                            </h5>
                            <small class="text-white opacity-75">Todos los productos ordenados por ingresos</small>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex gap-2 align-items-center">

                                <span class="badge bg-light text-dark px-3 py-2" id="productos_count">
                                    {{ count($data['productos']['labels'] ?? []) }} productos
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">

                    <!-- Contenedor mejorado con scroll -->
                    <div class="chart-container-enhanced" id="chartContainer">
                        <canvas id="productosVentasChart"></canvas>
                    </div>

                    <!-- Información de navegación en la parte inferior -->
                    <div class="chart-footer p-2 bg-light border-top">
                        <div class="row text-center">
                            <div class="col-4">
                                <small class="text-muted">
                                    <i class="fas fa-chart-bar text-success"></i>
                                    <span id="productosVisibles">0</span> productos mostrados
                                </small>
                            </div>
                            <div class="col-4">
                                <small class="text-muted">
                                    <i class="fas fa-dollar-sign text-info"></i>
                                    Total: S/ <span id="totalVisible">0</span>
                                </small>
                            </div>
                            <div class="col-4">
                                <small class="text-muted">
                                    <i class="fas fa-mouse-pointer text-warning"></i>
                                    Hover para detalles
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla detallada mejorada -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-bottom-0 bg-primary">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 text-white">
                                <i class="fas fa-table me-2"></i> Detalle Completo de Productos
                            </h5>
                            <small class="text-white opacity-75">Información detallada con métricas de
                                rendimiento</small>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-light btn-sm" onclick="exportarTabla()">
                                <i class="fas fa-download me-1"></i> Exportar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Tabla con scroll vertical y mejor diseño -->
                    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="sticky-top bg-dark">
                                <tr class="text-white">
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-hashtag me-1"></i> #
                                    </th>
                                    <th class="border-0 py-3">
                                        <i class="fas fa-box me-1"></i> Producto
                                    </th>
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-cubes me-1"></i> Unidades
                                    </th>
                                    <th class="text-end border-0 py-3">
                                        <i class="fas fa-money-bill-wave me-1"></i> Ingresos (S/)
                                    </th>
                                    <th class="text-end border-0 py-3">
                                        <i class="fas fa-tag me-1"></i> Precio Prom. (S/)
                                    </th>
                                    <th class="text-center border-0 py-3">
                                        <i class="fas fa-chart-pie me-1"></i> % Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tabla_productos">
                                @if (isset($data['productos']['labels']) && count($data['productos']['labels']) > 0)
                                    @php
                                        $totalVentas = array_sum($data['productos']['ventas'] ?? []);

                                        // Crear array combinado para ordenar por ventas
                                        $productos = [];
                                        foreach ($data['productos']['labels'] as $index => $producto) {
                                            $productos[] = [
                                                'nombre' => $producto,
                                                'unidades' => $data['productos']['unidades'][$index] ?? 0,
                                                'ventas' => $data['productos']['ventas'][$index] ?? 0,
                                            ];
                                        }

                                        // Ordenar por ventas descendente
                                        usort($productos, function ($a, $b) {
                                            return $b['ventas'] <=> $a['ventas'];
                                        });
                                    @endphp

                                    @foreach ($productos as $index => $producto)
                                        @php
                                            $porcentaje =
                                                $totalVentas > 0 ? ($producto['ventas'] / $totalVentas) * 100 : 0;
                                            $precioPromedio =
                                                $producto['unidades'] > 0
                                                    ? $producto['ventas'] / $producto['unidades']
                                                    : 0;

                                            // Colores para el ranking
                                            $badgeClass = 'bg-secondary';
                                            if ($index == 0) {
                                                $badgeClass = 'bg-warning';
                                            } elseif ($index == 1) {
                                                $badgeClass = 'bg-secondary';
                                            } elseif ($index == 2) {
                                                $badgeClass = 'bg-info';
                                            } elseif ($index < 10) {
                                                $badgeClass = 'bg-success';
                                            }
                                        @endphp
                                        <tr class="border-bottom">
                                            <td class="text-center py-3">
                                                <span class="badge {{ $badgeClass }} px-3 py-2 fs-6">
                                                    @if ($index == 0)
                                                        🥇
                                                    @elseif($index == 1)
                                                        🥈
                                                    @elseif($index == 2)
                                                        🥉
                                                    @endif
                                                    {{ $index + 1 }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 40px; height: 40px;">
                                                            <i class="fas fa-box"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $producto['nombre'] }}</h6>
                                                        <small class="text-muted">Ranking:
                                                            #{{ $index + 1 }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center py-3">
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fs-6">
                                                    {{ number_format($producto['unidades']) }}
                                                </span>
                                            </td>
                                            <td class="text-end py-3">
                                                <h6 class="mb-0 text-success fw-bold">
                                                    S/ {{ number_format($producto['ventas'], 2) }}
                                                </h6>
                                            </td>
                                            <td class="text-end py-3">
                                                <span class="fw-medium">
                                                    S/ {{ number_format($precioPromedio, 2) }}
                                                </span>
                                            </td>
                                            <td class="text-center py-3">
                                                <div class="progress"
                                                    style="height: 25px; background-color: #e9ecef;">
                                                    <div class="progress-bar bg-success progress-bar-striped"
                                                        role="progressbar" style="width: {{ $porcentaje }}%;"
                                                        aria-valuenow="{{ $porcentaje }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span
                                                            class="fw-bold">{{ number_format($porcentaje, 1) }}%</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                                <h5>No hay datos disponibles</h5>
                                                <p>Ajusta los filtros para mostrar información</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                            <tfoot class="sticky-bottom bg-light border-top">
                                <tr class="fw-bold">
                                    <th colspan="2" class="text-end py-3 bg-dark text-white">
                                        <i class="fas fa-calculator me-2"></i> RESUMEN TOTAL
                                    </th>
                                    <th class="text-center py-3 bg-dark text-white" id="total_unidades">
                                        {{ number_format(array_sum($data['productos']['unidades'] ?? [])) }}
                                    </th>
                                    <th class="text-end py-3 bg-dark text-white" id="total_ventas">
                                        S/ {{ number_format(array_sum($data['productos']['ventas'] ?? []), 2) }}
                                    </th>
                                    <th class="text-end py-3 bg-dark text-white" id="promedio_precio">
                                        S/
                                        {{ array_sum($data['productos']['unidades'] ?? []) > 0 ? number_format(array_sum($data['productos']['ventas'] ?? []) / array_sum($data['productos']['unidades'] ?? []), 2) : '0.00' }}
                                    </th>
                                    <th class="text-center py-3 bg-dark text-white">100%</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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
</div>

<style>
    .chart-container-enhanced {
        position: relative;
        height: 70vh;
        max-height: 800px;
        overflow-y: auto;
        overflow-x: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border: 1px solid #e3e6f0;
    }

    /* Scroll personalizado más elegante */
    .chart-container-enhanced::-webkit-scrollbar {
        width: 14px;
    }

    .chart-container-enhanced::-webkit-scrollbar-track {
        background: linear-gradient(180deg, #f1f3f5 0%, #e9ecef 100%);
        border-radius: 10px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .chart-container-enhanced::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #28a745 0%, #20c997 100%);
        border-radius: 10px;
        border: 2px solid #f1f3f5;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .chart-container-enhanced::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #218838 0%, #1ea87e 100%);
        transform: scale(1.1);
    }

    /* Indicador de posición de scroll */
    .chart-container-enhanced::before {
        content: '';
        position: absolute;
        top: 0;
        right: 20px;
        width: 4px;
        height: 100%;
        background: rgba(40, 167, 69, 0.1);
        z-index: 1000;
        pointer-events: none;
    }

    /* Efecto de fade en los bordes para indicar scroll */
    .chart-container-enhanced::after {
        content: '';
        position: sticky;
        top: 0;
        left: 0;
        right: 0;
        height: 20px;
        background: linear-gradient(180deg, rgba(248, 249, 250, 0.9) 0%, rgba(248, 249, 250, 0) 100%);
        z-index: 999;
        pointer-events: none;
    }

    /* Mejoras para la tabla */
    .table-enhanced {
        font-size: 0.9rem;
    }

    .table-enhanced th {
        background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border: none;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-enhanced tbody tr:hover {
        background: linear-gradient(90deg, rgba(40, 167, 69, 0.05) 0%, rgba(40, 167, 69, 0.1) 50%, rgba(40, 167, 69, 0.05) 100%);
        transform: translateX(2px);
        transition: all 0.2s ease;
    }

    .ranking-badge {
        position: relative;
        overflow: hidden;
    }

    .ranking-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .ranking-badge:hover::before {
        left: 100%;
    }

    /* Animación para barras de progreso */
    .progress-animated .progress-bar {
        animation: progressAnimation 2s ease-in-out;
    }

    @keyframes progressAnimation {
        0% {
            width: 0%;
        }

        100% {
            width: var(--progress-width);
        }
    }

    /* Responsive mejoras */
    @media (max-width: 768px) {
        .chart-container-enhanced {
            height: 60vh;
        }

        .table-enhanced {
            font-size: 0.8rem;
        }

        .chart-footer .col-4 {
            font-size: 0.7rem;
        }
    }

    /* Loading overlay */
    .chart-loading {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .loading-spinner {
        width: 3rem;
        height: 3rem;
        border: 0.3rem solid rgba(40, 167, 69, 0.3);
        border-top: 0.3rem solid #28a745;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .chart-scroll-container {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background: #f8f9fa;
    }

    .chart-scroll-container::-webkit-scrollbar {
        height: 8px;
    }

    .chart-scroll-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .chart-scroll-container::-webkit-scrollbar-thumb {
        background: #28a745;
        border-radius: 4px;
    }

    .chart-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #20c997;
    }

    /* Estilos para el contenedor del gráfico con scroll optimizado */
    .chart-container-scroll {
        max-height: 800px;
        /* Altura controlada para activar scroll cuando sea necesario */
        overflow-y: auto;
        overflow-x: hidden;
        scroll-behavior: smooth;
        border-radius: 8px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .chart-container-scroll::-webkit-scrollbar {
        width: 12px;
    }

    .chart-container-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 6px;
    }

    .chart-container-scroll::-webkit-scrollbar-thumb {
        background: #28a745;
        border-radius: 6px;
    }

    .chart-container-scroll::-webkit-scrollbar-thumb:hover {
        background: #20c997;
    }

    .table-responsive::-webkit-scrollbar {
        width: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #667eea;
        border-radius: 4px;
    }

    .chart-relation-indicator {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 13px;
        color: #495057;
        border: 2px solid #28a745;
        z-index: 10;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }

    .chart-relation-indicator:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        border-color: #20c997;
    }

    .separation-info {
        position: absolute;
        bottom: 10px;
        left: 15px;
        background: rgba(40, 167, 69, 0.1);
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 11px;
        color: #28a745;
        border: 1px solid rgba(40, 167, 69, 0.3);
        z-index: 10;
        backdrop-filter: blur(3px);
        transition: all 0.3s ease;
    }

    .separation-info:hover {
        background: rgba(40, 167, 69, 0.15);
        transform: translateY(-1px);
    }

    @media print {
        .card {
            box-shadow: none !important;
            border: 1px solid #dee2e6 !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar que jQuery esté cargado
        if (typeof $ === 'undefined') {
            console.error('jQuery no está cargado');
            return;
        }

        let productosVentasChart = null;
        let productosLineChart = null;

        // Datos iniciales del backend
        let productosData = @json($data['productos'] ?? []);

        // Prefijar rango de fechas por defecto: primer día del mes actual hasta hoy si no hay filtros aplicados
        const today = new Date();
        const primerDiaMes = new Date(today.getFullYear(), today.getMonth(), 1);
        const formatDate = (d) => d.toISOString().slice(0,10);
        const $fechaInicio = $('#fecha_inicio_producto');
        const $fechaFin = $('#fecha_fin_producto');
        if ($fechaInicio.length && !$fechaInicio.val()) {
            $fechaInicio.val(formatDate(primerDiaMes));
        }
        if ($fechaFin.length && !$fechaFin.val()) {
            $fechaFin.val(formatDate(today));
        }

        // Actualizar indicador inicial
        actualizarIndicadorRango();

        // Inicializar gráficos al cargar la página
        if (productosData && productosData.labels && productosData.labels.length > 0) {
            crearGraficosProductos(productosData);
        }

        // Event listeners para los botones
        $(document).on('click', '#filtrar_producto', function(e) {
            e.preventDefault();
            aplicarFiltrosProductos();
        });

        $(document).on('click', '#limpiar_producto', function(e) {
            e.preventDefault();
            limpiarFiltrosProductos();
        });

        // Función para aplicar filtros
        function aplicarFiltrosProductos() {
            const fechaInicio = $('#fecha_inicio_producto').val();
            const fechaFin = $('#fecha_fin_producto').val();

            console.log('Aplicando filtros:', {
                fechaInicio: fechaInicio || 'sin filtro',
                fechaFin: fechaFin || 'sin filtro'
            });

            // Mostrar loading
            $('#filtrar_producto').prop('disabled', true).html(
                '<i class="fas fa-spinner fa-spin"></i> Cargando...');

            // Petición AJAX al backend
            $.ajax({
                url: '{{ route('api.reportes.ventas') }}',
                method: 'GET',
                data: {
                    fecha_inicio_producto: fechaInicio || '',
                    fecha_fin_producto: fechaFin || ''
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Respuesta del servidor:', response);

                    try {
                        if (response && response.productos) {
                            // Verificar si hay datos de productos
                            const tieneDatosProductos = response.productos.labels && response
                                .productos.labels.length > 0;

                            if (tieneDatosProductos) {
                                console.log(
                                    `✅ Datos cargados exitosamente: ${response.productos.labels.length} productos, Total ventas: S/ ${response.productos.ventas.reduce((a, b) => a + b, 0).toLocaleString()}`
                                    );

                                // Actualizar datos
                                productosData = response.productos;

                                // Actualizar estadísticas del header
                                actualizarEstadisticasHeader(response.productos);

                                // Actualizar tabla
                                actualizarTablaProductos(response.productos);

                                // Actualizar gráficos
                                try {
                                    if (productosVentasChart) {
                                        productosVentasChart.destroy();
                                    }
                                    if (productosLineChart) {
                                        productosLineChart.destroy();
                                    }
                                    crearGraficosProductos(response.productos);
                                } catch (chartError) {
                                    console.error('Error al crear gráficos:', chartError);
                                    alert(
                                        'Los datos se cargaron correctamente, pero hubo un error al crear los gráficos. La tabla muestra la información.');
                                }
                            } else {
                                console.warn(
                                    '⚠️ No hay datos de productos para los filtros aplicados');
                                // Mostrar mensaje específico para filtros sin resultados
                                mostrarMensajeFiltrosSinResultados();
                            }
                        } else {
                            console.warn('Respuesta sin datos de productos:', response);
                            // Mostrar mensaje de no datos disponibles
                            mostrarMensajeNoDatos();
                        }
                    } catch (error) {
                        console.error('Error procesando respuesta:', error);
                        alert(
                            'Los datos se cargaron, pero hubo un error al procesarlos. Revisa la consola para más detalles.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la petición productos:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error
                    });

                    // Mostrar mensaje de error más específico
                    let mensajeError = 'Error al cargar los datos.';
                    if (xhr.status === 404) {
                        mensajeError =
                            'La ruta de la API no fue encontrada. Verifique la configuración.';
                    } else if (xhr.status === 500) {
                        mensajeError = 'Error interno del servidor. Contacte al administrador.';
                    } else if (xhr.status === 0) {
                        mensajeError =
                            'No se pudo conectar al servidor. Verifique su conexión a internet.';
                    }

                    alert(mensajeError + ' Intente nuevamente.');
                    mostrarMensajeNoDatos();
                },
                complete: function(xhr, status) {
                    console.log('Petición completada, status:', status);
                    // Asegurar que el botón se re-habilite siempre
                    $('#filtrar_producto').prop('disabled', false).html(
                        '<i class="fas fa-search me-2"></i> Buscar Datos');
                }
            });
        }

        // Función para limpiar filtros (restaurar rango por defecto del mes actual)
        function limpiarFiltrosProductos() {
            const today = new Date();
            const primerDiaMes = new Date(today.getFullYear(), today.getMonth(), 1);
            $fechaInicio.val(formatDate(primerDiaMes));
            $fechaFin.val(formatDate(today));
            // Actualizar indicador inmediatamente
            actualizarIndicadorRango();
            aplicarFiltrosProductos();
        }

        // Función para actualizar estadísticas del header
        function actualizarEstadisticasHeader(data) {
            const totalProductos = data.labels ? data.labels.length : 0;
            const totalVentas = data.ventas ? data.ventas.reduce((a, b) => a + b, 0) : 0;
            const totalUnidades = data.unidades ? data.unidades.reduce((a, b) => a + b, 0) : 0;
            const precioPromedio = totalUnidades > 0 ? totalVentas / totalUnidades : 0;

            $('#header_total_productos').text(totalProductos);
            $('#header_total_ventas').text('S/ ' + number_format(totalVentas, 0));
            $('#stat_total_productos').text(totalProductos);
            $('#stat_total_unidades').text(number_format(totalUnidades));
            $('#stat_total_ingresos').text('S/ ' + number_format(totalVentas, 0));
            $('#stat_precio_promedio').text('S/ ' + number_format(precioPromedio, 2));

            // Actualizar indicador de rango de fechas
            actualizarIndicadorRango();
        }

        // Función para actualizar el indicador de rango de fechas
        function actualizarIndicadorRango() {
            const fechaInicio = $('#fecha_inicio_producto').val();
            const fechaFin = $('#fecha_fin_producto').val();
            const today = new Date();
            const primerDiaMes = new Date(today.getFullYear(), today.getMonth(), 1);
            const formatDate = (d) => d.toISOString().slice(0,10);

            let indicadorHtml = '';
            let esRangoPorDefecto = false;

            // Verificar si es el rango por defecto del mes actual
            if (fechaInicio === formatDate(primerDiaMes) && fechaFin === formatDate(today)) {
                esRangoPorDefecto = true;
                indicadorHtml = `
                    <small class="badge bg-light text-dark px-3 py-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Datos por defecto: <strong>${formatDate(primerDiaMes).split('-').reverse().join('/')} - ${formatDate(today).split('-').reverse().join('/')}</strong>
                        <span class="text-muted">(Mes actual)</span>
                    </small>
                `;
            } else if (fechaInicio && fechaFin) {
                // Rango personalizado
                indicadorHtml = `
                    <small class="badge bg-info text-white px-3 py-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Rango personalizado: <strong>${fechaInicio.split('-').reverse().join('/')} - ${fechaFin.split('-').reverse().join('/')}</strong>
                    </small>
                `;
            } else if (fechaInicio) {
                // Solo fecha inicio
                indicadorHtml = `
                    <small class="badge bg-info text-white px-3 py-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Desde: <strong>${fechaInicio.split('-').reverse().join('/')}</strong>
                    </small>
                `;
            } else if (fechaFin) {
                // Solo fecha fin
                indicadorHtml = `
                    <small class="badge bg-info text-white px-3 py-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        Hasta: <strong>${fechaFin.split('-').reverse().join('/')}</strong>
                    </small>
                `;
            } else {
                // Sin filtros (todos los datos)
                indicadorHtml = `
                    <small class="badge bg-warning text-dark px-3 py-1">
                        <i class="fas fa-calendar-alt me-1"></i>
                        <strong>Todos los datos históricos</strong>
                    </small>
                `;
            }

            // Actualizar el indicador en el DOM
            const indicadorContainer = $('.mt-2');
            if (indicadorContainer.length) {
                indicadorContainer.html(indicadorHtml);
            }
        }

        // Función para mostrar mensaje cuando no hay datos
        function mostrarMensajeNoDatos() {
            // Actualizar estadísticas a cero
            $('#header_total_productos').text('0');
            $('#header_total_ventas').text('S/ 0');
            $('#stat_total_productos').text('0');
            $('#stat_total_unidades').text('0');
            $('#stat_total_ingresos').text('S/ 0');
            $('#stat_precio_promedio').text('S/ 0.00');

            // Limpiar tabla
            $('#tabla_productos').html(
                '<tr><td colspan="6" class="text-center py-5"><div class="text-muted"><i class="fas fa-inbox fa-3x mb-3 opacity-25"></i><h5>No hay datos disponibles</h5><p>Los filtros aplicados no devolvieron resultados. Intente con diferentes fechas.</p></div></td></tr>'
                );

            // Limpiar gráficos
            if (productosVentasChart) {
                productosVentasChart.destroy();
            }
            if (productosLineChart) {
                productosLineChart.destroy();
            }

            // Crear gráficos vacíos
            crearGraficoVentasVacio();
            crearGraficoLineVacio();
        }

        // Función para mostrar mensaje cuando los filtros no devuelven resultados
        function mostrarMensajeFiltrosSinResultados() {
            const fechaInicio = $('#fecha_inicio_producto').val();
            const fechaFin = $('#fecha_fin_producto').val();

            let mensajeFecha = '';
            if (fechaInicio && fechaFin) {
                mensajeFecha = ` para el período del ${fechaInicio} al ${fechaFin}`;
            } else if (fechaInicio) {
                mensajeFecha = ` desde ${fechaInicio}`;
            } else if (fechaFin) {
                mensajeFecha = ` hasta ${fechaFin}`;
            }

            // Actualizar estadísticas a cero
            $('#header_total_productos').text('0');
            $('#header_total_ventas').text('S/ 0');
            $('#stat_total_productos').text('0');
            $('#stat_total_unidades').text('0');
            $('#stat_total_ingresos').text('S/ 0');
            $('#stat_precio_promedio').text('S/ 0.00');

            // Mostrar mensaje específico en la tabla
            $('#tabla_productos').html(
                `<tr><td colspan="6" class="text-center py-5"><div class="text-muted"><i class="fas fa-search fa-3x mb-3 opacity-25"></i><h5>No se encontraron productos</h5><p>No hay datos de ventas${mensajeFecha}.<br>Intente con un rango de fechas diferente o elimine los filtros.</p><button class="btn btn-outline-primary mt-3" onclick="limpiarFiltrosProductos()"><i class="fas fa-refresh me-2"></i>Limpiar Filtros</button></div></td></tr>`
                );

            // Limpiar gráficos
            if (productosVentasChart) {
                productosVentasChart.destroy();
            }
            if (productosLineChart) {
                productosLineChart.destroy();
            }

            // Crear gráficos vacíos
            crearGraficoVentasVacio();
            crearGraficoLineVacio();
        }

        // Función para crear los gráficos de productos (ventas horizontal y circular)
        function crearGraficosProductos(data) {
            try {
                // Verificar que los datos sean válidos
                if (!data || !data.labels || data.labels.length === 0) {
                    console.warn('No hay datos para crear gráficos, creando gráficos vacíos');
                    crearGraficoVentasVacio();
                    crearGraficoLineVacio();
                    return;
                }

                // Obtener datos y ordenar por ventas descendente
                let labels = data.labels || [];
                let ventas = data.ventas || [];
                let unidades = data.unidades || [];

                if (labels.length === 0) {
                    console.warn('Labels vacíos, creando gráficos vacíos');
                    crearGraficoVentasVacio();
                    crearGraficoLineVacio();
                    return;
                }

                console.log(`Procesando ${labels.length} productos para gráficos`);

                // Crear array combinado para ordenar
                let productos = labels.map((label, index) => ({
                    nombre: label,
                    ventas: ventas[index] || 0,
                    unidades: unidades[index] || 0
                }));

                // Ordenar por ventas descendente
                productos.sort((a, b) => b.ventas - a.ventas);

                // Extraer datos ordenados
                const labelsOrdenados = productos.map(p => p.nombre);
                const ventasOrdenadas = productos.map(p => p.ventas);
                const unidadesOrdenadas = productos.map(p => p.unidades);

                // Calcular altura dinámica del canvas para que CADA producto tenga su espacio definido
                const numProductos = labelsOrdenados.length;
                const alturaPorProducto = 45; // Altura fija por producto para consistencia visual
                const alturaCalculada = Math.max(600, numProductos * alturaPorProducto +
                150); // Altura proporcional

                console.log(
                    `Creando gráfico de ventas con ${numProductos} productos, altura: ${alturaCalculada}px`);

                // Crear gráfica de ventas horizontal
                crearGraficoVentas(labelsOrdenados, ventasOrdenadas, alturaCalculada, numProductos);

                // Crear gráfica lineal de distribución acumulada
                crearGraficoLine(productos);

            } catch (error) {
                console.error('Error en crearGraficosProductos:', error);
                // Crear gráficos vacíos como fallback
                try {
                    crearGraficoVentasVacio();
                    crearGraficoLineVacio();
                } catch (fallbackError) {
                    console.error('Error creando gráficos vacíos:', fallbackError);
                }
            }
        }

        // Función para crear gráfico vacío de ventas
        function crearGraficoVentasVacio() {
            const ctx = document.getElementById('productosVentasChart');
            if (!ctx) return;

            productosVentasChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Sin datos'],
                    datasets: [{
                        label: 'Ventas por Producto (S/)',
                        data: [0],
                        backgroundColor: 'rgba(108, 117, 125, 0.3)',
                        borderColor: 'rgba(108, 117, 125, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'No hay datos disponibles'
                        }
                    }
                }
            });
        }

        // Función para crear gráfico lineal vacío
        function crearGraficoLineVacio() {
            const ctx = document.getElementById('productosLineChart');
            if (!ctx) return;

            productosLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sin datos'],
                    datasets: [{
                        label: 'Distribución Acumulada (%)',
                        data: [0],
                        borderColor: 'rgba(23, 162, 184, 1)',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'No hay datos disponibles'
                        }
                    }
                }
            });
        }

        // Función para crear gráfico de ventas
        function crearGraficoVentas(labels, ventas, alturaCalculada, numProductos) {
            try {
                const ctx = document.getElementById('productosVentasChart');
                if (!ctx) {
                    console.error('Canvas productosVentasChart no encontrado');
                    return;
                }

                // Mostrar loading
                mostrarLoading();

                // Configuración dinámica basada en cantidad de productos
                const configuracion = calcularConfiguracionOptima(numProductos);

                // Ajustar altura del canvas dinámicamente
                ctx.style.height = configuracion.altura + 'px';
                ctx.height = configuracion.altura;

                // Configurar contenedor
                const container = ctx.closest('.chart-container-enhanced');
                if (container && numProductos > 20) {
                    container.style.height = '70vh';
                    container.style.overflowY = 'auto';
                }

                // Crear datasets con colores dinámicos
                const datasets = [{
                    label: 'Ventas por Producto (S/)',
                    data: ventas,
                    backgroundColor: ventas.map((venta, index) => {
                        // Gradiente de colores más sofisticado
                        if (index === 0) return 'rgba(255, 193, 7, 0.8)'; // Oro para #1
                        if (index === 1) return 'rgba(108, 117, 125, 0.8)'; // Plata para #2
                        if (index === 2) return 'rgba(205, 164, 90, 0.8)'; // Bronce para #3
                        if (index < 10)
                    return `rgba(40, 167, 69, ${0.9 - index * 0.08})`; // Verde degradado top 10
                        if (index < 50)
                        return `rgba(23, 162, 184, ${0.7 - (index - 10) * 0.01})`; // Azul para siguientes
                        return `rgba(108, 117, 125, ${Math.max(0.3, 0.6 - (index - 50) * 0.005)})`; // Gris para resto
                    }),
                    borderColor: ventas.map((venta, index) => {
                        if (index === 0) return 'rgba(255, 193, 7, 1)';
                        if (index === 1) return 'rgba(108, 117, 125, 1)';
                        if (index === 2) return 'rgba(205, 164, 90, 1)';
                        if (index < 10) return 'rgba(40, 167, 69, 1)';
                        if (index < 50) return 'rgba(23, 162, 184, 1)';
                        return 'rgba(108, 117, 125, 1)';
                    }),
                    borderWidth: configuracion.borderWidth,
                    borderRadius: configuracion.borderRadius,
                    borderSkipped: false,
                    barThickness: configuracion.barThickness,
                    maxBarThickness: configuracion.maxBarThickness,
                    categoryPercentage: configuracion.categoryPercentage,
                    barPercentage: configuracion.barPercentage
                }];

                // Crear gráfico con configuración optimizada
                productosVentasChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        layout: {
                            padding: {
                                left: configuracion.paddingLeft,
                                right: 30,
                                top: 20,
                                bottom: 20
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return formatearMoneda(value);
                                    },
                                    font: {
                                        size: configuracion.fontSizeX,
                                        family: 'Segoe UI'
                                    },
                                    maxTicksLimit: 8,
                                    color: '#495057'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(0,0,0,0.05)',
                                    lineWidth: 1
                                },
                                title: {
                                    display: numProductos > 50,
                                    text: 'Ventas (S/)',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    },
                                    color: '#495057'
                                }
                            },
                            y: {
                                ticks: {
                                    font: {
                                        size: configuracion.fontSizeY,
                                        weight: '600',
                                        family: 'Segoe UI'
                                    },
                                    maxRotation: 0,
                                    callback: function(value, index) {
                                        const label = this.getLabelForValue(value);
                                        const maxChars = configuracion.maxChars;

                                        // Agregar ranking al label
                                        const ranking = `#${index + 1}`;
                                        let displayLabel = label;

                                        if (label.length > maxChars) {
                                            displayLabel = label.substring(0, maxChars - 3) + '...';
                                        }

                                        return `${ranking} ${displayLabel}`;
                                    },
                                    padding: configuracion.paddingY,
                                    color: '#2c3e50'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(0,0,0,0.03)',
                                    lineWidth: 0.5,
                                    drawBorder: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(33, 37, 41, 0.95)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                borderColor: function(context) {
                                    const index = context.tooltip.dataPoints[0].dataIndex;
                                    if (index === 0) return 'rgba(255, 193, 7, 1)';
                                    if (index === 1) return 'rgba(108, 117, 125, 1)';
                                    if (index === 2) return 'rgba(205, 164, 90, 1)';
                                    return 'rgba(40, 167, 69, 1)';
                                },
                                borderWidth: 2,
                                cornerRadius: 12,
                                displayColors: true,
                                titleFont: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                bodyFont: {
                                    size: 13
                                },
                                padding: 15,
                                callbacks: {
                                    title: function(context) {
                                        const ranking = context[0].dataIndex + 1;
                                        const icons = ['🏆', '🥈', '🥉'];
                                        const icon = icons[ranking - 1] || '📊';
                                        return `${icon} #${ranking} - ${context[0].label.replace(/^#\d+\s/, '')}`;
                                    },
                                    label: function(context) {
                                        const value = context.parsed.x;
                                        const total = context.dataset.data.reduce((a, b) => a + b,
                                            0);
                                        const percentage = total > 0 ? ((value / total) * 100)
                                            .toFixed(1) : 0;
                                        const ranking = context.dataIndex + 1;

                                        return [
                                            `💰 Ventas: ${formatearMoneda(value)}`,
                                            `📊 Participación: ${percentage}% del total`,
                                            `🏅 Posición: #${ranking} de ${labels.length}`
                                        ];
                                    }
                                }
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'nearest',
                            axis: 'y'
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: false,
                            axis: 'y',
                            animationDuration: 300
                        },
                        animation: {
                            duration: numProductos > 100 ? 0 : 1500,
                            easing: 'easeOutQuart',
                            onComplete: function() {
                                ocultarLoading();
                                actualizarContadores(labels.length, ventas.reduce((a, b) => a + b,
                                    0));
                            }
                        },
                        onHover: function(event, elements) {
                            event.native.target.style.cursor = elements.length > 0 ? 'pointer' :
                                'default';
                        }
                    }
                });

                console.log(
                    `Gráfico creado exitosamente: ${numProductos} productos, altura: ${configuracion.altura}px`
                    );

            } catch (error) {
                console.error('Error creando gráfico de ventas:', error);
                ocultarLoading();
                mostrarErrorGrafico();
            }
        }

        function calcularConfiguracionOptima(numProductos) {
    if (numProductos <= 10) {
        return {
            altura: 500,
            barThickness: 'flex',
            maxBarThickness: 50,
            categoryPercentage: 0.8,
            barPercentage: 0.7,
            fontSizeY: 14,
            fontSizeX: 12,
            maxChars: 50,
            paddingY: 15,
            paddingLeft: 200,
            borderWidth: 2,
            borderRadius: 8
        };
    } else if (numProductos <= 30) {
        return {
            altura: 800,
            barThickness: 'flex',
            maxBarThickness: 35,
            categoryPercentage: 0.9,
            barPercentage: 0.8,
            fontSizeY: 12,
            fontSizeX: 11,
            maxChars: 45,
            paddingY: 10,
            paddingLeft: 180,
            borderWidth: 2,
            borderRadius: 6
        };
    } else if (numProductos <= 100) {
        return {
            altura: Math.max(1200, numProductos * 25),
            barThickness: 'flex',
            maxBarThickness: 25,
            categoryPercentage: 0.95,
            barPercentage: 0.85,
            fontSizeY: 11,
            fontSizeX: 10,
            maxChars: 40,
            paddingY: 8,
            paddingLeft: 160,
            borderWidth: 1,
            borderRadius: 4
        };
    } else {
        return {
            altura: Math.max(1500, numProductos * 20),
            barThickness: 'flex',
            maxBarThickness: 20,
            categoryPercentage: 0.98,
            barPercentage: 0.9,
            fontSizeY: 10,
            fontSizeX: 9,
            maxChars: 35,
            paddingY: 6,
            paddingLeft: 140,
            borderWidth: 1,
            borderRadius: 3
        };
    }
}

// Funciones auxiliares
function formatearMoneda(value) {
    if (value >= 1000000) {
        return 'S/ ' + (value / 1000000).toFixed(1) + 'M';
    } else if (value >= 1000) {
        return 'S/ ' + (value / 1000).toFixed(1) + 'K';
    }
    return 'S/ ' + value.toLocaleString('es-PE');
}

function mostrarLoading() {
    const container = document.getElementById('chartContainer');
    if (container && !container.querySelector('.chart-loading')) {
        const loading = document.createElement('div');
        loading.className = 'chart-loading';
        loading.innerHTML = '<div class="loading-spinner"></div>';
        container.appendChild(loading);
    }
}

function ocultarLoading() {
    const loading = document.querySelector('.chart-loading');
    if (loading) {
        loading.remove();
    }
}

function mostrarErrorGrafico() {
    const ctx = document.getElementById('productosVentasChart');
    if (ctx) {
        const container = ctx.closest('.chart-container-enhanced');
        container.innerHTML = `
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="text-center text-muted">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h5>Error al cargar gráfico</h5>
                    <p>Intente recargar la página o ajustar los filtros</p>
                </div>
            </div>
        `;
    }
}

function actualizarContadores(productos, total) {
    document.getElementById('productosVisibles').textContent = productos.toLocaleString();
    document.getElementById('totalVisible').textContent = total.toLocaleString('es-PE');
}

// Event listeners para controles adicionales
document.addEventListener('DOMContentLoaded', function() {
    // Control de vista compacta
    const vistaCompacta = document.getElementById('vistaCompacta');
    if (vistaCompacta) {
        vistaCompacta.addEventListener('change', function() {
            if (productosVentasChart) {
                const isCompact = this.checked;
                productosVentasChart.options.scales.y.ticks.font.size = isCompact ? 9 : 12;
                productosVentasChart.options.layout.padding.left = isCompact ? 120 : 200;
                productosVentasChart.update();
            }
        });
    }

    // Control de cantidad a mostrar
    const cantidadMostrar = document.getElementById('cantidadMostrar');
    if (cantidadMostrar) {
        cantidadMostrar.addEventListener('change', function() {
            const cantidad = this.value;
            if (cantidad !== 'all' && productosData) {
                const limite = parseInt(cantidad);
                const datosLimitados = {
                    labels: productosData.labels.slice(0, limite),
                    ventas: productosData.ventas.slice(0, limite),
                    unidades: productosData.unidades.slice(0, limite)
                };
                
                if (productosVentasChart) {
                    productosVentasChart.destroy();
                }
                
                crearGraficosProductos(datosLimitados);
                actualizarTablaProductos(datosLimitados);
            } else if (cantidad === 'all' && productosData) {
                if (productosVentasChart) {
                    productosVentasChart.destroy();
                }
                crearGraficosProductos(productosData);
                actualizarTablaProductos(productosData);
            }
        });
    }

    // Botones de navegación
    const irArriba = document.getElementById('irArriba');
    const irAbajo = document.getElementById('irAbajo');
    
    if (irArriba) {
        irArriba.addEventListener('click', function() {
            const container = document.querySelector('.chart-container-enhanced');
            if (container) {
                container.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }

    if (irAbajo) {
        irAbajo.addEventListener('click', function() {
            const container = document.querySelector('.chart-container-enhanced');
            if (container) {
                container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
            }
        });
    }
});



        // Función para crear gráfico lineal de distribución acumulada (Pareto)
        function crearGraficoLine(productos) {
            try {
                const ctx = document.getElementById('productosLineChart');
                if (!ctx) {
                    console.error('Canvas productosLineChart no encontrado');
                    return;
                }

                // Calcular total de ventas
                const totalVentas = productos.reduce((sum, p) => sum + p.ventas, 0);

                if (totalVentas === 0) {
                    console.warn('Total de ventas es 0, creando gráfico vacío');
                    crearGraficoLineVacio();
                    return;
                }

                // Calcular porcentajes acumulados
                let acumulado = 0;
                const porcentajesAcumulados = [];
                const labels = [];

                productos.forEach((producto, index) => {
                    acumulado += producto.ventas;
                    const porcentaje = (acumulado / totalVentas) * 100;
                    porcentajesAcumulados.push(porcentaje);
                    labels.push(`Top ${index + 1}`);
                });

                // Encontrar el punto donde se alcanza el 80% (regla 80/20)
                const punto80 = porcentajesAcumulados.findIndex(p => p >= 80) + 1;

                productosLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Porcentaje Acumulado de Ventas',
                            data: porcentajesAcumulados,
                            borderColor: 'rgba(23, 162, 184, 1)',
                            backgroundColor: 'rgba(23, 162, 184, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            pointBackgroundColor: 'rgba(23, 162, 184, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Número de Productos (ordenados por ventas)'
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(0,0,0,0.1)'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                max: 100,
                                title: {
                                    display: true,
                                    text: 'Porcentaje Acumulado (%)'
                                },
                                ticks: {
                                    callback: function(value) {
                                        return value + '%';
                                    }
                                },
                                grid: {
                                    display: true,
                                    color: 'rgba(0,0,0,0.1)'
                                }
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: `Análisis Pareto - Distribución de Ventas (${productos.length} productos)`,
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                },
                                padding: {
                                    top: 10,
                                    bottom: 20
                                }
                            },
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                titleColor: 'white',
                                bodyColor: 'white',
                                borderColor: 'rgba(23, 162, 184, 1)',
                                borderWidth: 1,
                                cornerRadius: 6,
                                displayColors: true,
                                callbacks: {
                                    title: function(context) {
                                        const index = context[0].dataIndex;
                                        return `Top ${index + 1} productos`;
                                    },
                                    label: function(context) {
                                        const value = context.parsed.y;
                                        const index = context.dataIndex;
                                        const productosEnTop = index + 1;
                                        const porcentajeProductos = (productosEnTop / productos
                                            .length) * 100;
                                        return [
                                            `Ventas acumuladas: ${value.toFixed(1)}%`,
                                            `Representa el ${porcentajeProductos.toFixed(1)}% de productos`,
                                            `Genera el ${value.toFixed(1)}% de ingresos`
                                        ];
                                    }
                                }
                            },
                            annotation: {
                                annotations: {
                                    regla80: {
                                        type: 'line',
                                        xMin: 0,
                                        xMax: productos.length - 1,
                                        yMin: 80,
                                        yMax: 80,
                                        borderColor: 'rgba(255, 99, 132, 0.8)',
                                        borderWidth: 2,
                                        borderDash: [5, 5],
                                        label: {
                                            enabled: true,
                                            content: '80% de ventas',
                                            position: 'end',
                                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                            color: 'white',
                                            font: {
                                                size: 10
                                            }
                                        }
                                    },
                                    regla20: punto80 > 0 ? {
                                        type: 'line',
                                        xMin: punto80 - 1,
                                        xMax: punto80 - 1,
                                        yMin: 0,
                                        yMax: 100,
                                        borderColor: 'rgba(255, 99, 132, 0.8)',
                                        borderWidth: 2,
                                        borderDash: [5, 5],
                                        label: {
                                            enabled: true,
                                            content: `${punto80} productos`,
                                            position: 'top',
                                            backgroundColor: 'rgba(255, 99, 132, 0.8)',
                                            color: 'white',
                                            font: {
                                                size: 10
                                            }
                                        }
                                    } : null
                                }
                            }
                        },
                        animation: {
                            duration: 1500,
                            easing: 'easeOutQuart'
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        }
                    }
                });

                console.log('Gráfico lineal creado exitosamente');
            } catch (error) {
                console.error('Error creando gráfico lineal:', error);
                // Intentar crear gráfico vacío como fallback
                try {
                    crearGraficoLineVacio();
                } catch (fallbackError) {
                    console.error('Error creando gráfico lineal vacío:', fallbackError);
                }
            }
        }

        // Función para actualizar la tabla de productos
        function actualizarTablaProductos(data) {
            let html = '';

            if (data.labels && data.labels.length > 0) {
                // Calcular total de ventas para porcentajes
                const totalVentas = data.ventas ? data.ventas.reduce((a, b) => a + b, 0) : 0;

                // Crear array combinado para ordenar por ventas descendente
                let productos = data.labels.map(function(producto, index) {
                    return {
                        nombre: producto,
                        unidades: data.unidades[index] || 0,
                        ventas: data.ventas[index] || 0
                    };
                });

                // Ordenar por ventas descendente
                productos.sort((a, b) => b.ventas - a.ventas);

                // Generar HTML de la tabla
                productos.forEach(function(producto, index) {
                    const precioPromedio = producto.unidades > 0 ? (producto.ventas / producto
                        .unidades) : 0;
                    const porcentaje = totalVentas > 0 ? (producto.ventas / totalVentas) * 100 : 0;

                    html += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>
                            <strong>${producto.nombre}</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary">${producto.unidades.toLocaleString()}</span>
                        </td>
                        <td class="text-end">
                            <strong class="text-success">${producto.ventas.toLocaleString('es-PE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</strong>
                        </td>
                        <td class="text-end">
                            ${precioPromedio.toLocaleString('es-PE', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                        </td>
                        <td class="text-center">
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: ${porcentaje}%" aria-valuenow="${porcentaje}" aria-valuemin="0" aria-valuemax="100">
                                    ${porcentaje.toFixed(1)}%
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
                });
            } else {
                html = '<tr><td colspan="6" class="text-center">No hay datos disponibles</td></tr>';
            }

            $('#tabla_productos').html(html);

            // Actualizar totales
            const totalUnidades = data.unidades ? data.unidades.reduce((a, b) => a + b, 0) : 0;
            const totalVentas = data.ventas ? data.ventas.reduce((a, b) => a + b, 0) : 0;
            const promedioGeneral = totalUnidades > 0 ? (totalVentas / totalUnidades) : 0;

            $('#total_unidades').text(totalUnidades.toLocaleString());
            $('#total_ventas').text('S/ ' + totalVentas.toLocaleString('es-PE', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            $('#promedio_precio').text('S/ ' + promedioGeneral.toLocaleString('es-PE', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
        }

        // Función adicional para exportar tabla
        window.exportarTabla = function() {
            // Lógica para exportar tabla
            alert('Función de exportación lista para implementar');
        }

        // Función para compartir reporte
        window.compartirReporte = function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Reporte de Productos',
                    text: 'Análisis detallado de ventas por producto',
                    url: window.location.href
                });
            } else {
                // Fallback - copiar link
                navigator.clipboard.writeText(window.location.href);
                alert('Link copiado al portapapeles');
            }
        }

        // Función auxiliar para formatear números
        function number_format(number, decimals = 0) {
            return new Intl.NumberFormat('es-PE', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }).format(number);
        }
    });
</script>
