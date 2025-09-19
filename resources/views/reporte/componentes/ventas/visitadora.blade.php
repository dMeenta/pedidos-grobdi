<!-- Tab Visitadora -->
<div class="tab-pane fade show active" id="visitadora" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-user-md text-info"></i> Reporte por Visitadora
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="text" class="form-control" id="fecha_inicio" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="text" class="form-control" id="fecha_fin" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3 d-flex align-items-end">
            <button class="btn btn-primary me-2" id="filtrar">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn btn-secondary" id="limpiar">
                <i class="fas fa-times"></i> Limpiar
            </button>
        </div>
    </div>

    <!-- Cards de resumen -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3 id="total-ventas">S/ 5,300</h3>
                    <p class="mb-0">Total Ventas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h3 id="total-visitas">160</h3>
                    <p class="mb-0">Total Visitas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h3 id="promedio-venta">S/ 33.13</h3>
                    <p class="mb-0">Promedio/Visita</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h3 id="mejor-visitadora">Norte</h3>
                    <p class="mb-0">Mejor Visitadora</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Barras -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar"></i> Ventas por Visitadora
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="ventasChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Pie y Tabla -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> Distribución de Ventas
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="ventasPieChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Estadísticas Detalladas
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Visitadora</th>
                                <th>Ventas (S/)</th>
                                <th>%</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        <tbody id="tablaVentasBody">
                            <tr>
                                <td>Visitadora Sur</td>
                                <td>S/ 1,500.00</td>
                                <td><span class="badge bg-primary">28.3%</span></td>
                                <td>45</td>
                            </tr>
                            <tr>
                                <td>Visitadora Norte</td>
                                <td>S/ 2,000.00</td>
                                <td><span class="badge bg-success">37.7%</span></td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>Visitadora Centro</td>
                                <td>S/ 1,800.00</td>
                                <td><span class="badge bg-warning">34.0%</span></td>
                                <td>55</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th>Total</th>
                                <th>S/ 5,300.00</th>
                                <th><span class="badge bg-dark">100%</span></th>
                                <th>160</th>
                            </tr>
                        </tfoot>
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
</div>