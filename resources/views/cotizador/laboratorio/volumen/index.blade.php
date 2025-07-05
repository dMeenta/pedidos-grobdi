@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
    <div class="container">
     @include('messages')

        <h1 class="text-center fw-bold">Lista de Volúmenes</h1>
            <button type="button" class="btn btn-outline btn_crear btn-sm mt-3" data-toggle="modal" data-target="#crearVolumenModal">
                <i class="fa fa-plus-circle mr-1"></i> Crear Volumen
            </button>
            @include('cotizador.laboratorio.volumen.create')
            @include('cotizador.laboratorio.volumen.edit')
        <table class="table table-bordered table-responsive" id="table_muestras">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Volumen</th>
                    <th>Clasificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($volumenes as $index=> $volumen)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $volumen->nombre }}</td>
                    <td>{{ $volumen->clasificacion->nombre_clasificacion ?? 'Sin clasificación' }}</td>
                    <td>
                        <div class="w">
                            <button type="button" class="btn btn-warning btn-sm" onclick="abrirModalEditar({{ $volumen }})">
                                <i class="fa fa-edit"></i> Editar
                            </button>
                            <form action="{{ route('volumen.destroy', $volumen->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar?')" class="btn btn-danger btn-sm" style="background-color: #dc3545; border-color: #dc3545;"><i class="fa-solid fa-trash"></i>Eliminar</button>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
                            .attr('placeholder', 'Buscar datos de la tabla') // <- aquí el placeholder
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
