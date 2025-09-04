@extends('adminlte::page')

@section('title', 'Vista Previa de Cambios - Artículos')

@section('content_header')
    <!-- <h1>Vista Previa de Cambios</h1> -->
@stop

@section('content')
<div class="card mt-2">
    <div class="card-header">
        <h2 class="mb-0">
            <i class="fas fa-boxes"></i> Vista Previa de Cambios - Artículos de Pedidos
        </h2>
    </div>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between mb-3">
            <a class="btn btn-secondary btn-sm" href="{{ route('cargarpedidos.create') }}">
                <i class="fa fa-arrow-left"></i> Regresar
            </a>
            <div class="btn-group">
                <form action="{{ route('cargarpedidos.confirm-articulos') }}" method="POST" class="d-inline" id="confirmFormTop">
                    @csrf
                    <input type="hidden" name="filename" value="{{ $fileName }}">
                    <button type="button" class="btn btn-success btn-sm" onclick="confirmChanges()" {{ ((count($changes['new']) == 0 && count($changes['modified']) == 0) || (isset($changes['duplicates']) && count($changes['duplicates'])>0)) ? 'disabled' : '' }}>
                        <i class="fas fa-check"></i> Aprobar Cambios
                    </button>
                </form>
                <form action="{{ route('cargarpedidos.cancel-articulos') }}" method="POST" class="d-inline ml-2" id="cancelFormTop">
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
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Resumen de Cambios - Artículos
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="text-success mr-2">
                                                <i class="fas fa-plus-circle fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $changes['stats']['new_count'] }}</div>
                                                <div class="text-xs text-muted">Nuevos Artículos</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="text-warning mr-2">
                                                <i class="fas fa-clock fa-2x"></i>
                                            </div>
                                            <div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ now()->format('Y-m-d H:i:s') }}</div>
                                                <div class="text-xs text-muted">Fecha de Procesamiento</div>
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

        <!-- Duplicates in Excel -->
        @if(isset($changes['duplicates']) && count($changes['duplicates']) > 0)
        <div class="alert alert-danger">
            <h5 class="mb-2"><i class="fas fa-exclamation-triangle"></i> Duplicados en el Excel</h5>
            <p class="mb-2">Se encontraron filas duplicadas en el archivo. Corrige el archivo y vuelve a subirlo. No se puede confirmar mientras existan duplicados.</p>
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Fila</th>
                            <th>Pedido</th>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                            <th>Precio Unit.</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($changes['duplicates'] as $dup)
                        <tr class="table-danger">
                            <td>{{ $dup['row_index'] }}</td>
                            <td>{{ $dup['pedido_id'] }}</td>
                            <td>{{ $dup['articulo'] }}</td>
                            <td>{{ $dup['cantidad'] }}</td>
                            <td>S/ {{ $dup['unit_prize'] }}</td>
                            <td>S/ {{ $dup['sub_total'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- New Articles Section -->
        @if(count($changes['new']) > 0)
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle"></i> 
                    Nuevos Artículos ({{ count($changes['new']) }})
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Fila</th>
                                <th>Pedido ID</th>
                                <th>Cliente</th>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                                <th>Precio Unit.</th>
                                <th>Sub Total</th>
                                <th>Será creado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($changes['new'] as $newArticle)
                            <tr class="table-success">
                                <td><span class="badge badge-success">{{ $newArticle['row_index'] }}</span></td>
                                <td><strong>{{ $newArticle['data']['pedido_id'] }}</strong></td>
                                <td>{{ $newArticle['data']['pedido_cliente'] }}</td>
                                <td>{{ $newArticle['data']['articulo'] }}</td>
                                <td>{{ $newArticle['data']['cantidad'] }}</td>
                                <td>S/ {{ $newArticle['data']['unit_prize'] }}</td>
                                <td>S/ {{ $newArticle['data']['sub_total'] }}</td>
                                <td><span class="badge badge-success">{{ now()->format('Y-m-d H:i:s') }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Modified Articles Section -->
        @if(count($changes['modified']) > 0)
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-edit"></i> 
                    Artículos Modificados ({{ count($changes['modified']) }})
                </h5>
            </div>
            <div class="card-body">
                @foreach($changes['modified'] as $modifiedArticle)
                <div class="card mb-3 border-warning">
                    <div class="card-header bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">
                                    <span class="badge badge-warning">Fila {{ $modifiedArticle['row_index'] }}</span>
                                    Pedido: <strong>{{ $modifiedArticle['pedido_id'] }}</strong> - Artículo: <strong>{{ $modifiedArticle['existing']['articulo'] }}</strong>
                                </h6>
                            </div>
                            <div class="col-md-6 text-right">
                                <small class="text-muted">{{ count($modifiedArticle['modifications']) }} campo(s) modificado(s)</small>
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
                                    @foreach($modifiedArticle['modifications'] as $modification)
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
                            <button class="btn btn-sm btn-outline-info" type="button" data-toggle="collapse" data-target="#completeDataArticle{{ $loop->index }}" aria-expanded="false">
                                <i class="fas fa-eye"></i> Ver datos completos
                            </button>
                            <div class="collapse mt-2" id="completeDataArticle{{ $loop->index }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Datos Actuales:</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <tr><td><strong>Pedido ID:</strong></td><td>{{ $modifiedArticle['existing']['pedido_id'] }}</td></tr>
                                                <tr><td><strong>Cliente:</strong></td><td>{{ $modifiedArticle['existing']['pedido_cliente'] }}</td></tr>
                                                <tr><td><strong>Artículo:</strong></td><td>{{ $modifiedArticle['existing']['articulo'] }}</td></tr>
                                                <tr><td><strong>Cantidad:</strong></td><td>{{ $modifiedArticle['existing']['cantidad'] }}</td></tr>
                                                <tr><td><strong>Precio Unit.:</strong></td><td>S/ {{ $modifiedArticle['existing']['unit_prize'] }}</td></tr>
                                                <tr><td><strong>Sub Total:</strong></td><td>S/ {{ $modifiedArticle['existing']['sub_total'] }}</td></tr>
                                                <tr><td><strong>Última Actualización:</strong></td><td>{{ $modifiedArticle['existing']['last_data_update'] }}</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Nuevos Datos:</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered">
                                                <tr><td><strong>Pedido ID:</strong></td><td>{{ $modifiedArticle['new']['pedido_id'] }}</td></tr>
                                                <tr><td><strong>Cliente:</strong></td><td>{{ $modifiedArticle['new']['pedido_cliente'] }}</td></tr>
                                                <tr><td><strong>Artículo:</strong></td><td>{{ $modifiedArticle['new']['articulo'] }}</td></tr>
                                                <tr><td><strong>Cantidad:</strong></td><td>{{ $modifiedArticle['new']['cantidad'] }}</td></tr>
                                                <tr><td><strong>Precio Unit.:</strong></td><td>S/ {{ $modifiedArticle['new']['unit_prize'] }}</td></tr>
                                                <tr><td><strong>Sub Total:</strong></td><td>S/ {{ $modifiedArticle['new']['sub_total'] }}</td></tr>
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
            <p class="mb-0">El archivo Excel no contiene artículos nuevos ni modificaciones a realizar.</p>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <form action="{{ route('cargarpedidos.confirm-articulos') }}" method="POST" class="d-inline" id="confirmForm">
                @csrf
                <input type="hidden" name="filename" value="{{ $fileName }}">
                <button type="button" class="btn btn-success btn-lg" onclick="confirmChanges()" {{ ((count($changes['new']) == 0 && count($changes['modified']) == 0) || (isset($changes['duplicates']) && count($changes['duplicates'])>0)) ? 'disabled' : '' }}>
                    <i class="fas fa-check"></i> Confirmar y Aplicar Cambios
                </button>
            </form>
            <form action="{{ route('cargarpedidos.cancel-articulos') }}" method="POST" class="d-inline ml-3" id="cancelForm">
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
    .border-left-success {
        border-left: 0.25rem solid #28a745 !important;
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
    
    .shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
    }
    
    .card-header h2 {
        color: #28a745;
    }
    
    .btn-lg {
        padding: 12px 24px;
        font-size: 1.1rem;
    }
    
    .alert {
        border-radius: 10px;
    }
    
    .fa-2x {
        font-size: 2em;
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
function confirmChanges() {
    Swal.fire({
        title: '¿Confirmar importación de artículos?',
        text: 'Esta acción procesará todos los artículos del archivo Excel y los agregará a los pedidos correspondientes.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: '<i class="fas fa-check"></i> Sí, importar',
        cancelButtonText: '<i class="fas fa-times"></i> Cancelar',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: () => {
            return new Promise((resolve) => {
                document.getElementById('confirmForm').submit();
                resolve();
            });
        }
    });
}

function cancelChanges() {
    Swal.fire({
        title: '¿Cancelar importación?',
        text: 'Se descartarán todos los cambios y se eliminará el archivo temporal.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Sí, cancelar',
        cancelButtonText: '<i class="fas fa-arrow-left"></i> Volver',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                document.getElementById('cancelForm').submit();
                resolve();
            });
        }
    });
}
</script>
@stop
