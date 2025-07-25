<!-- Modal -->
<div class="modal fade" id="crearInsumoModal" tabindex="-1" role="dialog" aria-labelledby="crearInsumoLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="crearInsumoLabel">
          <i class="fas fa-vial"></i> Crear Insumo
        </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('insumos.store') }}" method="POST">
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
            <label for="unidad_de_medida_id">Unidad de Medida</label>
            <select name="unidad_de_medida_id" class="form-control" id="unidad_de_medida_id" required>
              <option value="">Seleccione una unidad</option>
              @foreach($unidades as $id => $nombre_unidad_de_medida)
                <option value="{{ $id }}">{{ $nombre_unidad_de_medida }}</option>
              @endforeach
            </select>
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
