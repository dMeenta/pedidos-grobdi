<!-- Tab Doctor -->
<div class="tab-pane fade" id="doctor" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-user-md text-success"></i> Reporte por Doctor
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-4">
            <label for="buscador_doctor" class="form-label">Buscar Doctor</label>
            <input type="text" class="form-control" id="buscador_doctor" placeholder="Escriba el nombre del doctor">
        </div>
        <div class="col-md-3">
            <label for="anio_doctor" class="form-label">Año</label>
            <input type="text" class="form-control" id="anio_doctor" placeholder="Seleccionar año">
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" id="filtrar_doctor"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-secondary" id="limpiar_doctor"><i class="fas fa-eraser"></i> Limpiar</button>
        </div>
    </div>

    <!-- Nombre del Doctor Filtrado -->
    <div class="row mb-4" id="doctor-info">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h2 id="doctor-nombre">Dr. Juan Pérez</h2>
                    <p class="mb-0">Especialidad: Cardiología</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica de Ventas por Mes del Doctor -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line"></i> Ventas por Mes del Doctor
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="doctorChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas Complementarias del Doctor -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-bar"></i> Productos Más Vendidos
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="doctorProductosChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Detalles de Ventas
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Mes</th>
                                <th>Ventas (S/)</th>
                                <th>Visitas</th>
                                <th>Productos</th>
                            </tr>
                        </thead>
                        <tbody id="tablaDoctorBody">
                            <tr>
                                <td>Enero</td>
                                <td>2,500</td>
                                <td>5</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>Febrero</td>
                                <td>3,200</td>
                                <td>6</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>Marzo</td>
                                <td>2,800</td>
                                <td>4</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>Abril</td>
                                <td>3,500</td>
                                <td>7</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td>Mayo</td>
                                <td>4,100</td>
                                <td>8</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>Junio</td>
                                <td>3,800</td>
                                <td>6</td>
                                <td>16</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Descargar Excel -->
    <div class="text-center mt-4">
        <button class="btn btn-success" id="descargar-excel-doctor">
            <i class="fas fa-download"></i> Descargar Detallado Excel
        </button>
    </div>
</div>