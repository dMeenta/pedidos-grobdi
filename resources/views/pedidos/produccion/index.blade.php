@extends('adminlte::page')

@section('title', 'Dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content_header')
    <h1>Ordenes del día</h1>
@stop

@section('content')
    <p>Bienvenidos</p>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <label>Lista de productos a elaborar</label>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('produccion.index') }}">
                    <div class="row">
                        <label class="col-sm-1">Filtrar: </label>
                        <input type="date" name="fecha_produccion" class="form-control col-sm-2">
                        <button class="btn btn-primary col-sm-1" type="submit"><i class="fa fa-filter"></i>Filtrar</button>
                        <button onclick="location.reload()" class="btn btn-outline-success  col-sm-2 offset-sm-4">
                            <i class="fas fa-sync-alt"></i> Recarga pagina
                        </button>
                    </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nro</th>
                                    <th>Presentacion</th>
                                    <th>Articulo</th>
                                    <th>Cantidad</th>
                                    <th>Detalles</th>
                                    <th>Estado</th>
                                </tr>    
                            </thead>
                            <tbody>
                                @foreach ($detallepedidos as $detalle)
                                <tr>
                                    <td>{{ $detalle->pedido->orderId }}</td>
                                    <td>{{ $detalle->pedido->nroOrder }}</td>
                                    <td>{{ $detalle->bases }}</td>
                                    <td>{{ $detalle->articulo }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td><button class="btn btn-secondary" data-toggle="modal" data-target="#detalle_{{ $detalle->id }}">ver</button></td>
                                    @if ($detalle->estado_produccion)
                                        <td class="estado"><span class="badge bg-success">Completado</span></td>
                                    @else
                                    <!-- <td class="estado" data-id="{{ $detalle->id }}">
                                        <button class="btn btn-success btn-estado" data-id="{{ $detalle->id }}">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </td> -->
                                    <td class="estado" data-id="{{ $detalle->id }}">
                                        <button class="btn btn-success btn-abrir-modal" data-id="{{ $detalle->id }}">
                                            <i class="fa fa-check"></i> Actualizar
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modalPizarra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Realice su firma</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <canvas id="myCanvas" width="350" height="150" style="border:1px solid black;"></canvas><br>
                                            <button id="btn-limpiar" class="btn btn-warning mt-2">Limpiar</button>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn-guardar" class="btn btn-primary">Actualizar Estado</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Desgloze del producto -->
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        #myCanvas {
            border: 1px solid black;
            width: 100%;
            max-width: 500px;
            height: auto;
            touch-action: none; /* evita scroll al tocar canvas */
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        
        let canvas = document.getElementById('myCanvas');
        let ctx = canvas.getContext('2d');
        let isDrawing = false;
        let detalleId = null; // se actualizará al abrir el modal
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function getPosition(e) {
            const rect = canvas.getBoundingClientRect();
            let clientX, clientY;

            if (e.touches && e.touches.length > 0) {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            // Ajustar coordenadas a la escala del canvas
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;

            return {
                x: (clientX - rect.left) * scaleX,
                y: (clientY - rect.top) * scaleY
            };
        }
        // Eventos para mouse
        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            const pos = getPosition(e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
        });
        canvas.addEventListener('mouseup', () => {
            isDrawing = false;
            ctx.closePath();
        });
        canvas.addEventListener('mousemove', (e) => {
            if (!isDrawing) return;
            const pos = getPosition(e);
            ctx.lineTo(pos.x, pos.y);
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = 'black';
            ctx.stroke();
        });

        // Eventos para pantalla táctil
        canvas.addEventListener('touchstart', (e) => {
            e.preventDefault();
            isDrawing = true;
            const pos = getPosition(e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
        });
        canvas.addEventListener('touchend', (e) => {
            e.preventDefault();
            isDrawing = false;
            ctx.closePath();
        });
        canvas.addEventListener('touchmove', (e) => {
            e.preventDefault();
            if (!isDrawing) return;
            const pos = getPosition(e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        });
        // Limpiar pizarra
        $('#btn-limpiar').click(() => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        // Abrir modal y guardar ID
        $('.btn-abrir-modal').click(function () {
            detalleId = $(this).data('id');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            new bootstrap.Modal(document.getElementById('modalPizarra')).show();
        });
        // Guardar dibujo y actualizar estado
        $('#btn-guardar').click(function () {
            const imagenBase64 = canvas.toDataURL('image/png');

            $.ajax({
                url: `/pedidosproduccion/${detalleId}/actualizarestado`,
                method: 'POST',
                data: {
                    estado: 'completado',
                    imagen: imagenBase64,
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    if (response.success) {
                        const celda = $('td.estado[data-id="' + detalleId + '"]');
                        celda.html('<span class="badge bg-success">Completado</span>');
                        bootstrap.Modal.getInstance(document.getElementById('modalPizarra')).hide();
                    }
                },
                error: function () {
                    alert('Error al guardar.');
                }
            });
        });
    </script>
    
@stop