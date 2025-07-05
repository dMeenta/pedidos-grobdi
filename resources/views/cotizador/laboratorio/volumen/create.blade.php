<!-- Modal Bootstrap 4.6 -->
<div class="modal fade" id="crearVolumenModal" tabindex="-1" role="dialog" aria-labelledby="crearVolumenModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('volumen.store') }}" method="POST">
        @csrf
        <div class="modal-header" style="background-color:rgba(250, 97, 114, 0.93); color: white;">
          <h5 class="modal-title" id="crearVolumenModalLabel"><i class="fa-solid fa-fill-drip"></i> Crear Volumen</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="clasificacion_id">Clasificación</label>
            <select name="clasificacion_id" class="form-control" required>
              @foreach ($clasificaciones as $clasificacion)
                <option value="{{ $clasificacion->id }}">{{ $clasificacion->nombre_clasificacion }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="nombre">Volumen (ej. 100, 250)</label>
            <input type="number" name="nombre" min="1" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn_crear"><i class="fa-solid fa-floppy-disk"></i>
          Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
