<div class="modal fade" id="crearTipoCambioModal" tabindex="-1" role="dialog" aria-labelledby="crearTipoCambioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 12px; background-color:rgb(255, 255, 255);">
      <form action="{{ route('tipo_cambio.store') }}" method="POST">
        @csrf
        <div class="modal-header" style="background-color:hsl(353, 100.00%, 69.60%); color: white;  border-top-left-radius: 12px; border-top-right-radius: 12px;">
          <h5 class="modal-title" id="crearTipoCambioLabel">Actualizar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="form-group">
            <label for="tipo_moneda_id">Moneda</label>
            <select name="tipo_moneda_id" id="tipo_moneda_id" class="form-control" required>
              <option value="">-- Selecciona una moneda --</option>
              @foreach ($monedas as $moneda)
                  <option value="{{ $moneda->id }}">{{ $moneda->nombre }} ({{ $moneda->codigo_iso }})</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="valor_cambio">Valor de cambio</label>
            <input type="number" min="1" step="0.0001" name="valor_cambio" id="valor_cambio" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn_crear"><i class="fas fa-save"></i>  Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
