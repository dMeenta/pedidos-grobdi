<div class="modal fade" id="contenidoModal{{ $muestra->id }}" tabindex="-1" role="dialog" aria-labelledby="contenidoModalLabel{{ $muestra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background-color:hsl(353, 100%, 69.6%); color: white;">
                <h5 class="modal-title" id="contenidoModalLabel{{ $muestra->id }}">
                    <i class="fas fa-vial"></i> Detalles de la Muestra
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row">
                    <!-- Información General -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="fas fa-info-circle mr-2"></i>Información General</h5>
                            </div>
                            <div class="card-body">
                                <p><strong class="text-danger">Nombre de la muestra:</strong> {{ $muestra->nombre_muestra }}</p>
                                <p><strong class="text-danger">Clasificación:</strong> {{ $muestra->clasificacion->nombre_clasificacion ?? 'No disponible' }}</p>
                                <p><strong class="text-danger">Tipo de muestra:</strong> {{ $muestra->tipo_muestra }}</p>
                                <p><strong class="text-danger">Unidad de medida:</strong> {{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida ?? 'No asignada' }}</p>
                                <p><strong class="text-danger">Cantidad:</strong> {{ $muestra->cantidad_de_muestra }}</p>
                                <p><strong class="text-danger">Observaciones:</strong> {{ $muestra->observacion }}</p>
                                <p><strong class="text-danger">Doctor:</strong> {{ $muestra->name_doctor }}</p>
                                <p><strong class="text-danger">Creado por:</strong> {{ $muestra->creator->name ?? 'Desconocido' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Estado y Fechas -->
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="fas fa-clock mr-2"></i>Estado y Fechas</h5>
                            </div>
                            <div class="card-body">
                                <p><strong class="text-danger">Aprobado por Jefe Comercial:</strong>
                                    @php
                                    $aprobadoJefe = $muestra->aprobado_jefe_comercial;
                                    $aprobadoCoord = $muestra->aprobado_coordinadora;

                                    $badgeClass = $aprobadoJefe ? 'bg-success text-white' :
                                    ($aprobadoCoord ? 'bg-warning text-dark' : 'bg-danger text-white');

                                    $estadoTexto = $aprobadoJefe ? 'Aprobado' : 'Pendiente';
                                    @endphp

                                    <span class="badge {{ $badgeClass }} px-3 py-2">
                                        {{ $estadoTexto }}
                                    </span>
                                </p>
                                <p><strong class="text-danger">Aprobado por Coordinadora:</strong>
                                    @php
                                    $aprobadoCoord = $muestra->aprobado_coordinadora;
                                    $aprobadoJefe = $muestra->aprobado_jefe_comercial;

                                    // Lógica para color de fondo
                                    $colorClass = $aprobadoCoord ? 'bg-success text-white' :
                                    ($aprobadoJefe ? 'bg-warning text-dark' : 'bg-danger text-white');

                                    $texto = $aprobadoCoord ? 'Aprobado' : 'Pendiente';
                                    @endphp

                                    <span class="badge {{ $colorClass }} px-3 py-2">
                                        {{ $texto }}
                                    </span>
                                </p>
                                <p><strong class="text-danger">Estado:</strong>
                                    @php
                                    $estado = $muestra->estado;
                                    $colorClass = $estado === 'Pendiente' ? 'bg-danger' : 'bg-success';
                                    @endphp

                                    <span class="badge {{ $colorClass }} text-white px-3 py-2">
                                        {{ $estado }}
                                    </span>
                                </p>
                                <p><strong class="text-danger">Fecha y Hora Recibida:</strong></p>
                                <input type="text" class="form-control mb-2" value="{{ $muestra->updated_at ? $muestra->updated_at->format('Y-m-d H:i') : ($muestra->created_at ? $muestra->created_at->format('Y-m-d H:i') : 'No disponible') }}" readonly style="background-color:rgb(251, 239, 252); color: #555; border: 2px solid #ccc; font-weight: bold;">
                                <p><strong class="text-danger">Fecha y Hora de Entrega:</strong></p>
                                <input type="text" class="form-control" value="{{ $muestra->fecha_hora_entrega ? \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('Y-m-d H:i') : 'Aún no se asigna fecha de entrega' }}" readonly style="background-color:rgb(244, 232, 255); color: #555; border: 2px solid #ccc; font-weight: bold;">
                            </div>

                            <div class="card-footer">
                                <strong class="text-danger">Foto Receta:</strong>
                                @if($muestra->foto)
                                <button type="button" class="btn btn-sm btn-danger verFotoBtn">
                                    <i class="fas fa-eye"></i> Ver Foto
                                </button>
                                <div class="fotoContainer mt-3" style="display: none;">
                                    <img src="{{ asset(str_replace('public/', '', $muestra->foto)) }}" alt="Foto de la muestra" style="max-width: 100%; max-height: 500px; border-radius: 10px;">
                                </div>
                                @else
                                <span>No hay foto disponible</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Comentarios -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="fas fa-comment-dots mr-2"></i>Comentario del Laboratorio</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('muestras.actualizarComentario', $muestra->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="comentarios" class="form-control" rows="5" placeholder="Escriba un comentario...">{{ old('comentarios', $muestra->comentarios) }}</textarea>
                                    <button type="submit" class="btn mt-3" style="background-color: #fe495f; color: white;"><i class="fas fa-save"></i> Guardar Comentario</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal kiik-->