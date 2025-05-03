@extends('adminlte::page')

@section('title', 'Datos de la Muestra')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="container mt-2" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
    <div class="d-flex align-items-center mb-3">
        <a class="btn me-3" title="Volver" href="{{ route('muestras.estado') }}" style="color:#6c757d; font-size: 2.3rem;">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <h1 class="flex-grow-1 text-center" style="color: #fe495f; font-weight: bold; margin: 0;">
            Datos de la Muestra
        </h1>
    </div>

    <div class="row">
        <!-- Información General -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-info-circle me-2"></i>Información General</h5>
                </div>
                <div class="card-body">
                    <p><strong style="color:rgb(224, 61, 80);">Nombre de la muestra:</strong> {{ $muestra->nombre_muestra }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Clasificación:</strong> {{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'No disponible' }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Tipo de muestra:</strong> {{ $muestra->tipo_muestra }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Unidad de medida:</strong>
                        @if($muestra->clasificacion && $muestra->clasificacion->unidadMedida)
                            {{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida }}
                        @else
                            No asignada
                        @endif
                    </p>
                    <p><strong style="color:rgb(224, 61, 80);">Cantidad:</strong> {{ $muestra->cantidad_de_muestra }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Observaciones:</strong> {{ $muestra->observacion }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Doctor:</strong> {{ $muestra->name_doctor }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Creado por:</strong> {{ $muestra->creator ? $muestra->creator->name : 'Desconocido' }}</p>
                </div>
            </div>
        </div>

        <!-- Estado y Fechas -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-clock-history me-2"></i>Estado y Fechas</h5>
                </div>
                <div class="card-body">
                    <p><strong style="color:rgb(224, 61, 80);">Aprobado por Jefe Comercial:</strong>
                        <span class="badge" style="background-color: {{ $muestra->aprobado_jefe_comercial ? 'green' : ($muestra->aprobado_coordinadora ? 'yellow' : 'red') }}; color: {{ ($muestra->aprobado_jefe_comercial == false && $muestra->aprobado_coordinadora == false) || $muestra->aprobado_jefe_comercial ? 'white' : 'black' }}; padding: 10px;">
                            {{ $muestra->aprobado_jefe_comercial ? 'Aprobado' : 'Pendiente' }}
                        </span>
                    </p>

                    <p><strong style="color:rgb(224, 61, 80);">Aprobado por Coordinadora:</strong>
                        <span class="badge" style="background-color: {{ $muestra->aprobado_coordinadora ? 'green' : ($muestra->aprobado_jefe_comercial ? 'yellow' : 'red') }}; color: {{ ($muestra->aprobado_coordinadora == false && $muestra->aprobado_jefe_comercial == false) || $muestra->aprobado_coordinadora ? 'white' : 'black' }}; padding: 10px;">
                            {{ $muestra->aprobado_coordinadora ? 'Aprobado' : 'Pendiente' }}
                        </span>
                    </p>

                    <p><strong style="color:rgb(224, 61, 80);">Estado:</strong>
                        <span class="badge" style="background-color: {{ $muestra->estado == 'Pendiente' ? 'red' : 'green' }}; color: white; padding: 10px;">
                            {{ $muestra->estado }}
                        </span>
                    </p>

                    <p><strong style="color:rgb(224, 61, 80);">Fecha y Hora Recibida:</strong></p>
                    <input type="text" class="form-control mb-2"
                           value="{{ $muestra->updated_at ? \Carbon\Carbon::parse($muestra->updated_at)->format('Y-m-d H:i') : ($muestra->created_at ? \Carbon\Carbon::parse($muestra->created_at)->format('Y-m-d H:i') : 'No disponible') }}"
                           readonly style="background-color:rgb(251, 239, 252); color: #555; border: 2px solid #ccc; font-weight: bold;">

                    <p><strong style="color:rgb(224, 61, 80);">Fecha y Hora de Entrega:</strong></p>
                    <input type="text" class="form-control"
                           value="{{ $muestra->fecha_hora_entrega ? \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('Y-m-d H:i') : 'Aún no se asigna fecha de entrega' }}"
                           readonly style="background-color:rgb(244, 232, 255); color: #555; border: 2px solid #ccc; font-weight: bold;">
                </div>

                <!-- Foto -->
                <div class="card-footer">
                    <strong style="color:rgb(224, 61, 80);">Foto Receta:</strong>
                    @if($muestra->foto)
                        <button type="button" class="btn" style="background-color: #fe495f; color: white; border-radius: 5px;" data-bs-toggle="modal" data-bs-target="#fotoModal">
                            <i class="bi bi-eye"></i> Ver Foto
                        </button>
                    @else
                        <span>No hay foto disponible</span>
                    @endif
                </div>

                <!-- Modal Foto -->
                <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style="border-radius: 15px;">
                            <div class="modal-header" style="background-color: #fe495f; color: white;">
                                <h5 class="modal-title" id="fotoModalLabel">Foto de la Muestra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $muestra->foto) }}" alt="Foto de la muestra" style="max-width: 100%; max-height: 500px; border-radius: 10px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comentarios -->
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-chat-left-text me-2"></i>Comentario del Laboratorio</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('muestras.actualizarComentario', $muestra->id) }}">
                        @csrf
                        @method('PUT')
                        <textarea name="comentarios" id="comentarios" class="form-control" rows="5" placeholder="Escriba un comentario...">{{ old('comentarios', $muestra->comentarios) }}</textarea>
                        <button type="submit" class="btn mt-3" style="background-color: #fe495f; color: white;">Guardar Comentario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">
    <style>
    .card {
        border-radius: 10px;
        box-shadow: 0 0 12px rgba(0,0,0,0.05);
    }

    .card-header {
        font-weight: bold;
    }

    .btn:hover {
        transform: scale(1.10);
        transition: transform 0.3s ease;
    }
</style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop