@extends('adminlte::page')

@section('title', 'Ventas por Clientes')

@section('content_header')
    <h1>Reporte de Ventas por clientes</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Seleccione Fecha</label>
                    <form method="GET" action="{{ route('pedidosxcliente.listar') }}">
                        <label>Desde: <input class="form-control" type="date" name="desde" value="{{ request('desde') }}"></label>
                        <label>Hasta: <input class="form-control" type="date" name="hasta" value="{{ request('hasta') }}"></label>
                        <button class="btn btn-primary" type="submit">Filtrar</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Telefono</th>
                                    <th>producto</th>
                                    <th>Cantidad</th>
                                    <th>ultima Compra</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($resultados as $item)
                                    <tr>
                                        <td>{{ $item->customerName }}</td>
                                        <td>{{ $item->customerNumber }}</td>
                                        <td>{{ $item->articulo }}</td>
                                        <td>{{ $item->total_comprado }}</td>
                                        <td>{{ $item->ultima_compra }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No hay resultados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script>
        $(document).ready(function() {
            $('table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                }
            });
        });
    </script>
    
@stop