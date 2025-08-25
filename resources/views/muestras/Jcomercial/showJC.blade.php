<!-- Modal -->
<div class="modal fade" id="muestraModal{{ $muestra->id }}" tabindex="-1" role="dialog" aria-labelledby="muestraModalLabel{{ $muestra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <!-- Modal Header -->
            <div class="modal-header" style="background-color:hsl(353, 100%, 69.6%); color: white;">
                <h5 class="modal-title" id="muestraModalLabel{{ $muestra->id }}">Datos de la Muestra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="row">
                    <!-- Card Información General -->
                    <div class="col-md-6 mb-4">
                        <div class="card" style="overflow-wrap: break-word; white-space: normal;">
                            <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="fas fa-info-circle mr-2" style="margin-right: 6px;"></i> Información General</h5>
                            </div>
                            <div class="card-body">
                                <p><strong class="text-danger">Nombre de la muestra:</strong> {{ $muestra->nombre_muestra }}</p>
                                <p><strong class="text-danger">Clasificación:</strong> {{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'No disponible' }}</p>
                                <p><strong class="text-danger">Tipo de muestra:</strong> {{ $muestra->tipo_muestra }}</p>
                                <p><strong class="text-danger">Unidad de medida:</strong>
                                    @if($muestra->clasificacion && $muestra->clasificacion->unidadMedida)
                                    {{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida }}
                                    @else
                                    No asignada
                                    @endif
                                </p>
                                <p><strong class="text-danger">Cantidad:</strong> {{ $muestra->cantidad_de_muestra }}</p>
                                <p><strong class="text-danger">Observaciones:</strong> {{ $muestra->observacion }}</p>
                                <p><strong class="text-danger">Doctor:</strong> {{ $muestra->name_doctor }}</p>
                                <p><strong class="text-danger">Creado por:</strong> {{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</p>
                                <p><strong class="text-danger">Comentario de Laboratorio:</strong></p>
                                <span>{{ $muestra->comentarios ?? 'No hay comentarios' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Estado y Fechas -->
                    <div class="col-md-6 mb-4" style="overflow-wrap: break-word; white-space: normal;">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header" style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="fas fa-clock mr-2" style="margin-right: 6px;"></i> Estado y Fechas</h5>
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
                                <input type="text" class="form-control mb-2"
                                    value="{{ $muestra->updated_at ? \Carbon\Carbon::parse($muestra->updated_at)->format('Y-m-d H:i') : ($muestra->created_at ? \Carbon\Carbon::parse($muestra->created_at)->format('Y-m-d H:i') : 'No disponible') }}"
                                    readonly style="background-color:rgb(251, 239, 252); color: #555; border: 2px solid #ccc; font-weight: bold;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">