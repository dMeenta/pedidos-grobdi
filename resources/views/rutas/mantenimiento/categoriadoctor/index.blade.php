@extends('adminlte::page')

@section('title', 'Categoria Medico')

@section('content_header')
    <h1>Categoría Doctor</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Registrar Nueva Categoría</button>
                </div>
                <div class="card-body">

                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Prioridad</th>
                                    <th>Monto</th>
                                    <th>Actualizar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoriadoctor as $categoria)
                                <tr>
                                    <td>{{ $categoria->name }}</td>
                                    <td>{{ $categoria->prioridad }}</td>
                                    <td>S/ {{ $categoria->monto }}</td>
                                    <td>
                                        <!-- Botón para abrir modal de edición -->
                                        <button class="btn btn-sm btn-warning" 
                                            data-toggle="modal" 
                                            data-target="#editModal{{ $categoria->id }}">
                                            Editar
                                        </button>
                                        <form action="{{ route('categoriadoctor.destroy', $categoria->id) }}" method="POST" class="d-inline form-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal de edición -->
                                <div class="modal fade" id="editModal{{ $categoria->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('categoriadoctor.update', $categoria->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Categoría</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="name" class="form-control mb-2" value="{{ $categoria->name }}" required>
                                                    <input type="number" name="prioridad" class="form-control mb-2" value="{{ $categoria->prioridad }}" required>
                                                    <input type="text" name="monto" class="form-control" value="{{ $categoria->monto }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Guardar</button>
                                                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de creación -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('categoriadoctor.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nombre" required>
                    <input type="number" name="prioridad" class="form-control mb-2" placeholder="Prioridad" required>
                    <input type="text" name="monto" class="form-control" placeholder="Monto" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Registrar</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script>
        @if(session('success'))
            Swal.fire({
                type: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        @if($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += `- {{ $error }}\n`;
            @endforeach

            Swal.fire({
                type: 'error',
                title: 'Errores de validación',
                text: errorMessages,
                confirmButtonText: 'Ok'
            });
        @endif
        // Confirmación antes de eliminar con SweetAlert2 v8
        $('.form-eliminar').submit(function (e) {
            e.preventDefault(); // Previene envío inmediato

            const form = this;

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });
    </script>
    
@stop