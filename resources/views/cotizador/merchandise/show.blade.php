<!-- Modal para mostrar detalles del material -->
<div class="modal fade" id="detalleModalmer{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="detalleLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header text-white" style="background-color: rgba(255, 111, 128, 0.93);">
                <h5 class="modal-title" id="detalleLabel{{ $item->id }}">
                    <i class="fas fa-info-circle mr-2"></i>Detalles del Material
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background-color: #f8f9fa; border-radius: 12px;">
                <div class="row">
                    <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
                        <p><strong style="color:rgb(224, 61, 80);">Nombre:</strong> {{ $item->articulo->nombre }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Precio:</strong> S/ {{ number_format($item->precio, 3) }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Stock:</strong> {{ $item->articulo->stock }}</p>
                    </div>
                    <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
                        <p><strong style="color:rgb(224, 61, 80);">Estado:</strong>
                            <span class="badge" style="background-color: {{ $item->articulo->estado === 'activo' ? 'green' : 'gray' }}; color: white; padding: 5px;">
                                {{ ucfirst($item->articulo->estado) }}
                            </span>
                        </p>
                        <p><strong style="color:rgb(224, 61, 80);">Precio de Última compra:</strong><br> S/ {{ $item->articulo->ultimaCompra?->precio ?? '--' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Link de Bootstrap Icons para el uso de iconos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
