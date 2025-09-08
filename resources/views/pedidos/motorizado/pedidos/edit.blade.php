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
        <form id="updateForm">
            @csrf
            @method('PUT')
            <ul class="list-group list-group-flush">

                {{-- Foto del domicilio SIEMPRE PRIMERO --}}
                <div class="list-group-item py-2">
                    <div class="row">
                        <div class="col-12">
                            <label>Foto del domicilio</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/*" capture="camera"
                                    name="foto_domicilio" id="foto_domicilio" required>
                                <label class="custom-file-label" for="foto_domicilio">Subir foto de la llegada al domicilio</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Radios (deshabilitados hasta que haya foto de domicilio) --}}
                <div class="list-group-item pb-2" id="radios-wrapper" style="display:none;">
                    <div class="row fs-5">
                        <div class="col-12 col-sm-4">
                            <label for="state" class="form-label">Estado del pedido:</label>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="stateReprogramado"
                                    value="Reprogramado">
                                <label class="form-check-label" for="stateReprogramado">
                                    Reprogramado
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="stateEntregado"
                                    value="Entregado">
                                <label class="form-check-label" for="stateEntregado">
                                    Entregado
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Foto del pedido entregado (se muestra solo si Entregado) --}}
                <div class="list-group-item py-2" id="foto-entrega-wrapper" style="display:none;">
                    <div class="row">
                        <div class="col-12">
                            <label>Foto del pedido entregado</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/*" capture="camera"
                                    name="foto_entrega" id="foto_entrega">
                                <label class="custom-file-label" for="foto_entrega">Subir foto de la recepción del pedido</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="list-group-item py-2">
                    <div class="row">
                        <div class="mb-3">
                            <label for="inputDetail" class="form-label">Observaciones:</label>
                            <textarea class="form-control" style="height:150px" id="inputDetail"
                                name="detailMotorizado"
                                placeholder="ingresar observaciones o detalles">{{ $pedido->detailMotorizado }}</textarea>
                        </div>
                    </div>
                </div>
            </ul>

            <div class="pb-2 px-3">
                <div class="row">
                    <button id="btn-submit" type="submit" class="btn btn-success w-full" disabled>
                        <i class="fas fa-save"></i> Actualizar
                    </button>
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
    let photosData = {};
    const btnSubmit = $('#btn-submit');

    $(document).ready(function() {
        initGeolocation();

        async function getPhotoData(id, input) {
            let fileName = input.val().split('\\').pop();

            if (fileName) {
                input.next('.custom-file-label').text(fileName);

                const timestamp = getCurrentTimestamp();
                photosData['datetime_' + id] = timestamp;

                try {
                    let location = await getLocation();
                    photosData['lat_' + id] = location.latitude;
                    photosData['lng_' + id] = location.longitude;
                } catch (error) {
                    toastr.error("Error al obtener la ubicación: " + error.message);
                }
            } else {
                input.next('.custom-file-label').text('Tomar foto');
            }
        }

        $('#foto_domicilio').on('change', async function() {
            const input = $(this);
            await getPhotoData(input.attr('id'), input);
            $('#radios-wrapper').slideDown();
        });

        $('#foto_entrega').on('change', async function() {
            const input = $(this);
            await getPhotoData(input.attr('id'), input);
        });

        $('input[name="state"]').on('change', function() {
            if ($('#stateEntregado').is(':checked')) {
                $('#foto-entrega-wrapper').slideDown();
                $('#foto_entrega').prop('required', true);
            } else {
                $('#foto-entrega-wrapper').slideUp();
                $('#foto_entrega').prop('required', false).val('Subir foto de la recepción del pedido');
            }
            btnSubmit.prop('disabled', false);
        })


    })

    $('#updateForm').on('submit', async function(e) {
        e.preventDefault()
        btnSubmit.prop('disabled', true);

        let formData = new FormData(this);

        for (const [key, value] of Object.entries(photosData)) {
            formData.append(key, value);
        }

        await sendForm(formData);

        btnSubmit.prop('disabled', false);
    });

    async function initGeolocation() {
        try {
            let location = await getLocation();
        } catch (error) {
            toastr.error("Error al obtener ubicación: " + error.message);
        }
    }

    function getLocation() {
        return new Promise((resolve, reject) => {
            if (!navigator.geolocation) {
                reject(new Error("La geolocalización no está disponible en tu navegador"));
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    resolve({
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    });
                },
                (error) => reject(error), {
                    enableHighAccuracy: true
                }
            );
        });
    }

    function getCurrentTimestamp() {
        let now = new Date();
        return now.getFullYear() + '-' +
            String(now.getMonth() + 1).padStart(2, '0') + '-' +
            String(now.getDate()).padStart(2, '0') + ' ' +
            String(now.getHours()).padStart(2, '0') + ':' +
            String(now.getMinutes()).padStart(2, '0') + ':' +
            String(now.getSeconds()).padStart(2, '0');
    }

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
                setTimeout(() => {
                    window.location.href = "{{ route('pedidosmotorizado.index') }}";
                }, 1000);
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