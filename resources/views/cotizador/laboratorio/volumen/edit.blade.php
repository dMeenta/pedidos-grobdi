<!-- Modal de edición -->
<div class="modal fade" id="editarVolumenModal" tabindex="-1" role="dialog" aria-labelledby="editarVolumenModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editarVolumenForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header" style="background-color:rgb(254, 114, 131); color: white;">
          <h5 class="modal-title" id="editarVolumenModalLabel">
            <i class="fa fa-edit mr-1"></i> Editar Volumen
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="editar_clasificacion_id">Clasificación</label>
            <select name="clasificacion_id" id="editar_clasificacion_id" class="form-control" required>
              @foreach ($clasificaciones as $clasificacion)
                <option value="{{ $clasificacion->id }}">{{ $clasificacion->nombre_clasificacion }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="editar_nombre">Volumen</label>
            <input type="number" name="nombre" id="editar_nombre" class="form-control" min="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn_crear"><i class="fa-solid fa-pen-fancy"></i>
          Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function abrirModalEditar(volumen) {
    $('#editarVolumenForm').attr('action', `/volumen/${volumen.id}`);
    $('#editar_nombre').val(volumen.nombre);
    $('#editar_clasificacion_id').val(volumen.clasificacion_id);
    $('#editarVolumenModal').modal('show');
  }
</script>
