<!-- Modal para mostrar los detalles de la muestra -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Eliminación de item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="deleteForm">
                <div class="modal-body overflow-auto" style="max-height: 70vh;">
                    <textarea required style="resize: none;" name="delete_reason" id="delete_reason" class="form-control" rows="5" placeholder="Escriba su razón para eliminar este item..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal"><i class="fas fa-door-open mr-1"></i>Cancelar</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>