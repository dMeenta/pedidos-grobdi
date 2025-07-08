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
              <label>Moneda (USD): </label>
              <input type="text" class="form-control" value="Dólar (USD)" readonly>
              <input type="hidden" name="tipo_moneda_id" value="1">
          </div>


          <div class="form-group">
            <label for="valor_compra">Valor Compra (USD):</label>
            <input type="number" name="valor_compra" step="0.0001" class="form-control" required>
          </div>

          <div class="form-group">
              <label for="valor_venta">Valor Venta (USD):</label>
              <input type="number" name="valor_venta" step="0.0001" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn_crear"><i class="fas fa-save"></i>  Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
