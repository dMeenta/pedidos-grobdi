@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card">
    <div class="card-header text-bg-dark">
        <div class="d-flex justify-content-between align-items-end">
            <h2 class="mb-0">
                Pedido - Orden: {{ $pedido->orderId }} - Nro: {{ $pedido->nroOrder }}
            </h2>
            <a class="btn btn-danger" href="{{ route('pedidosmotorizado.index') }}"><i class="fas fa-door-open"></i>
                <span class="d-none d-md-inline">Salir</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form id="updateForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <ul class="list-group list-group-flush">
                <div class="list-group-item pb-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row fs-5">
                                <div class="col-12 col-sm-4">
                                    <label for="state" class="form-label">Estado del pedido:</label>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" id="stateReprogramado" required
                                            value="Reprogramado" {{ $pedido->deliveryStatus === 'Reprogramado' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="stateReprogramado">
                                            Reprogramado
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" id="stateEntregado" required
                                            value="Entregado" {{ $pedido->deliveryStatus === 'Entregado' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="stateEntregado">
                                            Entregado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item py-2">
                    <div class="row">
                        <div class="col-12">
                            <label>Foto del domicilio</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/*" type="file" capture="camera" name="fotoDomicilio" id="fotoDomicilio">
                                <label class="custom-file-label" for="fotoDomicilio">Subir foto de la llegada al domicilio</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item py-2">
                    <div class="row">
                        <div class="col-12">
                            <label>Foto del pedido entregado</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/*" type="file" capture="camera" name="fotoEntrega" id="fotoEntrega">
                                <label class=" custom-file-label" for="fotoEntrega">Subir foto de la recepción del pedido</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item py-2">
                    <div class="row">
                        <div class="mb-3">
                            <label for="inputDetail" class="form-label">Observaciones:</label>
                            <textarea
                                class="form-control"
                                style="height:150px"
                                id="inputDetail"
                                name="detailMotorizado"
                                placeholder="ingresar observaciones o detalles">{{ $pedido->detailMotorizado }}</textarea>
                        </div>
                    </div>
                </div>
            </ul>
            <div class="pb-2 px-3">
                <div class="row">
                    <button id="btn-submit" type="submit" class="btn btn-success w-full"><i class="fas fa-save"></i> Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>

@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style>
    img {
        display: block;
        margin: 20px auto;
        max-width: 90%;
    }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[name="state"]').on('change', function() {
            if ($('#stateReprogramado').is(':checked')) {
                $('label[for="fotoEntrega"]').text('No se requiere foto de entrega.');
                $('#fotoEntrega').prop('disabled', true).val('')
            } else {
                $('#fotoEntrega').prop('disabled', false)
                $('label[for="fotoEntrega"]').text('Subir foto de la recepción del pedido.');
            }
        })

        $('#fotoDomicilio, #fotoEntrega').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $(this).next('.custom-file-label').text(fileName);
            } else {
                $(this).next('.custom-file-label').text('Seleccionar archivo');
            }
        });
    })

    const btnSubmit = $('#btn-submit');

    $('#updateForm').on('submit', function(e) {
        e.preventDefault()
        btnSubmit.prop('disabled', true);

        let formData = new FormData(this);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                formData.append('latitude', position.coords.latitude);
                formData.append('longitude', position.coords.longitude);

                sendForm(formData);
            }, function(error) {
                toastr.error('No se pudo obtener la ubicación. Asegurate de habilitar los servicios de ubicación');
                btnSubmit.prop('disabled', false);
            });
        } else {
            toastr.error('La geolocalización no está disponible en tu navegador');
            btnSubmit.prop('disabled', false);
        }
    });

    function sendForm(formData) {
        $.ajax({
            url: "{{ route('pedidosmotorizado.updatePedidoByMotorizado', $pedido->id) }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (!response.success) {
                    toastr.error(response.message || 'Ocurrió un problema al actualizar el pedido');
                    btnSubmit.prop('disabled', false);
                }

                toastr.success(response.message || 'Pedido actualizado correctamente');
                btnSubmit.prop('disabled', false);
            },
            error: function(xhr) {
                let res = xhr.responseJSON;
                console.error(xhr)
                toastr.error(res?.message || 'Error inesperado al actualizar');
                btnSubmit.prop('disabled', false);
            }
        })
    };
</script>
@stop