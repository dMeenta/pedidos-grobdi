@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
    <div class="container">
     @include('messages')

        <div class="form-check mb-3">
            <h1 class="text-center mb-2">
                {{ request('estado') == 'inactivo' ? 'Útiles Inactivos' : 'Útiles' }}
            </h1>
        </div>
        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <button type="button" class="btn btn_crear" data-toggle="modal" data-target="#crearUtilModal">
                    <i class="fas fa-square-plus"></i> Crear Útiles
                </button>
            </div>
                @include('cotizador.util.create')

            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <form method="GET" action="{{ route('util.index') }}" class="mb-0" id="filterForm">
                    <div class="btn-group" role="group">
                        <a href="{{ route('util.index') }}" 
                        class="btn btn-sm {{ request()->estado != 'inactivo' ? 'btn_crear' : 'btn_crear' }}">
                            Activos
                        </a>
                        <a href="{{ route('util.index', ['estado' => 'inactivo']) }}" 
                        class="btn btn-sm {{ request()->estado == 'inactivo' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            Inactivos
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered table-responsive table-hover" id="table_muestras">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Precio <br> Unitario</th>
                    <th>Precio de <br> última compra</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utiles as $index => $util)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="observaciones">{{ $util->articulo->nombre ?? 'Sin nombre' }}</td>
                        <td>{{ $util->precio ?? 'Sin precio' }}</td>
                        <td> S/ {{ $util->ultimoLote?->precio ?? '--' }}</td>
                        <td>{{ $util->articulo->stock }}</td>
                        <td>
                            <div class="w">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar{{ $util->articulo_id }}">
                                    <i class="fa fa-pen"></i> Editar
                                </button>
                                @include('cotizador.util.edit', ['item' => $util])

                                <form action="{{ route('util.destroy', $util->articulo_id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas marcarlo como inactivo?')" >
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545;" title="Eliminar"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
  
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#table_muestras').DataTable({
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