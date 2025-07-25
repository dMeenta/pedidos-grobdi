<!-- Modal (Bootstrap 4) -->
<div class="modal fade" id="crearUtilModal" tabindex="-1" role="dialog" aria-labelledby="crearUtilLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h1 class="modal-title" id="crearUtilLabel"><i class="fas fa-paperclip"></i> Crear Útiles</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
        <form action="{{ route('util.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" required>
          </div>
          <div class="form-group">
            <label for="precio">Precio Unitario</label>
            <input type="number" name="precio" class="form-control" id="precio" min="0" step="0.0001" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn_crear"><i class="fa-solid fa-floppy-disk"></i>Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
