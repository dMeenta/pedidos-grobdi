<div class="modal fade" id="detalleBaseModal{{ $base->id }}" tabindex="-1" role="dialog" aria-labelledby="detalleBaseModalLabel{{ $base->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header text-white" style="background:rgba(255, 81, 101, 0.93);">
                <h5 class="modal-title" id="detalleBaseModalLabel" style="white-space: normal; word-break: break-word;">
                    <i class="fas fa-info-circle"></i> <strong>Detalles: {{ $base->articulo->nombre }}</strong>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="card mb-4 border border-danger" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong class="text-danger">Tipo:</strong> {{ ucfirst($base->tipo) }}</p>
                                <p><strong class="text-danger">Clasificación:</strong> {{ $base->volumen->clasificacion->nombre_clasificacion ?? '—' }}</p>
                                <p><strong class="text-danger">Volumen:</strong> {{ $base->volumen->nombre ?? '-' }} {{ $base->volumen->clasificacion->unidadMedida->nombre_unidad_de_medida ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong class="text-danger">Precio:</strong> S/ {{ number_format($base->precio, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>


                @if($base->insumos->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;"><i class="fa fa-atom"></i>
                        <strong>Insumos Utilizados</strong>
                    </div>
                    <div class="card-body">
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
                                @foreach($base->insumos as $insumo)
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
                @endif

                @if($base->tipo === 'final' && $base->prebases->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;"><i class="fa fa-flask"></i>
                        <strong>Prebases Utilizadas</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($base->prebases as $prebase)
                                <tr>
                                    <td class="observaciones">{{ $prebase->articulo->nombre }}</td>
                                    <td>{{ $prebase->pivot->cantidad }}</td>
                                    <td>S/ {{ number_format($prebase->precio, 2) }}</td>
                                    <td>S/ {{ number_format($prebase->precio * $prebase->pivot->cantidad, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($base->tipo === 'final' && $base->empaques->isNotEmpty())
                <div class="card mt-4">
                    <div class="card-header" style="background-color:rgb(254, 107, 124); color: white;"><i class="fa fa-box"></i>
                        <strong>Empaques Utilizados</strong>
                    </div>
                    <div class="card-body">
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
                                @foreach($base->empaques as $empaque)
                                <tr>
                                    <td class="observaciones">{{ $empaque->articulo->nombre }}</td>
                                    <td>{{ $empaque->pivot->cantidad }}</td>
                                    <td>S/ {{ number_format($empaque->precio, 2) }}</td>
                                    <td>S/ {{ number_format($empaque->precio * $empaque->pivot->cantidad, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
