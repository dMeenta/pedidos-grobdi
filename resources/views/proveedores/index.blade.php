@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
     @include('messages')
    <h1 class="text-center">
        {{  request('estado') === 'inactivo' ? 'Proveedores Inactivos' : 'Proveedores' }} <i class="fas fa-truck-moving"></i>
    </h1>
    <div class="row mb-1 align-items-center">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <a href="{{ route('proveedores.create') }}" class="btn btn_crear"><i class="fas fa-plus-square"></i>  Nuevo Proveedor</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <form method="GET" action="{{ route('proveedores.index') }}" class="form-inline" id="filterForm">
                    <div class="btn-group" role="group">
                        <a href="{{ route('proveedores.index', ['estado' => 'activo']) }}" 
                        class="btn btn-sm {{ $estado != 'inactivo' ? 'btn_crear' : 'btn_crear' }}">
                            Activos
                        </a>
                        <a href="{{ route('proveedores.index', ['estado' => 'inactivo']) }}" 
                        class="btn btn-sm {{ $estado == 'inactivo' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            Inactivos
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped table-responsive" id="proveedor">
        <thead>
            <tr>
                <th>Razón Social</th>
                <th>RUC</th>
                <th>Teléfono</th>
                <th>Correo CPE</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
            <tr>
                <td class="observaciones">{{ $proveedor->razon_social }}</td>
                <td>{{ $proveedor->ruc }}</td>
                <td>{{ $proveedor->telefono_1 }}</td>
                <td>{{ $proveedor->correo_cpe }}</td>
                <td>
                    <span class="badge bg-{{ $proveedor->estado == 'activo' ? 'success' : 'secondary' }}">
                        {{ ucfirst($proveedor->estado) }}
                    </span>
                </td>
                <td>
                    <div class="w">
                        <button class="btn btn-sm" style="background-color: #17a2b8; color: white;" 
                                data-toggle="modal" data-target="#ProveedorModal{{ $proveedor->id }}">
                            <i class="fa fa-eye"></i> Ver
                        </button>
                    @include('proveedores.show', ['proveedor' => $proveedor])

                        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-pen"></i> Editar
                        </a>
                        <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('proveedores.show')
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#proveedor').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    ordering: false,
                    responsive: true,
                    // quitamos "l" del DOM para eliminar el selector de cantidad de registros
                    dom: '<"row"<"col-sm-12 col-md-12"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    pageLength: 10,
                    initComplete: function() {
                        $('.dataTables_filter')
                            .addClass('mb-3')
                            .find('input')
                            .attr('placeholder', 'Buscar datos en la tabla') // <- aquí el placeholder
                            .end()
                            .find('label')
                            .contents().filter(function() {
                                return this.nodeType === 3;
                            }).remove()
                            .end()
                            .prepend('Buscar:');
                    }
                });
            });
    </script>
@stop
