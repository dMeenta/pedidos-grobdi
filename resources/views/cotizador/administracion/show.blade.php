<div class="modal fade" id="detalleModal{{ $tipo }}{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 12px;">
      
      <div class="modal-header text-white" style="background-color:rgba(255, 111, 128, 0.93);">
        <h5 class="modal-title" id="detalleInsumoModalLabel{{ $item->id }}">
          <i class="bi bi-info-circle-fill mr-2"></i> Detalles de {{ ucfirst($tipo) }}
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="background-color: #f8f9fa;">
        <div class="row">
          <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
            <p><strong style="color:rgb(224, 61, 80);">Nombre:</strong> {{ $item->articulo->nombre }}</p>

            @if ($tipo === 'insumo')
              <p><strong style="color:rgb(224, 61, 80);">Precio:</strong> S/ {{ number_format($item->precio, 3) }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Precio de Última compra:</strong> S/ {{ $item->ultimoLote?->precio ?? '--' }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Unidad de Medida:</strong> {{ $item->unidadMedida->nombre_unidad_de_medida ?? 'N/A' }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Stock:</strong> {{ $item->articulo->stock }}</p>
              <p><strong style="color:rgb(224, 61, 80);">¿Es caro?:</strong> 
                <span class="badge badge-{{ $item->es_caro ? 'danger' : 'secondary' }}">
                  {{ $item->es_caro ? 'Sí' : 'No' }}
                </span>
              </p>
            @else
              <p><strong style="color:rgb(224, 61, 80);">Tipo:</strong> {{ $item->tipo }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Precio:</strong> S/ {{ number_format($item->precio, 3) }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Precio de Última compra:</strong> S/ {{ $item->ultimoLote?->precio ?? '--' }}</p>
              <p><strong style="color:rgb(224, 61, 80);">Stock:</strong> {{ $item->articulo->stock }}</p>
            @endif
          </div>

          <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
                <p><strong style="color:rgb(224, 61, 80);">Estado:</strong>
                    <span class="badge" style="background-color: {{ $item->articulo->estado === 'activo' ? 'green' : 'gray' }}; color: white; padding: 10px;">
                        {{ $item->articulo->estado === 'activo' ? 'Activo' : 'Inactivo' }}
                    </span>
                </p>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="background-color:rgba(255, 238, 238, 0.94);">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          <i class="bi bi-x-circle"></i> Cerrar
        </button>
      </div>

    </div>
  </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
