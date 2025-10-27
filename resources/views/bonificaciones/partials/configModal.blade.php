<div class="modal fade" id="configuracionModal" tabindex="-1" role="dialog" aria-labelledby="configuracionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="configuracionModalLabel">Crear nuevo rango de bonificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="configuracionRangoForm">
                    <div id="rangeFields" class="d-flex flex-column gap-3">
                        <div class="bonificaciones-range-group p-3 border rounded" data-index="0">
                            <div class="row g-3 align-items-end">
                                <div class="col-12 col-md-4">
                                    <label class="form-label small text-uppercase text-muted" data-label-for="inicio">Porcentaje inicial</label>
                                    <input type="number" class="form-control" min="0" max="100" step="1" data-field="inicio" placeholder="Ej. 80">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label small text-uppercase text-muted" data-label-for="fin">Porcentaje final</label>
                                    <input type="number" class="form-control" min="0" max="100" step="1" data-field="fin" placeholder="Ej. 89">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label small text-uppercase text-muted" data-label-for="comision">Comisión (%)</label>
                                    <input type="number" class="form-control" min="0" max="100" step="0.01" data-field="comision" placeholder="Ej. 1.5">
                                </div>
                                <div class="col-12 col-md-1 text-md-right">
                                    <button type="button" class="btn btn-link text-danger remove-range-row d-none">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addRangeRow">
                            <i class="fas fa-plus"></i> Agregar otro rango
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar rangos</button>
            </div>
        </div>
    </div>
</div>
