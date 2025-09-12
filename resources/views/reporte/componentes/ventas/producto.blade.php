<!-- Tab Producto -->
<div class="tab-pane fade" id="producto" role="tabpanel">
    <h4 class="mb-4">
        <i class="fas fa-box text-success"></i> Reporte por Producto
    </h4>

    <!-- Filtros -->
    <div class="row mb-4 p-3 bg-light rounded">
        <div class="col-md-3">
            <label for="fecha_inicio_producto" class="form-label">Fecha Inicio</label>
            <input type="text" class="form-control" id="fecha_inicio_producto" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3">
            <label for="fecha_fin_producto" class="form-label">Fecha Fin</label>
            <input type="text" class="form-control" id="fecha_fin_producto" placeholder="Seleccionar fecha">
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-primary" id="filtrar_producto"><i class="fas fa-filter"></i> Filtrar</button>
        </div>
        <div class="col-md-3">
            <label>&nbsp;</label><br>
            <button class="btn btn-secondary" id="limpiar_producto"><i class="fas fa-eraser"></i> Limpiar</button>
        </div>
    </div>

    <!-- Gráfico de productos -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Ventas por Producto</h5>
                </div>
                <div class="card-body">
                    <canvas id="productosChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Detalle por Producto</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad Vendida</th>
                                <th>Ingresos (S/)</th>
                                <th>Precio Promedio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Vitaminas Prenatales</td>
                                <td>120</td>
                                <td>S/ 2,400.00</td>
                                <td>S/ 20.00</td>
                            </tr>
                            <tr>
                                <td>Suplementos de Hierro</td>
                                <td>95</td>
                                <td>S/ 1,425.00</td>
                                <td>S/ 15.00</td>
                            </tr>
                            <tr>
                                <td>Ácido Fólico</td>
                                <td>85</td>
                                <td>S/ 850.00</td>
                                <td>S/ 10.00</td>
                            </tr>
                            <tr>
                                <td>Calcio</td>
                                <td>65</td>
                                <td>S/ 975.00</td>
                                <td>S/ 15.00</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th>Total</th>
                                <th>365</th>
                                <th>S/ 5,650.00</th>
                                <th>S/ 15.48</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Descargar Excel -->
    <div class="text-center mt-4">
        <button class="btn btn-success" id="descargar-excel-producto">
            <i class="fas fa-download"></i> Descargar Detallado Excel
        </button>
    </div>
</div>