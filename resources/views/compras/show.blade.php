@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
    <div class="container container-fluid">
        <div class="form-check mb-4">
            <h1 class="text-center"><a class="float-start text-secondary" title="Volver" href="{{ route('compras.index') }}">
            <i class="bi bi-arrow-left-circle"></i></a>
            Detalles de la compra</h1>
        </div>

                <div class="row">
                    <div class="col-md-6 ps-5">
                        <div class="card" style="border-radius: 10px;">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-info-circle me-2"></i> Información General</h5>
                </div>
                <div class="card-body">
                        <p><strong style="color:rgb(224, 61, 80);">N° de Compra:</strong> {{ $compra->id }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Fecha de Emisión:</strong> {{ $compra->fecha_emision->format('d/m/Y') }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Proveedor:</strong> {{ $compra->proveedor->razon_social }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Moneda:</strong> {{ $compra->moneda->nombre }} ({{ $compra->moneda->codigo_iso }})</p>
                        <p><strong style="color:rgb(224, 61, 80);">Condición de Pago:</strong> {{ $compra->condicion_pago }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">Referencia:</strong> {{ $compra->serie }} - {{ $compra->numero }}</p>
                        <p><strong style="color:rgb(224, 61, 80);">IGV:</strong> 
                            @if(!empty($compra->igv) && $compra->igv > 0)
                                <span class="badge text-bg-success">Sí</span>
                            @else
                                <span class="badge text-bg-secondary">No</span>
                            @endif
                        </p>
                        <p><strong style="color:rgb(224, 61, 80);">Total:</strong> {{ number_format($compra->precio_total, 2) }}</p>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Tu tabla con un ID para DataTables -->
                        <table id="tablaCompras" class="table table-bordered table-striped table-hover">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Articulo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>SubTotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compra->detalles as $detalle)
                                    <tr>
                                        <td>{{ ucfirst($detalle->lote->articulo->tipo ?? 'Sin tipo') }}</td>
                                        <td>{{ $detalle->lote->articulo->nombre ?? 'Sin nombre' }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>{{ number_format($detalle->precio, 2) }}</td>
                                        <td>{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#tablaCompras').DataTable({
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
@endsection
@section('plugins.Select2', true)
@section('plugins.Datatables', true)

