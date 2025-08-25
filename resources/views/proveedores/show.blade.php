@if(isset($proveedor))
<div class="modal fade" id="ProveedorModal{{ $proveedor->id }}" tabindex="-1" role="dialog" aria-labelledby="ProveedorModalLabel{{ $proveedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="border-radius: 12px; background-color:rgb(255, 255, 255);">
            <div class="modal-header text-white" style="background-color: #fe495f; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title" id="ProveedorModalLabel{{ $proveedor->id }}">
                    <i class="bi bi-person-badge-fill mr-2"></i> Información del Proveedor
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="color: #333; max-height: 70vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-6" style="word-wrap: break-word; overflow-wrap: break-word;">
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Razón Social:</strong> {{ $proveedor->razon_social }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">RUC:</strong> {{ $proveedor->ruc }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Dirección:</strong> {{ $proveedor->direccion }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Correo:</strong> {{ $proveedor->correo ?? 'No se registró correo' }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Correo CPE:</strong> {{ $proveedor->correo_cpe ?? 'No se registró correo' }}</p>
                    </div>

                    <div class="col-md-6" style="word-wrap: break-word; overflow-wrap: break-word;">
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Teléfono 1:</strong> {{ $proveedor->telefono_1 }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Teléfono 2:</strong> {{ $proveedor->telefono_2 ?? 'No se registró un segundo teléfono' }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Persona de Contacto:</strong> {{ $proveedor->persona_contacto ?? 'No se registró una persina de contacto' }}</p>
                        <p style="white-space: normal;"><strong style="color:#e03d50;">Estado:</strong>
                            @php
                            $estado = $proveedor->estado ?? 'inactivo';
                            @endphp

                            <span class="badge badge-pill {{ $estado == 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                {{ ucfirst($estado) }}
                            </span>


                        </p>
                    </div>
                </div>

                <div class="mt-3 pt-3" style="border-top: 1px solid #eee;">
                    <p class="mb-2"><strong style="color: #e03d50; font-weight: 600;">Observaciones:</strong></p>
                    <div class="bg-light p-3 rounded" style="border-left: 3px solid #fe495f; word-wrap: break-word; overflow-wrap: break-word;">
                        <p class="mb-0" style="white-space: normal;">{{ $proveedor->observacion ?: 'Ninguna observación registrada' }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #fff0f2;">
                <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-pencil-square"></i> Editar
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
@endif