@extends('adminlte::page')

@section('title', 'Producto Final')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
    <div class="container">
     @include('messages')

        <div class="form-check mb-3">
            <div class="form-check mb-6">
                <a class="float-start text-secondary" title="Volver" href="{{ route('bases.create') }}" style="position: absolute; left: 0; font-size: 2rem;">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-center">
                    {{ request('estado') == 'inactivo' ? 'Inactivos' : 'Producto Final' }}
                </h1>
            </div>
        </div>

    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <a href="{{ route('producto_final.create') }}" class="btn btn_crear">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>
        <div class="col-md-6 text-right">
            <form method="GET" action="{{ route('producto_final.index') }}" class="mb-0 d-inline-block" id="filterForm">
                <div class="btn-group" role="group">
                    <a href="{{ route('producto_final.index') }}" 
                    class="btn btn-sm {{ request()->estado != 'inactivo' ? 'btn_crear' : 'btn-outline-danger' }}">
                    Activos
                    </a>
                    <a href="{{ route('producto_final.index', ['estado' => 'inactivo']) }}" 
                    class="btn btn-sm {{ request()->estado == 'inactivo' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                    Inactivos
                    </a>
                </div>
            </form>
        </div>
    </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover" id="table_muestras">
                <thead class="table-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nombre</th>
                        <th>Clasificación</th>
                        <th>Volumen</th>
                        <th>Costo Producción</th>
                        <th>Costo Real</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $index => $producto)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="observaciones">{{ $producto->articulo->nombre }}</td>
                            <td>{{ $producto->volumen->clasificacion->nombre_clasificacion ?? 'N/A' }}</td>
                            <td>{{ $producto->volumen->nombre ?? ' -  ' }}{{ $producto->volumen->clasificacion->unidadMedida->nombre_unidad_de_medida ?? 'N/A' }}</td>
                            <td>S/ {{ number_format($producto->costo_total_produccion, 2) }}</td>
                            <td>S/ {{ number_format($producto->costo_total_real, 2) }}</td>
                            <td>
                                <div class="w">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detalleProductoModal{{ $producto->id }}" style="background-color: #17a2b8; border-color: #17a2b8; color: white;"><i class="fa fa-eye"></i>
                                    Ver</button>
                                    @include('cotizador.laboratorio.producto_final.show')
                                    <a href="{{ route('producto_final.edit', $producto->id) }}" class="btn btn-warning btn-sm" style="background-color: #ffc107; border-color: #ffc107; color: white;"><i class="fa fa-pen"></i>Editar</a>
                                    <form action="{{ route('producto_final.destroy', $producto->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545;" title="Eliminar" onclick="return confirm('¿Estás seguro?')"><i class="fa fa-trash"></i>Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay productos finales registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
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
                            .attr('placeholder', 'Buscar por nombre del insumo') // <- aquí el placeholder
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

