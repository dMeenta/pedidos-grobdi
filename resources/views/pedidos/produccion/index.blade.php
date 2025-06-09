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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nro</th>
                                    <th>Presentacion</th>
                                    <th>Articulo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Actualizar</th>
                                </tr>    
                            </thead>
                            <tbody>
                                @foreach ($detallepedidos as $detalle)
                                <tr>
                                    <td>{{ $detalle->id }}</td>
                                    <td>{{ $detalle->pedido->orderId }}</td>
                                    <td>{{ $detalle->pedido->nroOrder }}</td>
                                    <td>{{ $detalle->pedido->customerName }}</td>
                                    <td>{{ $detalle->bases }}</td>
                                    <td>{{ $detalle->articulo }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
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
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <canvas id="myCanvas" width="350" height="150" style="border:1px solid black;"></canvas><br>
                                            <button id="btn-limpiar" class="btn btn-warning mt-2">Limpiar</button>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="btn-guardar" class="btn btn-primary">Actualizar Estado</button>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    console.log(response.data)
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