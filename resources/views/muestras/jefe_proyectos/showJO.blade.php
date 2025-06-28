<!-- Modal para mostrar los detalles de la muestra -->
<div class="modal fade" id="muestraModal{{ $muestra->id }}" tabindex="-1" role="dialog" aria-labelledby="muestraModalLabel{{ $muestra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background-color:hsl(353, 100%, 69.6%); color: white;">
                <h5 class="modal-title" id="muestraModalLabel{{ $muestra->id }}">Datos de la Muestra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <!-- Columna 1 -->
                    <div class="col-md-6 mb-4" style="overflow-wrap: break-word; white-space: normal;">
                        <div class="card mb-4" style="border-radius: 10px;">
                            <div class="card-header">
                                <h5><i class="bi bi-info-circle mr-2"></i> Información General</h5>
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
                                <p><strong class="text-danger">Precio:</strong> {{ $muestra->precio }}</p>
                                <p><strong class="text-danger">Total S/.</strong> {{ $muestra->cantidad_de_muestra * $muestra->precio }}</p>
                                <p><strong class="text-danger">Observaciones:</strong> {{ $muestra->observacion }}</p>
                                <p><strong class="text-danger">Doctor:</strong> {{ $muestra->name_doctor }}</p>
                                <p><strong class="text-danger">Creado por:</strong> {{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</p>
                                <p><strong class="text-danger">Comentario de Laboratorio:</strong></p>
                                <span>{{ $muestra->comentarios ?? 'No hay comentarios' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Columna 2 -->
                    <div class="col-md-6 mb-4" style="overflow-wrap: break-word; white-space: normal;">
                        <div class="card" style="border-radius: 10px;">
                            <div class="card-header">
                                <h5><i class="bi bi-clock-history mr-2"></i> Estado y Fechas</h5>
                            </div>
                            <div class="card-body">
                                <p><strong class="text-danger">Aprobado por Jefe Comercial:</strong>
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $muestra->aprobado_jefe_comercial ? 'green' : ($muestra->aprobado_coordinadora ? 'yellow' : 'red') }};
                                               color: {{ ($muestra->aprobado_jefe_comercial == false && $muestra->aprobado_coordinadora == false) || $muestra->aprobado_jefe_comercial ? 'white' : 'black' }};
                                               padding: 10px;">
                                        {{ $muestra->aprobado_jefe_comercial ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </p>

                                <p><strong class="text-danger">Aprobado por Coordinadora:</strong>
                                    <span class="badge badge-pill"
                                        style="background-color: {{ $muestra->aprobado_coordinadora ? 'green' : ($muestra->aprobado_jefe_comercial ? 'yellow' : 'red') }};
                                               color: {{ ($muestra->aprobado_coordinadora == false && $muestra->aprobado_jefe_comercial == false) || $muestra->aprobado_coordinadora ? 'white' : 'black' }};
                                               padding: 10px;">
                                        {{ $muestra->aprobado_coordinadora ? 'Aprobado' : 'Pendiente' }}
                                    </span>
                                </p>

                                <p><strong class="text-danger">Estado:</strong>
                                    <span class="badge badge-pill" style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 10px;">
                                        {{ $muestra->estado }}
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
        </div>
    </div>
</div>

<style>
    .modal-content {
        border-radius: 15px;
    }
    .card-header {
        background-color: #fe495f;
        color: white;
        font-size: 1.2rem;
    }
    .card-body {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 10px;
    }
    .text-danger {
        color: rgb(224, 61, 80) !important;
    }
    .badge {
        font-size: 0.9rem;
    }
</style>
