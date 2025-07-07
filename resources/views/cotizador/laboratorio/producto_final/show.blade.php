<div class="modal fade" id="detalleProductoModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="detalleProductoModalLabel{{ $producto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:rgba(255, 81, 101, 0.93);">
                <h5 class="modal-title" id="detalleProductoModalLabel" style="white-space: normal; word-break: break-word;">
                    <i class="fas fa-box-open"></i> <strong>Detalles: {{ $producto->articulo->nombre }}</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="card mb-4 border border-danger" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong class="text-danger">Clasificación:</strong> {{ $producto->volumen->clasificacion->nombre_clasificacion ?? '—' }}</p>
                                <p><strong class="text-danger">Volumen:</strong> {{ $producto->volumen->nombre ?? '-' }} {{ $producto->volumen->clasificacion->unidadMedida->nombre_unidad_de_medida ?? 'N/A' }}</p>
                                <p><strong class="text-danger">Estado del Artículo:</strong>
                                    <span class="badge badge-{{ $producto->articulo->estado === 'activo' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($producto->articulo->estado) }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="text-danger">Costo Producción:</strong> S/ {{ number_format($producto->costo_total_produccion, 2) }}</p>
                                <p><strong class="text-danger">Costo Real (con IGV):</strong> S/ {{ number_format($producto->costo_total_real, 2) }}</p>
                                <p><strong class="text-danger">Costo Publicado:</strong> S/ {{ number_format($producto->costo_total_publicado, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Insumos --}}
                @if($producto->insumos->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;">
                        <i class="fa fa-atom"></i> <strong>Insumos Utilizados</strong>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto; width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Costo Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($producto->insumos as $insumo)
                                    <tr>
                                        <td class="observaciones">{{ $insumo->articulo->nombre }}</td>
                                        <td>{{ $insumo->pivot->cantidad }}</td>
                                        <td>S/ {{ number_format($insumo->precio, 2) }}</td>
                                        <td>S/ {{ number_format($insumo->precio * $insumo->pivot->cantidad, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Bases --}}
                @if($producto->bases->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;">
                        <i class="fa fa-flask"></i> <strong>Bases Utilizadas</strong>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto; width: 100%;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Costo Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($producto->bases as $base)
                                    <tr>
                                        <td class="observaciones">{{ $base->articulo->nombre }}</td>
                                        <td>{{ $base->pivot->cantidad }}</td>
                                        <td>S/ {{ number_format($base->precio, 2) }}</td>
                                        <td>S/ {{ number_format($base->precio * $base->pivot->cantidad, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
