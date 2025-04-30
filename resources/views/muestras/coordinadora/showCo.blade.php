@extends('adminlte::page')

@section('title', 'Datos de la Muestra')

@section('content_header')
@stop

@section('content')
<div class="container mt-2" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
    <div class="d-flex align-items-center mb-3">
        <a class="btn me-3" title="Volver" href="{{ route('muestras.aprobacion.coordinadora') }}" style="color:#6c757d; font-size: 2.3rem;">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <h1 class="flex-grow-1 text-center" style="color: #fe495f; font-weight: bold; margin: 0;">
            Datos de la Muestra
        </h1>
    </div>

    <!-- Card de Información General -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card" style="border-radius: 10px;">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-info-circle" style="margin-right: 6px;"></i> Información General</h5>
                </div>
                <div class="card-body">
                    <p><strong style="color:rgb(224, 61, 80);">Nombre de la muestra:</strong> {{ $muestra->nombre_muestra }}</p>
                    <p><strong style="color:rgb(224, 61, 80);">Clasificación:</strong>
                        {{ $muestra->clasificacion ? $muestra->clasificacion->nombre_clasificacion : 'No disponible' }}
                    </p>
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

        <!-- Card de Estado y Fechas -->
        <div class="col-md-6 mb-4">
            <div class="card" style="border-radius: 10px;">
                <div class="card-header" style="background-color: #fe495f; color: white;">
                    <h5><i class="bi bi-clock-history" style="margin-right: 6px;"></i> Estado y Fechas</h5>
                </div>
                <div class="card-body">
                    <p><strong style="color:rgb(224, 61, 80);">Aprobado por Jefe Comercial:</strong>
                        <span class="badge"
                              style="background-color: {{ $muestra->aprobado_jefe_comercial ? 'green' : ($muestra->aprobado_coordinadora ? 'yellow' : 'red') }};
                                     color: {{ ($muestra->aprobado_jefe_comercial == false && $muestra->aprobado_coordinadora == false) || $muestra->aprobado_jefe_comercial ? 'white' : 'black' }};
                                     padding: 10px;">
                            {{ $muestra->aprobado_jefe_comercial ? 'Aprobado' : 'Pendiente' }}
                        </span>
                    </p>

                    <p><strong style="color:rgb(224, 61, 80);">Aprobado por Coordinadora:</strong>
                        <span class="badge"
                              style="background-color: {{ $muestra->aprobado_coordinadora ? 'green' : ($muestra->aprobado_jefe_comercial ? 'yellow' : 'red') }};
                                     color: {{ ($muestra->aprobado_coordinadora == false && $muestra->aprobado_jefe_comercial == false) || $muestra->aprobado_coordinadora ? 'white' : 'black' }};
                                     padding: 10px;">
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
                           readonly style="background-color:rgb(251, 215, 255); color: #555; border: 2px solid #ccc; font-weight: bold;">

                    <p><strong style="color:rgb(224, 61, 80);">Fecha y Hora de Entrega:</strong></p>
                    <input type="text" class="form-control"
                           value="{{ $muestra->fecha_hora_entrega ? \Carbon\Carbon::parse($muestra->fecha_hora_entrega)->format('Y-m-d H:i') : 'Aún no se asigna fecha de entrega' }}"
                           readonly style="background-color:rgb(223, 191, 255); color: #555; border: 2px solid #ccc; font-weight: bold;">
                </div>
                <div class="card-footer">
                    <strong style="color:rgb(224, 61, 80);">Comentario de Laboratorio:</strong>
                    <span>{{ $muestra->comentarios ?? 'No hay comentarios' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-title {
            font-size: 1.3rem;
            color: #fe495f;
            font-weight: bold;
        }

        .card-body {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
        }

        .card-header {
            background-color: #fe495f;
            color: white;
            font-size: 1.2rem;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }

        .btn:hover {
            transform: scale(1.10);
            transition: transform 0.4s ease;
        }
    </style>
@stop

@section('js')
    <script> console.log('Datos de la muestra cargados'); </script>
@stop
