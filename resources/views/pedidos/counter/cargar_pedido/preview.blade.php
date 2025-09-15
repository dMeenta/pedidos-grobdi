@extends('adminlte::page')

@section('title', 'Vista Previa de Cambios - Pedidos')

@section('content_header')
    <!-- <h1>Vista Previa de Cambios</h1> -->
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <h2 class="mb-0">
            <i class="fas fa-code-branch"></i> Vista Previa de Cambios - Pedidos
        </h2>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('cargarpedidos.create') }}">
                <i class="fa fa-arrow-left"></i> Regresar
            </a>
            <div class="btn-group">
                <form action="{{ route('cargarpedidos.confirm') }}" method="POST" class="d-inline" id="confirmFormTop">
                    @csrf
                    <input type="hidden" name="filename" value="{{ $fileName }}">
                    <button type="button" class="btn btn-success btn-sm" onclick="confirmChanges()" {{ (count($changes['new']) == 0 && count($changes['modified']) == 0) ? 'disabled' : '' }}>
                        <i class="fas fa-check"></i> Aprobar Cambios
                    </button>
                </form>
                <form action="{{ route('cargarpedidos.cancel') }}" method="POST" class="d-inline ml-2" id="cancelFormTop">
                    @csrf
                    <input type="hidden" name="filename" value="{{ $fileName }}">
                    <button type="button" class="btn btn-danger btn-sm" onclick="cancelChanges()">
                        <i class="fas fa-times"></i> Cancelar Importación
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Resumen de Cambios
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-success mr-2">
                                                <i class="fas fa-plus-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $changes['stats']['new_count'] }}</div>
                                                <div class="text-xs text-muted">Nuevos Pedidos</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning mr-2">
                                                <i class="fas fa-edit fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $changes['stats']['modified_count'] }}</div>
                                                <div class="text-xs text-muted">Modificaciones</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-info mr-2">
                                                <i class="fas fa-file-excel fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $changes['stats']['total_count'] }}</div>
                                                <div class="text-xs text-muted">Total Filas</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center">
                                            <div class="text-secondary mr-2">
                                                <i class="fas fa-equals fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $changes['stats']['total_count'] - $changes['stats']['new_count'] - $changes['stats']['modified_count'] }}</div>
                                                <div class="text-xs text-muted">Sin Cambios</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- New Orders Section -->
        @if(count($changes['new']) > 0)
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle"></i> 
                    Nuevos Pedidos ({{ count($changes['new']) }})
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Fila</th>
                                <th>ID Pedido</th>
                                <th>Cliente</th>
                                <th>Teléfono</th>
                                <th>Doctor</th>
                                <th>Distrito</th>
                                <th>Dirección</th>
                                <th>Precio</th>
                                <th>F. Entrega</th>
                                <th>Zona</th>
                                <th>Será creado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($changes['new'] as $newOrder)
                            <tr class="table-success">
                                <td><span class="badge badge-success">{{ $newOrder['row_index'] }}</span></td>
                                <td><strong>{{ $newOrder['data']['orderId'] }}</strong></td>
                                <td>{{ $newOrder['data']['customerName'] }}</td>
                                <td>{{ $newOrder['data']['customerNumber'] }}</td>
                                <td>{{ $newOrder['data']['doctorName'] }}</td>
                                <td>{{ $newOrder['data']['district'] }}</td>
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $newOrder['data']['address'] }}">
                                    {{ $newOrder['data']['address'] }}
                                </td>
                                <td>S/ {{ $newOrder['data']['prize'] }}</td>
                                <td>{{ $newOrder['data']['deliveryDate'] }}</td>
                                <td><span class="badge badge-info">{{ $newOrder['data']['zone_name'] }}</span></td>
                                <td><span class="badge badge-success">{{ now()->format('Y-m-d H:i:s') }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Modified Orders Section -->
        @if(count($changes['modified']) > 0)
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-edit"></i> 
                    Pedidos Modificados ({{ count($changes['modified']) }})
                </h5>
            </div>
            <div class="card-body">
                @foreach($changes['modified'] as $modifiedOrder)
                <div class="card mb-3 border-warning">
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">
                                    <span class="badge badge-warning">Fila {{ $modifiedOrder['row_index'] }}</span>
                                    Pedido: <strong>{{ $modifiedOrder['existing']['orderId'] }}</strong>
                                </h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <small class="text-muted">{{ count($modifiedOrder['modifications']) }} campo(s) modificado(s)</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th width="20%">Campo</th>
                                        <th width="40%">Valor Actual</th>
                                        <th width="40%">Nuevo Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modifiedOrder['modifications'] as $modification)
                                    <tr>
                                        <td><strong>{{ $modification['label'] }}</strong></td>
                                        <td>
                                            <span class="d-inline-block p-2 bg-light border rounded" style="min-height: 35px; width: 100%;">
                                                <del class="text-danger">{{ $modification['old_value'] ?: 'Vacío' }}</del>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="d-inline-block p-2 bg-success text-white border rounded" style="min-height: 35px; width: 100%;">
                                                <strong>{{ $modification['new_value'] ?: 'Vacío' }}</strong>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Complete data view -->
                        <div class="mt-3">
                            <button class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#completeData{{ $loop->index }}" aria-expanded="false">
                                <i class="fas fa-eye"></i> Ver datos completos
                            </button>
                            <div class="collapse mt-2" id="completeData{{ $loop->index }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Datos Actuales:</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <tr><td><strong>Cliente:</strong></td><td>{{ $modifiedOrder['existing']['customerName'] }}</td></tr>
                                                <tr><td><strong>Teléfono:</strong></td><td>{{ $modifiedOrder['existing']['customerNumber'] }}</td></tr>
                                                <tr><td><strong>Doctor:</strong></td><td>{{ $modifiedOrder['existing']['doctorName'] }}</td></tr>
                                                <tr><td><strong>Distrito:</strong></td><td>{{ $modifiedOrder['existing']['district'] }}</td></tr>
                                                <tr><td><strong>Dirección:</strong></td><td>{{ $modifiedOrder['existing']['address'] }}</td></tr>
                                                <tr><td><strong>Precio:</strong></td><td>S/ {{ $modifiedOrder['existing']['prize'] }}</td></tr>
                                                <tr><td><strong>F. Entrega:</strong></td><td>{{ $modifiedOrder['existing']['deliveryDate'] }}</td></tr>
                                                <tr><td><strong>Zona:</strong></td><td>{{ $modifiedOrder['existing']['zone_name'] }}</td></tr>
                                                <tr><td><strong>Última Actualización:</strong></td><td>{{ $modifiedOrder['existing']['last_data_update'] ?? 'Nunca actualizado' }}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Nuevos Datos:</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <tr><td><strong>Cliente:</strong></td><td>{{ $modifiedOrder['new']['customerName'] }}</td></tr>
                                                <tr><td><strong>Teléfono:</strong></td><td>{{ $modifiedOrder['new']['customerNumber'] }}</td></tr>
                                                <tr><td><strong>Doctor:</strong></td><td>{{ $modifiedOrder['new']['doctorName'] }}</td></tr>
                                                <tr><td><strong>Distrito:</strong></td><td>{{ $modifiedOrder['new']['district'] }}</td></tr>
                                                <tr><td><strong>Dirección:</strong></td><td>{{ $modifiedOrder['new']['address'] }}</td></tr>
                                                <tr><td><strong>Precio:</strong></td><td>S/ {{ $modifiedOrder['new']['prize'] }}</td></tr>
                                                <tr><td><strong>F. Entrega:</strong></td><td>{{ $modifiedOrder['new']['deliveryDate'] }}</td></tr>
                                                <tr><td><strong>Zona:</strong></td><td>{{ $modifiedOrder['new']['zone_name'] }}</td></tr>
                                                <tr><td><strong>Será actualizado:</strong></td><td><span class="badge badge-success">{{ now()->format('Y-m-d H:i:s') }}</span></td></tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(count($changes['new']) == 0 && count($changes['modified']) == 0)
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-2x mb-2"></i>
            <h5>No se encontraron cambios</h5>
            <p class="mb-0">El archivo Excel no contiene pedidos nuevos ni modificaciones a realizar.</p>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <form action="{{ route('cargarpedidos.confirm') }}" method="POST" class="d-inline" id="confirmForm">
                @csrf
                <input type="hidden" name="filename" value="{{ $fileName }}">
                <button type="button" class="btn btn-success btn-lg" onclick="confirmChanges()" {{ (count($changes['new']) == 0 && count($changes['modified']) == 0) ? 'disabled' : '' }}>
                    <i class="fas fa-check"></i> Confirmar y Aplicar Cambios
                </button>
            </form>
            <form action="{{ route('cargarpedidos.cancel') }}" method="POST" class="d-inline ml-3" id="cancelForm">
                @csrf
                <input type="hidden" name="filename" value="{{ $fileName }}">
                <button type="button" class="btn btn-outline-danger btn-lg" onclick="cancelChanges()">
                    <i class="fas fa-times"></i> Cancelar Importación
                </button>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .table-success {
        background-color: rgba(40, 167, 69, 0.1) !important;
    }
    
    .bg-success {
        background-color: #28a745 !important;
    }
    
    .bg-warning {
        background-color: #ffc107 !important;
    }
    
    .border-warning {
        border-color: #ffc107 !important;
    }
    
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }
    
    .card-header h5 {
        margin-bottom: 0;
    }
    
    .badge {
        font-size: 0.75rem;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        color: #5a5c69;
        text-transform: uppercase;
        font-size: 0.7rem;
    }
    
    .btn-group .btn {
        margin-left: 0.25rem;
    }
    
    /* Estilo para botones deshabilitados */
    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed !important;
        pointer-events: none;
    }
    
    .btn:disabled:hover {
        opacity: 0.5;
        transform: none;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    console.log("Vista previa de cambios cargada exitosamente");
    
    // Auto scroll to modified sections if they exist
    $(document).ready(function() {
        if ($('.card.border-warning').length > 0) {
            $('html, body').animate({
                scrollTop: $('.card.border-warning').first().offset().top - 100
            }, 1000);
        }
    });
    
    function confirmChanges() {
        const newCount = {{ count($changes['new']) }};
        const modifiedCount = {{ count($changes['modified']) }};
        
        let message = '¿Estás seguro de que deseas aplicar los siguientes cambios?\n\n';
        
        if (newCount > 0) {
            message += `• ${newCount} nuevo(s) pedido(s) se añadirán\n`;
        }
        
        if (modifiedCount > 0) {
            message += `• ${modifiedCount} pedido(s) existente(s) se modificarán\n`;
        }
        
        message += '\nEsta acción no se puede deshacer.';
        
        Swal.fire({
            title: '¿Confirmar cambios?',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545',
            confirmButtonText: '<i class="fas fa-check"></i> Sí, aplicar cambios',
            cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
            customClass: {
                popup: 'swal-wide'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Aplicando cambios...',
                    text: 'Por favor espera mientras se procesan los datos.',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit form (try main form first, then top form)
                const confirmForm = document.getElementById('confirmForm') || document.getElementById('confirmFormTop');
                confirmForm.submit();
            }
        });
    }
    
    function cancelChanges() {
        Swal.fire({
            title: '¿Cancelar importación?',
            text: 'Se descartarán todos los cambios analizados y se eliminará el archivo temporal.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Sí, cancelar',
            cancelButtonText: '<i class="fas fa-arrow-left"></i> Volver'
        }).then((result) => {
            if (result.isConfirmed) {
                const cancelForm = document.getElementById('cancelForm') || document.getElementById('cancelFormTop');
                cancelForm.submit();
            }
        });
    }
</script>
<style>
    .swal-wide {
        width: 600px !important;
    }
    
    .swal2-popup {
        font-size: 1rem !important;
    }
</style>
@stop
