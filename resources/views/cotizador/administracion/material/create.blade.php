<!-- Modal -->
<div class="modal fade" id="crearMaterialModal" tabindex="-1" role="dialog" aria-labelledby="crearMaterialLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="crearMaterialLabel">
          <i class="fas fa-cube"></i> Crear Material
        </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('material.store') }}" method="POST">
        @csrf
        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" class="form-control" id="precio" min="0" step="0.0001" required>
          </div>
          <div class="form-group">
            <label>Unidad de Medida</label>
            <input type="text" class="form-control input_moderno" placeholder="und" readonly>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn_crear">
            <i class="fa fa-floppy-disk"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
