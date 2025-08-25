@php
$role = auth()->check() ? auth()->user()->role->name : null;
@endphp

<!-- Modal para mostrar los detalles de la muestra -->
<div class="modal fade" id="muestraDetailsModal" tabindex="-1" role="dialog" aria-labelledby="muestraDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-auto" style="max-height: 70vh;">
                <div class="row mb-4">
                    <!-- Primera columna: Información General -->
                    <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
                        <div class="card card-danger h-100 mb-0" style="border-radius: 10px;">
                            <div class="card-header">
                                <h6 class="card-title"><i class="fas fa-info-circle mr-2"></i>Información General</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Nombre de la muestra:</strong><span id="nombre_muestra"></span></li>
                                    <li class="list-group-item">
                                        <div>
                                            <strong>Clasificación:</strong>
                                            <span id="clasificacion_muestra"></span>
                                        </div>
                                        <div>
                                            <strong>Unidad de medida:</strong>
                                            <span id="unidad_medida"></span>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Tipo de frasco:</strong> <span id="tipo_frasco"></span>
                                        <strong id="presentacion_frasco">Presentacion del frasco:</strong> <span id="presentacion_frasco_original"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Tipo de muestra:</strong> <span id="tipo_muestra"></span></li>
                                    <li class="list-group-item"><strong>Cantidad:</strong> <span id="cantidad_muestra"></span></li>
                                    @if(in_array($role, ['admin', 'jefe-comercial', 'contabilidad', 'jefe-operaciones']))
                                    <li class="list-group-item">
                                        <strong class="align-self-center">Precio</strong>
                                        <ul>
                                            <li>
                                                <strong>Por unidad:</strong> <span id="precio_unitario"></span>
                                            </li>
                                            <li>
                                                <strong>Total: </strong> <span id="precio_total"></span>
                                            </li>
                                        </ul>
                                    </li>
                                    @endif
                                    <li class="list-group-item"><strong>Observaciones:</strong> <span id="observaciones"></span></li>
                                    <li class="list-group-item"><strong>Doctor:</strong> <span id="doctor"></span></li>
                                    <li class="list-group-item"><strong>Creado por:</strong> <span id="creado_por"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda columna: Estado y Fechas -->
                    <div class="col-md-6" style="overflow-wrap: break-word; white-space: normal;">
                        <div class="card card-danger h-100 mb-0" style="border-radius: 10px;">
                            <div class="card-header">
                                <h6 class="card-title"><i class="fas fa-clock mr-2"></i> Estado y Fechas</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Aprobación de la Coordinadora:</strong>
                                        <h6><span class="badge badge-pill" id="coordinadora-badge"></span></h6>
                                    </li>
                                    <li class="list-group-item"><strong>Aprobación del Jefe Comercial:</strong>
                                        <h6><span class="badge badge-pill" id="jComercial-badge"></span></h6>
                                    </li>
                                    <li class="list-group-item"><strong>Aprobación del Jefe de Operaciones:</strong>
                                        <h6><span class="badge badge-pill" id="jOperaciones-badge"></span></h6>
                                    </li>
                                    <li class="list-group-item"><strong>Estado de laboratorio:</strong>
                                        <h6><span class="badge badge-pill" id="lab-state-badge"></span></h6>
                                    </li>
                                    <li class="list-group-item"><strong>Fecha de registro:</strong>
                                        <span id="date-registered"></span>
                                        <span id="time-registered"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Fecha de entrega agendada para:</strong>
                                        <span id="date-scheduled"></span>
                                        <span id="time-scheduled"></span>
                                    </li>
                                    <li class="list-group-item"><strong>Fecha de entrega por laboratorio:</strong>
                                        <span id="date-delivered"></span>
                                        <span id="time-delivered"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if(in_array($role, ['admin', 'laboratorio']))
                    <div class="card card-danger w-100" style="border-radius: 10px;">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-comment-dots mr-2"></i>Comentario del Laboratorio</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="comentarioForm">
                                @csrf
                                @method('PUT')
                                <textarea name="comentario_lab" class="form-control" rows="4" placeholder="Escriba un comentario..."></textarea>
                                <div class="w-100 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-outline-danger mt-3 w-75">
                                        <i class="fas fa-save"></i> Guardar Comentario
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="card w-100 px-2 py-3" style="border-radius: 10px;">
                        <p class="m-0 text-center"><strong>Comentario del Laboratorio: </strong><i id="comentario-laboratorio"></i></p>
                    </div>
                    @endif
                </div>
                <div class="row" id="delete-reason-div">
                    <div class="card card-danger w-100" style="border-radius: 10px;">
                        <div class="card-header">
                            <h5 class="card-title"><i class="fas fa-comment-dots mr-2"></i>Razón de eliminación</h5>
                        </div>
                        <div class="card-body">
                            <p class="m-0 text-center"><i id="delete-reason"></i></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>