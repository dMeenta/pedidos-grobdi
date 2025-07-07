<!-- Modal -->
<div class="modal fade" id="crearMerchandiseModal" tabindex="-1" role="dialog" aria-labelledby="crearMerchandiseLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document"> <!-- Puedes cambiar modal-lg por modal-md o modal-sm -->
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="crearMerchandiseLabel">
          <i class="fa fa-box-open"></i> Crear Mercancía
        </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('merchandise.store') }}" method="POST">
        @csrf
        <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion"></textarea>
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" class="form-control" id="precio" min="1" step="0.0001" required>
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
