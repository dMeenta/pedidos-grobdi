<!-- Modal Detalle de Compra -->
<div class="modal fade" id="modalDetalleCompra{{ $compra->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetalleCompraLabel{{ $compra->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content" style="border-radius: 12px; background-color:rgb(255, 255, 255);">

      <!-- Header -->
      <div class="modal-header text-white" style="background-color:hsl(353, 100.00%, 69.60%); color: white;  border-top-left-radius: 12px; border-top-right-radius: 12px;">
        <h5 class="modal-title" id="modalDetalleCompraLabel{{ $compra->id }}"><i class="fas fa-shopping-basket"></i>
        Detalles de la Compra</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
        <div class="row">
          <!-- Información general -->
          <div class="col-md-6">
            <div class="card border">
              <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                <h5 class="mb-0"><i class="fas fa-info-circle"></i>  Información General</h5>
              </div>
              <div class="card-body">
                <p><strong class="text-danger">N° de Compra:</strong> {{ $compra->id }}</p>
                <p><strong class="text-danger">Fecha de Emisión:</strong> {{ $compra->fecha_emision->format('d/m/Y') }}</p>
                <p><strong class="text-danger">Proveedor:</strong> {{ $compra->proveedor->razon_social }}</p>
                <p><strong class="text-danger">Moneda:</strong> {{ $compra->moneda->nombre }} ({{ $compra->moneda->codigo_iso }})</p>
                <p><strong class="text-danger">Condición de Pago:</strong> {{ $compra->condicion_pago }}</p>
                <p><strong class="text-danger">Referencia:</strong> {{ $compra->serie }} - {{ $compra->numero }}</p>
                <p><strong class="text-danger">IGV:</strong> 
                    @if(!empty($compra->igv) && $compra->igv > 0)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-secondary">No</span>
                    @endif
                </p>
                <p><strong class="text-danger">Total:</strong> {{ number_format($compra->precio_total, 2) }}</p>
              </div>
            </div>
          </div>

          <!-- Tabla -->
          <div class="col-md-6" style="overflow-x: auto; width: 100%;">
            <table id="tablaCompras" class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Tipo</th>
                  <th>Artículo</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($compra->detalles as $detalle)
                  <tr>
                    <td>{{ ucfirst($detalle->lote->articulo->tipo ?? 'Sin tipo') }}</td>
                    <td class="observaciones">{{ $detalle->lote->articulo->nombre ?? 'Sin nombre' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->precio, 2) }}</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-times-circle"></i>  Cerrar</button>
      </div>

    </div>
  </div>
</div>
