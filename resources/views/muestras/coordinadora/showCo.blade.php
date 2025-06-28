<div class="modal fade" id="muestraModal{{ $muestra->id }}" tabindex="-1" aria-labelledby="muestraModalLabel{{ $muestra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background-color:hsl(353, 100.00%, 69.60%); color: white;">
                <h5 class="modal-title" id="muestraModalLabel{{ $muestra->id }}">Datos de la Muestra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Primera columna: Información General -->
                    <div class="col-md-6 mb-4" style="overflow-wrap: break-word;word-wrap: break-word; white-space: normal;">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header"  style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="bi bi-info-circle" style="margin-right: 6px;"></i> Información General</h5>
                            </div>
                            <div class="card-body">
                                <p><strong style="color:rgb(224, 61, 80);">Nombre de la muestra:</strong> {{ $muestra->nombre_muestra }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Clasificación:</strong>
                                    {{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'No disponible' }}
                                </p>
                                <p><strong style="color:rgb(224, 61, 80);">Tipo de muestra:</strong> {{ $muestra->tipo_muestra }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Unidad de medida:</strong>
                                    @if($muestra->clasificacion && $muestra->clasificacion->unidadMedida)
                                        {{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida }}
                                    @else
                                        No asignada
                                    @endif
                                </p>
                                <p><strong style="color:rgb(224, 61, 80);">Cantidad:</strong> {{ $muestra->cantidad_de_muestra }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Observaciones:</strong> {{ $muestra->observacion }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Doctor:</strong> {{ $muestra->name_doctor }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Creado por:</strong> {{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</p>
                                <p><strong style="color:rgb(224, 61, 80);">Comentario de Laboratorio:</strong></p>
                                <span>{{ $muestra->comentarios ?? 'No hay comentarios' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda columna: Estado y Fechas -->
                    <div class="col-md-6 mb-4" style="overflow-wrap: break-word;word-wrap: break-word; white-space: normal;">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header"  style="background-color:rgb(255, 175, 184); color: rgb(169, 68, 80);">
                                <h5><i class="bi bi-clock-history" style="margin-right: 6px;"></i> Estado y Fechas</h5>
                            </div>
                            <div class="card-body">
                                <p><strong style="color:rgb(224, 61, 80);">Aprobado por Jefe Comercial:</strong>
                                    <span class="badge"
                                        style="background-color: {{ $muestra->aprobado_jefe_comercial ? 'green' : ($muestra->aprobado_coordinadora ? 'yellow' : 'red') }};
                                                color: {{ ($muestra->aprobado_jefe_comercial == false && $muestra->aprobado_coordinadora == false) || $muestra->aprobado_jefe_comercial ? 'white' : 'black' }}; 
                                                padding: 10px;">
                                        {{ $muestra->aprobado_jefe_comercial ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </p>

                                <p><strong style="color:rgb(224, 61, 80);">Aprobado por Coordinadora:</strong>
                                    <span class="badge"
                                        style="background-color: {{ $muestra->aprobado_coordinadora ? 'green' : ($muestra->aprobado_jefe_comercial ? 'yellow' : 'red') }}; 
                                                color: {{ ($muestra->aprobado_coordinadora == false && $muestra->aprobado_jefe_comercial == false) || $muestra->aprobado_coordinadora ? 'white' : 'black' }}; 
                                                padding: 10px;">
                                        {{ $muestra->aprobado_coordinadora ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </p>

                                <p><strong style="color:rgb(224, 61, 80);">Estado:</strong>
                                    <span class="badge" style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 10px;">
                                        {{ $muestra->estado }}
                                    </span>
                                </p>

                                <p><strong style="color:rgb(224, 61, 80);">Fecha y Hora Recibida:</strong></p>
                                <input type="text" class="form-control mb-2"
                                    value="{{ $muestra->updated_at ? \Carbon\Carbon::parse($muestra->updated_at)->format('Y-m-d H:i') : ($muestra->created_at ? \Carbon\Carbon::parse($muestra->created_at)->format('Y-m-d H:i') : 'No disponible') }}"
                                    readonly style="background-color:rgb(251, 239, 252); color: #555; border: 2px solid #ccc; font-weight: bold;">

                                <p><strong style="color:rgb(224, 61, 80);">Fecha y Hora de Entrega:</strong></p>
                                <input type="text" class="form-control"
                                    value="{{ $muestra->fecha_hora_entrega ? \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('Y-m-d H:i') : 'Aún no se asigna fecha de entrega' }}"
                                    readonly style="background-color:rgb(244, 232, 255); color: #555; border: 2px solid #ccc; font-weight: bold;">
                            </div>

                            <!-- Botón para mostrar/ocultar la foto -->
                            <div class="card-footer">
                                <strong style="color:rgb(224, 61, 80);">Foto Receta:</strong>
                                @if($muestra->foto)
                                    <button type="button" class="btn verFotoBtn" style="background-color: #fe495f; color: white; border-radius: 5px;">
                                        <i class="bi bi-eye"></i> Ver Foto
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
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
