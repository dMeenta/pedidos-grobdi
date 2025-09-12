<!-- Tab Tipo Doctor -->
<div class="tab-pane fade show active" id="tipo-doctor" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-stethoscope text-info"></i> Reporte por Tipo de Doctor
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-3">
            <label for="anio_tipo_doctor" class="form-label">Año</label>
            <input type="text" class="form-control" id="anio_tipo_doctor" placeholder="Seleccionar año">
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" id="filtrar_tipo_doctor"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
    </div>

    <!-- Gráfica Principal por Mes -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar"></i> Tipos de Doctores por Mes
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="tipoDoctorChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas Complementarias -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> Distribución por Tipo
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="tipoDoctorPieChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Estadísticas por Tipo
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Tipo de Doctor</th>
                                <th>Total Doctores</th>
                                <th>%</th>
                                <th>Promedio Ventas</th>
                            </tr>
                        </thead>
                        <tbody id="tablaTipoDoctorBody">
                            <tr>
                                <td>Prescriptor</td>
                                <td>45</td>
                                <td>60%</td>
                                <td>S/ 2,500</td>
                            </tr>
                            <tr>
                                <td>Comprador</td>
                                <td>20</td>
                                <td>27%</td>
                                <td>S/ 1,800</td>
                            </tr>
                            <tr>
                                <td>En Progreso</td>
                                <td>10</td>
                                <td>13%</td>
                                <td>S/ 800</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th>Total</th>
                                <th>75</th>
                                <th><span class="badge bg-dark">100%</span></th>
                                <th>S/ 2,033</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Descargar Excel -->
    <div class="text-center mt-4">
        <button class="btn btn-success" id="descargar-excel-tipo-doctor">
            <i class="fas fa-download"></i> Descargar Detallado Excel
        </button>
    </div>
</div>