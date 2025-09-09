@extends('adminlte::page')

@section('title', 'Cargar Excel Pedidos')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="card mt-2">
    <h2 class="card-header">Cargar Pedido</h2>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
        </div>
        <br>
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Info:">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </svg>
            <div>
                <strong>Nuevo proceso automático:</strong> Al seleccionar el archivo Excel, se analizará automáticamente 
                para mostrar qué datos son nuevos y cuáles se modificarán. Simplemente selecciona tu archivo y espera la vista previa.
            </div>
        </div>
        <form action="{{ route('cargarpedidos.store') }}" method="POST" enctype="multipart/form-data" id="pedidosForm">
            @csrf
            <div class="mb-5">
                <label for="pedidos_excel" class="form-label"><strong>Cargar Pedidos con direcciones:</strong></label>
                <input 
                    type="file" 
                    name="archivo" 
                    class="form-control"
                    accept=".xlsx, .xls" 
                    id="pedidos_excel"
                    required
                    onchange="autoSubmitForm()"
                >
                @error('archivo')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </form>
        <br>
        <form action="{{ route('cargarpedidos.articulos.store') }}" method="POST" enctype="multipart/form-data" id="articulosForm">
            @csrf
            <div class="mb-5">
                <label for="detail_excel" class="form-label"><strong>Cargar Pedidos con articulos:</strong></label>
                <input 
                    type="file" 
                    name="archivo" 
                    accept=".xlsx, .xls" 
                    class="form-control" 
                    id="detail_excel" 
                    required
                    onchange="autoSubmitArticulosForm()"
                >
                @error('archivo')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
        </form>
        <br>
        <div class="mb-5">
            <label class="form-label">Sincronizar Doctores - Pedidos:</label>
            <button class="btn btn-outline-primary" type="button" id="sincronizarBtn">
                <i class="fa fa-sync-alt"></i> Sincronizar
            </button>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            
        @endif
        @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
    </div>
</div>

<!-- Modal de Carga -->
<div class="modal fade" id="loadingModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div class="mb-4">
                    <div class="spinner-border text-primary mb-3" role="status" style="width: 4rem; height: 4rem;">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
                
                <h4 class="mb-3 text-primary">
                    <i class="fas fa-file-excel mr-2"></i>
                    Analizando archivo Excel
                </h4>
                
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                         role="progressbar" style="width: 100%"></div>
                </div>
                
                <p class="text-muted mb-3">
                    <i class="fas fa-search-plus mr-2"></i>
                    Comparando datos con la base de datos actual
                </p>
                
                <div class="row text-center">
                    <div class="col-4">
                        <i class="fas fa-plus-circle text-success fa-2x mb-2"></i>
                        <small class="d-block text-muted">Detectando<br>nuevos registros</small>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-edit text-warning fa-2x mb-2"></i>
                        <small class="d-block text-muted">Identificando<br>modificaciones</small>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-check-circle text-info fa-2x mb-2"></i>
                        <small class="d-block text-muted">Validando<br>formato</small>
                    </div>
                </div>
                
                <div class="mt-4">
                    <small class="text-info">
                        <i class="fas fa-clock mr-1"></i>
                        Este proceso puede tomar unos segundos dependiendo del tamaño del archivo
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Carga para Artículos -->
<div class="modal fade" id="loadingArticulosModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="loadingArticulosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <div class="mb-4">
                    <div class="spinner-border text-success mb-3" role="status" style="width: 4rem; height: 4rem;">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>
                
                <h4 class="mb-3 text-success">
                    <i class="fas fa-boxes mr-2"></i>
                    Analizando artículos del pedido
                </h4>
                
                <div class="progress mb-3" style="height: 8px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                         role="progressbar" style="width: 100%"></div>
                </div>
                
                <p class="text-muted mb-3">
                    <i class="fas fa-search-plus mr-2"></i>
                    Comparando artículos con pedidos existentes
                </p>
                
                <div class="row text-center">
                    <div class="col-6">
                        <i class="fas fa-plus-circle text-success fa-2x mb-2"></i>
                        <small class="d-block text-muted">Detectando<br>nuevos artículos</small>
                    </div>
                    <div class="col-6">
                        <i class="fas fa-exclamation-triangle text-warning fa-2x mb-2"></i>
                        <small class="d-block text-muted">Validando<br>pedidos existentes</small>
                    </div>
                </div>
                
                <div class="mt-4">
                    <small class="text-info">
                        <i class="fas fa-clock mr-1"></i>
                        Procesando detalles de artículos...
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- <form action="{{ route('cargarpedidos.store') }}" method="POST">
        @csrf
  
        <div class="mb-3">
            <label for="inputDetail" class="form-label"><strong>pedidos:</strong></label>
            <textarea
                class="form-control @error('detail') is-invalid @enderror" 
                style="height:150px" 
                id="message"
                name="message" 
                placeholder="Cargar texto de pedidos"></textarea>
            @error('message')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Cargar</button>
    </form>
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif -->

    
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script> 
        console.log("Hi, I'm using the Laravel-AdminLTE package!"); 
        
        function autoSubmitForm() {
            const fileInput = document.getElementById('pedidos_excel');
            const form = document.getElementById('pedidosForm');
            
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB
                
                // Validar tipo de archivo
                const allowedExtensions = ['xlsx', 'xls'];
                const fileExtension = fileName.split('.').pop().toLowerCase();
                
                if (!allowedExtensions.includes(fileExtension)) {
                    alert('Por favor selecciona un archivo Excel válido (.xlsx o .xls)');
                    fileInput.value = ''; // Clear the input
                    return;
                }
                
                // Validar tamaño (máximo 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('El archivo es demasiado grande. El tamaño máximo permitido es 10MB.');
                    fileInput.value = ''; // Clear the input
                    return;
                }
                
                // Mostrar información del archivo
                console.log(`Archivo seleccionado: ${fileName} (${fileSize} MB)`);
                
                // Mostrar modal de carga
                showLoadingModal();
                
                // Enviar formulario automáticamente
                form.submit();
            }
        }
        
        function autoSubmitArticulosForm() {
            const fileInput = document.getElementById('detail_excel');
            const form = document.getElementById('articulosForm');
            
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Size in MB
                
                // Validar tipo de archivo
                const allowedExtensions = ['xlsx', 'xls'];
                const fileExtension = fileName.split('.').pop().toLowerCase();
                
                if (!allowedExtensions.includes(fileExtension)) {
                    alert('Por favor selecciona un archivo Excel válido (.xlsx o .xls)');
                    fileInput.value = ''; // Clear the input
                    return;
                }
                
                // Validar tamaño (máximo 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('El archivo es demasiado grande. El tamaño máximo permitido es 10MB.');
                    fileInput.value = ''; // Clear the input
                    return;
                }
                
                // Mostrar información del archivo
                console.log(`Archivo de artículos seleccionado: ${fileName} (${fileSize} MB)`);
                
                // Mostrar modal de carga para artículos
                showLoadingArticulosModal();
                
                // Enviar formulario automáticamente
                form.submit();
            }
        }
        
        function showLoadingModal() {
            $('#loadingModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#loadingModal').modal('show');
            
            // Agregar efecto de pulso al spinner
            const spinner = document.querySelector('#loadingModal .spinner-border');
            if (spinner) {
                spinner.style.animation = 'spin 1s linear infinite, pulse 2s ease-in-out infinite alternate';
            }
        }
        
        function showLoadingArticulosModal() {
            $('#loadingArticulosModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#loadingArticulosModal').modal('show');
            
            // Agregar efecto de pulso al spinner
            const spinner = document.querySelector('#loadingArticulosModal .spinner-border');
            if (spinner) {
                spinner.style.animation = 'spin 1s linear infinite, pulse 2s ease-in-out infinite alternate';
            }
        }
        
        // Si hay errores, ocultar los modales
        $(document).ready(function() {
            @if(session('danger') || session('warning') || $errors->any())
                if ($('#loadingModal').hasClass('show')) {
                    $('#loadingModal').modal('hide');
                }
                if ($('#loadingArticulosModal').hasClass('show')) {
                    $('#loadingArticulosModal').modal('hide');
                }
            @endif
            
            // Manejar clic en botón de sincronización
            $('#sincronizarBtn').on('click', function() {
                sincronizarDoctoresPedidos();
            });
        });
        
        function sincronizarDoctoresPedidos() {
            // Mostrar SweetAlert de carga
            Swal.fire({
                title: 'Sincronizando',
                html: `
                    <div class="d-flex flex-column align-items-center">
                        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                            <span class="sr-only">Sincronizando...</span>
                        </div>
                        <h5 class="mb-3">
                            <i class="fas fa-user-md mr-2"></i>
                            Sincronizando doctores con pedidos
                        </h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-search mr-1"></i>
                            Comparando nombres de doctores...
                        </p>
                        <p class="text-info">
                            <i class="fas fa-clock mr-1"></i>
                            Este proceso puede tomar unos segundos
                        </p>
                    </div>
                `,
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'swal2-lg'
                }
            });
            
            // Realizar petición AJAX
            $.ajax({
                url: '{{ route("pedidos.sincronizar") }}',
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.close();
                    
                    if (response.success) {
                        let icon = 'success';
                        let title = '¡Sincronización Exitosa!';
                        
                        if (response.type === 'warning') {
                            icon = 'warning';
                            title = 'Sincronización Completada con Advertencias';
                        } else if (response.type === 'info') {
                            icon = 'info';
                            title = 'Información';
                        }
                        
                        let htmlContent = `
                            <div class="text-left">
                                <p class="mb-3">${response.message}</p>
                        `;
                        
                        if (response.data && response.data.procesados > 0) {
                            htmlContent += `
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="card border-primary">
                                            <div class="card-body py-2">
                                                <h4 class="text-primary mb-1">${response.data.procesados}</h4>
                                                <small class="text-muted">Procesados</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card border-success">
                                            <div class="card-body py-2">
                                                <h4 class="text-success mb-1">${response.data.sincronizados}</h4>
                                                <small class="text-muted">Sincronizados</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card border-warning">
                                            <div class="card-body py-2">
                                                <h4 class="text-warning mb-1">${response.data.no_encontrados}</h4>
                                                <small class="text-muted">No encontrados</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                        
                        htmlContent += '</div>';
                        
                        Swal.fire({
                            icon: icon,
                            title: title,
                            html: htmlContent,
                            confirmButtonText: 'Aceptar',
                            customClass: {
                                popup: 'swal2-lg'
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en la Sincronización',
                            text: response.message || 'Ocurrió un error durante la sincronización.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    
                    let errorMessage = 'Error de conexión durante la sincronización.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: errorMessage,
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    </script>
    
    <style>
        @keyframes pulse {
            0% { 
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0.7);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(0, 123, 255, 0.2);
                transform: scale(1.05);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
                transform: scale(1);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .spinner-border {
            border-width: 0.3em;
            animation: spin 1s linear infinite, pulse 2s ease-in-out infinite alternate;
        }
        
        #loadingModal .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }
        
        #loadingModal .modal-body {
            padding: 3rem 2rem;
            animation: fadeInUp 0.5s ease-out;
        }
        
        #loadingModal .progress {
            border-radius: 10px;
            background-color: rgba(0, 123, 255, 0.1);
        }
        
        #loadingModal .progress-bar {
            border-radius: 10px;
        }
        
        #loadingModal .fa-2x {
            transition: all 0.3s ease;
        }
        
        #loadingModal .fa-2x:hover {
            transform: scale(1.1);
        }
        
        /* Animación de entrada del modal */
        #loadingModal.fade .modal-dialog {
            transform: scale(0.8) translateY(-50px);
            transition: all 0.3s ease;
        }
        
        #loadingModal.show .modal-dialog {
            transform: scale(1) translateY(0);
        }
    </style>
@stop