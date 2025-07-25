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
                                        <td colspan="5">No hay resultados</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                },
                pageLength: 25,
                lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"] ],
                dom: '<"row mb-3"<"col-md-6"l><"col-md-6"Bf>>' +
                '<"row"<"col-md-12"tr>>' +
                '<"row mt-3"<"col-md-5"i><"col-md-7"p>>',
                buttons: [
                {
                    extend: 'copyHtml5',
                    text: 'Copiar',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'btn btn-danger',
                    orientation: 'landscape',
                    pageSize: 'A4'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-primary'
                }
            ]
            });
        
        });
    </script>
    
@stop