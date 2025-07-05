@extends('adminlte::page')

@section('title', 'Detalles del Pedido')

@section('content_header')
    <h1>Órdenes de Producción</h1>
@stop

@section('content')
    <p>Bienvenidos</p>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Detalles de Pedidos del día {{ date('d/m/Y') }}</label>
                </div>
                <div class="card-body">
                    <form action="{{ route('pedidosLaboratorio.detalles') }}" method="GET">
                        <div class="row">
                            <label class="col-sm-1">Filtrar: </label>
                            <input type="date" name="fecha_produccion" class="form-control col-sm-2" value="{{ Request::get('fecha_produccion') }}">
                            <div class="col-sm-2">
                                <select class="form-control" name="presentacion">
                                    <option value="">Todos</option>
                                    @foreach ($presentacion_farmaceutica as $presentacion)
                                        <option value="{{ $presentacion->name }}" {{ Request::get('presentacion') == $presentacion->name ? 'selected' : '' }}>{{ $presentacion->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary col-sm-1" type="submit"><i class="fa fa-filter"></i> Filtrar</button>
                            <button onclick="location.reload()" type="button" class="btn btn-outline-success col-sm-2 offset-sm-4">
                                <i class="fas fa-sync-alt"></i> Recargar página
                            </button>
                        </div>
                    </form>
                    <br>

                    <div class="table-responsive">
                        <!-- FORMULARIO PRINCIPAL -->
                        <form method="POST" action="{{ route('pedidosLaboratorio.asignarmultipletecnico') }}" id="form-asignar-multiple">
                            @csrf
                            <div class="mb-3 row">
                                <div class="col-3">
                                    <select class="form-control" name="usuario_produccion_id" id="usuario_produccion_id_general" required>
                                        <option value="" disabled selected>Seleccione un usuario</option>
                                        @foreach ($tecnicos_produccion as $tecnicos)
                                            <option value="{{ $tecnicos->id }}">{{ $tecnicos->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success" type="submit">Asignar</button>
                                </div>
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all"></th>
                                        <th>Id Soflin</th>
                                        <th>Nro Orden</th>
                                        <th>Cliente</th>
                                        <th>Presentación</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Est Prod</th>
                                        <th>Usuario</th>
                                        <th>Asignar</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallepedidos as $detalle)
                                    <tr>
                                        <td><input type="checkbox" name="detalle[]" value="{{ $detalle->id }}"></td>
                                        <td>{{ $detalle->pedido->orderId }}</td>
                                        <td>{{ $detalle->pedido->nroOrder }}</td>
                                        <td>{{ $detalle->pedido->customerName }}</td>
                                        <td>{{ $detalle->bases }}</td>
                                        <td>{{ $detalle->articulo }}</td>
                                        <td>{{ $detalle->cantidad }}</td>
                                        <td>
                                            @if ($detalle->estado_produccion)
                                                <span class="badge bg-success">Elaborado</span>
                                            @else
                                                <span class="badge bg-warning">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>{!! isset($detalle->usuario_produccion->name) ? $detalle->usuario_produccion->name : '<span style="color: red; font-weight: bold;">Sin Asignar</span>' !!}</td>
                                        <td><button class="btn btn-success" type="button" data-toggle="modal" data-target="#asignarprod_{{ $detalle->id }}"><i class="fa fa-user-plus"></i></button></td>
                                        <td><button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#detalle_{{ $detalle->id }}">Ver</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>

                    <!-- MODALES FUERA DEL FORMULARIO PRINCIPAL -->
                    @foreach ($detallepedidos as $detalle)
                        <!-- Modal Asignar -->
                        <div class="modal fade" id="asignarprod_{{ $detalle->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('pedidosLaboratorio.asignarTecnicoProd', $detalle->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Asignar técnico</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <select class="form-control" name="usuario_produccion_id">
                                                <option value="" disabled selected>Seleccione un usuario</option>
                                                @foreach ($tecnicos_produccion as $tecnicos)
                                                    <option value="{{ $tecnicos->id }}">{{ $tecnicos->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Detalles -->
                        <div class="modal fade" id="detalle_{{ $detalle->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detalles:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Principios Activos del Producto:</h5>
                                                <h4>{{ $detalle->articulo }}</h4>
                                                <div class="row">
                                                    <div class="col col-3"><label>Nombre</label></div>
                                                    <div class="col col-3"><label>Cantidad</label></div>
                                                    <div class="col col-3"><label>Unidad</label></div>
                                                    <div class="col col-3"><label>Resultado</label></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($detalle->ingredientes)
                                                        @foreach ($detalle->ingredientes as $ingredientes)
                                                            <div class="col col-3"><p>{{$ingredientes['nombre']}}</p></div>
                                                            <div class="col col-3"><p>{{$ingredientes['cantidad']}}</p></div>
                                                            <div class="col col-3"><p>{{$ingredientes['unidad']}}</p></div>
                                                            @if ($detalle->bases =="GOMITAS" or $detalle->bases =="CAPSULAS" or $detalle->bases =="PAPELILLOS")
                                                            <div class="col col-3"><p>{{$ingredientes['cantidad']*30* $detalle->cantidad }}</p></div>
                                                            @elseif($detalle->bases =="JARABE" or $detalle->bases =="POLVO")
                                                            <div class="col col-3"><p>{{$ingredientes['cantidad']*1/1}}</p></div>
                                                            @else
                                                            <div class="col col-3"><p>No pudimos obtener resultados</p></div>

                                                            @endif
                                                        @endforeach
                                                    
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Lista de bases</h5>
                                            </div>
                                            <div class="card-body">
                                                @if(isset($detalle->contenido))
                                                    @foreach($detalle->contenido as $bases)
                                                        <div class="ingredientes" id="ingredientes-{{ $bases->id }}">
                                                            <h4>{{ $bases->name }}</h4>
                                                            @if($bases->ingredientes->count())
                                                                <ul>
                                                                    @foreach($bases->ingredientes as $ingrediente)
                                                                        <li><label>{{ $ingrediente->name }}:</label> Cantidad: {{ $ingrediente->cantidad }} {{ $ingrediente->unidad_medida }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <p>No hay ingredientes para esta base.</p>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
@stop

@section('js')
<!-- jQuery + Toastr + DataTables -->
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
    // ✅ Inicializar DataTables
    $(document).ready(function () {
        $('.table').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
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
    // ✅ Seleccionar todos los checkboxes
    document.getElementById('select-all').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('input[name="detalle[]"]');
        checkboxes.forEach(cb => cb.checked = e.target.checked);
    });

    // ✅ Validación de modales (técnico requerido)
    document.querySelectorAll('.modal form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const select = form.querySelector('select[name="usuario_produccion_id"]');
            if (!select.value) {
                e.preventDefault();
                toastr.error('Debe seleccionar un técnico antes de guardar.');
            }
        });
    });

    // ✅ Validación del formulario principal (al menos una fila y técnico)
    document.getElementById('form-asignar-multiple').addEventListener('submit', function(e) {
        const tecnico = document.getElementById('usuario_produccion_id_general').value;
        const checks = document.querySelectorAll('input[name="detalle[]"]:checked');

        if (!tecnico) {
            e.preventDefault();
            toastr.error('Debe seleccionar un técnico para asignar.');
        } else if (checks.length === 0) {
            e.preventDefault();
            toastr.error('Debe seleccionar al menos un pedido.');
        }
    });

    // ✅ Mensajes Laravel -> Toast
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@stop
