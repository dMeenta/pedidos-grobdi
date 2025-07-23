@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <h1 class="text-center mb-3">
        @if(request('es_caro') === '1')
            Insumos Caros
        @elseif(request('es_caro') === '0')
            Insumos No Caros
        @else
            Todos los Insumos
        @endif
    </h1>
    @include('messages')
    <div class="col-md-12 d-flex justify-content-end align-items-center">
        <form method="GET" action="{{ route('insumos.marcar-caro') }}" class="mb-0 d-inline-block">
            <div class="btn-group" role="group">
                <a href="{{ route('insumos.marcar-caro', ['es_caro' => 1]) }}"
                class="btn btn-sm {{ request()->es_caro == '1' ? 'btn-success' : 'btn-outline-success' }}">
                    Caros
                </a>
                <a href="{{ route('insumos.marcar-caro', ['es_caro' => 0]) }}"
                class="btn btn-sm {{ request()->es_caro === '0' ? 'btn-secondary' : 'btn-outline-secondary' }}">
                    No Caros
                </a>
                <a href="{{ route('insumos.marcar-caro') }}"
                class="btn btn-sm {{ request()->es_caro === null ? 'btn-dark' : 'btn-outline-dark' }}">
                    Todos
                </a>
            </div>
        </form>
    </div>

    <form method="POST" action="{{ route('insumos.actualizar-es-caro') }}">
        @csrf
        <button type="submit" class="btn btn_crear mb-2"><i class="fa fa-floppy-disk"></i>  Guardar Cambios</button>

        <table class="table table-bordered" id="table_muestras">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Precio <br> última Compra</th>
                    <th>Stock</th>
                    <th>Unidad de Medida</th>
                    <th>¿Es Caro?</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insumos as $index => $insumo)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="observaciones">{{ $insumo->articulo->nombre }}</td>
                        <td>
                            <p>S/{{ number_format($insumo->precio, 2) }}</p>
                            @if ($insumo->es_caro)
                                <span class="badge bg-danger">Insumo caro</span>
                            @endif
                        </td>
                        <td>S/ {{ $insumo->articulo->ultimaCompra?->precio ?? '--' }}</td>
                        <td>{{ $insumo->articulo->stock }}</td>
                        <td>{{ $insumo->unidadMedida->nombre_unidad_de_medida ?? '-' }}</td>
                        <td class="text-center">
                            <input type="hidden" name="insumos[{{ $insumo->id }}]" value="0">
                            <input type="checkbox" name="insumos[{{ $insumo->id }}]" value="1" {{ $insumo->es_caro ? 'checked' : '' }}>
                        </td>
                        <td>
                            <div class="w">
                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#detalleModalinsumo{{ $insumo->id }}" style="background-color: #17a2b8; border-color: #17a2b8; color: white;">
                                    <i class="fa fa-eye"></i> Ver
                                </button>
                                @include('cotizador.administracion.insumo.show', ['item' => $insumo])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
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