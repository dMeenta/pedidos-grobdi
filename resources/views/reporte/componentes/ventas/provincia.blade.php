<!-- Tab Provincia -->
<div class="tab-pane fade" id="provincia" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-map-marker-alt text-danger"></i> Reporte por Provincia
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-3">
            <label for="fecha_inicio_provincia" class="form-label">Fecha Inicio</label>
            <input type="text" class="form-control" id="fecha_inicio_provincia" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3">
            <label for="fecha_fin_provincia" class="form-label">Fecha Fin</label>
            <input type="text" class="form-control" id="fecha_fin_provincia" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" id="filtrar_provincia"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-secondary" id="limpiar_provincia"><i class="fas fa-eraser"></i> Limpiar</button>
        </div>
    </div>

    <!-- Gráfico de Barras Principal -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar"></i> Ventas por Provincia
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="provinciaChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Pie y Tabla -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> Distribución de Ventas por Provincia
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="provinciaPieChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Estadísticas por Provincia
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Provincia</th>
                                <th>Ventas (S/)</th>
                                <th>%</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        <tbody id="tablaProvinciaBody">
                            <tr>
                                <td>Ica</td>
                                <td>2,500.00</td>
                                <td>45%</td>
                                <td>80</td>
                            </tr>
                            <tr>
                                <td>Arequipa</td>
                                <td>2,200.00</td>
                                <td>40%</td>
                                <td>75</td>
                            </tr>
                            <tr>
                                <td>Lima</td>
                                <td>800.00</td>
                                <td>15%</td>
                                <td>30</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th>Total</th>
                                <th>S/ 5,500.00</th>
                                <th><span class="badge bg-dark">100%</span></th>
                                <th>185</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Descargar Excel -->
    <div class="text-center mt-4">
        <button class="btn btn-success" id="descargar-excel-provincia">
            <i class="fas fa-download"></i> Descargar Detallado Excel
        </button>
    </div>
</div>