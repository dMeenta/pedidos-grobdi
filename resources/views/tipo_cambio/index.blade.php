@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <div class="form-check mb-3">
            <h1 class="text-center">
                <a class="float-start text-secondary" title="Volver" href="{{ route('tipo_cambio.resumen') }}">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                Tipo de Cambio
            </h1>
        </div>
    <div class="d-flex justify-content-end mb-3">
        <form method="GET" action="{{ route('tipo_cambio.index') }}" id="filtroForm" class="d-flex align-items-center gap-3">
            <label class="mb-0 d-flex align-items-center">
                <input type="checkbox" name="filtro_monedas[]" value="USD"
                    onchange="document.getElementById('filtroForm').submit()"
                    {{ in_array('USD', request()->get('filtro_monedas', [])) ? 'checked' : '' }}>
                <span style="margin-left: 6px;">USD</span>
            </label>

            <label class="mb-0 d-flex align-items-center">
                <input type="checkbox" name="filtro_monedas[]" value="PEN"
                    onchange="document.getElementById('filtroForm').submit()"
                    {{ in_array('PEN', request()->get('filtro_monedas', [])) ? 'checked' : '' }}>
                <span style="margin-left: 6px;">PEN</span>
            </label>
        </form>
    </div>

    <table class="table-bordered table-responsive" id="table_muestras">
        <thead>
            <tr>
                <th>N°</th>
                <th>Moneda</th>
                <th>Código ISO</th>
                <th>Valor de Cambio</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tiposCambio as $index => $tipoCambio)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tipoCambio->tipoMoneda->nombre }}</td>
                    <td>{{ $tipoCambio->tipoMoneda->codigo_iso }}</td>
                    <td>{{ number_format($tipoCambio->valor_cambio, 4) }}</td>
                    <td>{{ $tipoCambio->fecha }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay tipos de cambio registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

<!-- Bootstrap Icons (Bootstrap 5 oficial) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

<!-- Font Awesome (opcional, solo si lo usas) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Tus estilos personalizados -->
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />




 <style>
        .btn-sm {
        font-size: 1rem; 
        padding: 8px 14px; 
        border-radius: 8px;
        display: flex; 
        align-items: center; 
        }

        .btn-sm i {
            margin-right: 4px; /* Espaciado entre el icono y el texto */
        }
        .w {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        table thead th {
            background-color:rgb(224, 68, 86);
            color: white;
        }

        table tbody td {
            background-color: rgb(255, 249, 249);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-bordered {
            border-color: #fe495f;
        }
        table th, table td {
            text-align: center;
        }
        td {
            width: 1%;  
            white-space: nowrap; 
        }
    </style>
@stop  
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- DataTables CSS y JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>>



    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
        $(document).ready(function() {
            $('#table_muestras').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json',
                    },
                    ordering: false,
                    responsive: true,
                    // quitamos "l" del DOM para eliminar el selector de cantidad de registros
                    dom: 'rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    pageLength: 10,
                    initComplete: function() {
                        $('.dataTables_filter')
                            .addClass('mb-3')
                            .find('input')
                            .attr('placeholder', 'Buscar') // <- aquí el placeholder
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

