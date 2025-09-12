<!-- Tab Rutas -->
<div class="tab-pane fade show active" id="rutas" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-route text-primary"></i> Reporte de Rutas de Visitadoras
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-3">
            <label for="mes_rutas" class="form-label">Mes</label>
            <select class="form-control" id="mes_rutas">
                <option value="">Seleccionar mes</option>
                <option value="01">Enero</option>
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="zona_rutas" class="form-label">Zona</label>
            <select class="form-control" id="zona_rutas">
                <option value="">Seleccionar zona</option>
                <option value="norte">Norte</option>
                <option value="centro">Centro</option>
                <option value="sur">Sur</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="distrito_rutas" class="form-label">Distrito</label>
            <select class="form-control" id="distrito_rutas">
                <option value="">Seleccionar distrito</option>
                <option value="lima">Lima</option>
                <option value="jesus_maria">Jesús María</option>
                <option value="brena">Breña</option>
            </select>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" id="filtrar_rutas"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
    </div>

    <!-- Gráfica Principal: Asignados vs Visitados -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i> Asignados vs Visitados
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="asignadosVisitadosChart" width="600" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Leyenda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="legend-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="legend-color mr-2" style="width: 20px; height: 20px; background-color: #28a745; border-radius: 50%;"></div>
                            <div>
                                <strong>Asignados</strong><br>
                                <small>Total de visitas programadas</small>
                            </div>
                        </div>
                    </div>
                    <div class="legend-item mb-3">
                        <div class="d-flex align-items-center">
                            <div class="legend-color mr-2" style="width: 20px; height: 20px; background-color: #007bff; border-radius: 50%;"></div>
                            <div>
                                <strong>Visitados</strong><br>
                                <small>Visitas realizadas exitosamente</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="stats-summary">
                        <h6>Estadísticas Actuales</h6>
                        <p class="mb-1"><strong>Total Asignados:</strong> <span id="total-asignados">150</span></p>
                        <p class="mb-1"><strong>Total Visitados:</strong> <span id="total-visitados">120</span></p>
                        <p class="mb-1"><strong>% Completado:</strong> <span id="porcentaje-completado" class="text-success">80%</span></p>
                    </div>
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
                        <i class="fas fa-chart-bar"></i> Visitas por Día de la Semana
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="visitasSemanaChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line"></i> Tendencia Mensual
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="tendenciaMensualChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Detalles -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-table"></i> Detalles de Rutas por Visitadora
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Visitadora</th>
                                <th>Zona</th>
                                <th>Distrito</th>
                                <th>Asignados</th>
                                <th>Visitados</th>
                                <th>% Completado</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaRutasBody">
                            <tr>
                                <td>María González</td>
                                <td>Centro</td>
                                <td>Lima</td>
                                <td>25</td>
                                <td>22</td>
                                <td><span class="badge badge-success">88%</span></td>
                                <td><span class="badge badge-success">Excelente</span></td>
                            </tr>
                            <tr>
                                <td>Carmen Rodríguez</td>
                                <td>Norte</td>
                                <td>Breña</td>
                                <td>30</td>
                                <td>24</td>
                                <td><span class="badge badge-warning">80%</span></td>
                                <td><span class="badge badge-warning">Bueno</span></td>
                            </tr>
                            <tr>
                                <td>Ana López</td>
                                <td>Sur</td>
                                <td>Jesús María</td>
                                <td>20</td>
                                <td>18</td>
                                <td><span class="badge badge-success">90%</span></td>
                                <td><span class="badge badge-success">Excelente</span></td>
                            </tr>
                            <tr>
                                <td>Patricia Sánchez</td>
                                <td>Centro</td>
                                <td>Lima</td>
                                <td>28</td>
                                <td>21</td>
                                <td><span class="badge badge-warning">75%</span></td>
                                <td><span class="badge badge-warning">Regular</span></td>
                            </tr>
                            <tr>
                                <td>Rosa Martínez</td>
                                <td>Norte</td>
                                <td>Breña</td>
                                <td>22</td>
                                <td>19</td>
                                <td><span class="badge badge-success">86%</span></td>
                                <td><span class="badge badge-success">Excelente</span></td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th colspan="3">Total General</th>
                                <th>125</th>
                                <th>104</th>
                                <th><span class="badge bg-dark">83%</span></th>
                                <th><span class="badge bg-primary">Promedio</span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Descargar Excel -->
    <div class="text-center mt-4">
        <button class="btn btn-success" id="descargar-excel-rutas">
            <i class="fas fa-download"></i> Descargar Detallado Excel
        </button>
    </div>
</div>