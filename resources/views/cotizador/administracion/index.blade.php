@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
     @include('messages')

    <h1 class="text-center mb-2">
        {{ request('estado') == 'inactivo' ? 'Inactivos' : 'Materia Prima' }}
    </h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="row mb-3 align-items-center">
        <div class="col-md-6">
            <a href="{{ route('insumo_empaque.create') }}" class="btn btn_crear">
                <i class="fas fa-plus"></i> Nueva Materia Prima
            </a>
        </div> 

        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <form method="GET" action="{{ route('insumo_empaque.index') }}" class="form-inline" id="filterForm">
                    <div class="btn-group" role="group">
                        <a href="{{ route('insumo_empaque.index') }}" 
                        class="btn btn-sm {{ request()->estado != 'inactivo' ? 'btn_crear' : 'btn_crear' }}">
                            Activos
                        </a>
                        <a href="{{ route('insumo_empaque.index', ['estado' => 'inactivo']) }}" 
                        class="btn btn-sm {{ request()->estado == 'inactivo' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                            Inactivos
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-responsive table-hover" id="table_muestras">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Precio de <br>última compra</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($insumos as $item)
                <tr>
                    <td>Insumo</td>
                    <td class="observaciones">{{ $item->articulo->nombre }}</td>
                    <td><p>S/ {{ $item->precio }}</p>
                         @if ($item->es_caro)
                             <span class="badge bg-danger">Insumo caro</span>
                         @endif
                    </td>
                    <td> S/ {{ $item->ultimoLote?->precio ?? '--' }}</td>
                    <td>{{ $item->articulo->stock }}</td>
                     <td>
                            <div class="w">
                                <button type="button" class="btn btn-info btn-sm"
                                        style="background-color: #17a2b8; border-color: #17a2b8; color: white;"
                                        data-toggle="modal"
                                        data-target="#detalleModalinsumo{{ $item->id }}">
                                    <i class="fa fa-eye"></i> Ver
                                </button>
                                @include('cotizador.administracion.show', ['item' => $item, 'tipo' => 'insumo'])
                                <a href="{{ route('insumo_empaque.edit', $item->id) }}?tipo=insumo" class="btn btn-warning btn-sm" style="background-color: #ffc107; border-color: #ffc107; color: white;"><i class="fa fa-pen"></i>Editar</a>
                                <form action="{{ route('insumo_empaque.destroy', $item->id) }}?tipo=insumo" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este ítem?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                                </form>
                            </div>
                        </td>
                </tr>
            @endforeach

            @foreach ($empaques as $item)
                <tr>
                    <td>{{ ucfirst($item->tipo) }}</td>
                    <td class="observaciones">{{ $item->articulo->nombre }}</td>
                    <td>S/ {{ $item->precio }}</td>
                    <td>S/ {{ $item->ultimoLote?->precio ?? '--' }}</td>
                    <td>{{ $item->articulo->stock }}</td>
                    <td>
                        <div class="w">
                            <button type="button" class="btn btn-info btn-sm"
                                    style="background-color: #17a2b8; border-color: #17a2b8; color: white;"
                                    data-toggle="modal"
                                    data-target="#detalleModal{{ $item->tipo }}{{ $item->id }}">
                                <i class="fa fa-eye"></i> Ver
                            </button>
                            @include('cotizador.administracion.show', ['item' => $item, 'tipo' => $item->tipo])
                            <a href="{{ route('insumo_empaque.edit', $item->id) }}?tipo={{ $item->tipo }}" class="btn btn-warning btn-sm" style="background-color: #ffc107; border-color: #ffc107; color: white;"><i class="fa fa-pen"></i>  Editar</a>
                            <form action="{{ route('insumo_empaque.destroy', $item->id) }}?tipo={{ $item->tipo }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas eliminar este ítem?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                Eliminar</button>
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
                            .attr('placeholder', 'Buscar datos en la tabla')
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

