@extends('adminlte::page')

@section('title', 'Editar Muestra')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="container">
    <h1 class="text-center position-relative">
        <a class="position-absolute text-secondary" style="left: 0;" title="Volver" href="{{ route('muestras.aprobacion.coordinadora') }}">
            <i class="fas fa-arrow-left"></i>
        </a>
        Registrar muestra
        <hr>
    </h1>

    <form action="{{ route('muestras.updateCO', $muestra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <!-- Campo para el nombre de la muestra -->
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Nombre de la Muestra</label>
                <input type="text" name="nombre_muestra" class="form-control" required value="{{ $muestra->nombre_muestra }}" />
                @if($errors->has('nombre_muestra'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('nombre_muestra') }}</div>
                @endif
            </div>
        </div>

        <!-- FOTO CON MODAL -->
        <div class="form-group">
            <label for="foto">Foto de la muestra (opcional)</label>
            <div class="d-flex align-items-center">
                <div class="custom-file" style="max-width: 80%;">
                    <input type="file" name="foto" id="foto" class="custom-file-input" accept="image/*">
                    <label class="custom-file-label" for="foto">Selecciona una imagen</label>
                </div>
                @if($muestra->foto)
                    <button type="button" class="btn" style="background-color: #fe495f; color: white; border-radius: 5px; margin-left:6px;" data-toggle="modal" data-target="#fotoModal">
                        <i class="fas fa-eye"></i> Ver Foto
                    </button>
                @endif
                @if($errors->has('foto'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('foto') }}</div>
                @endif
            </div>
        </div>

        <!-- Modal para mostrar la foto ampliada -->
        <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Foto de la Muestra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset($muestra->foto) }}" alt="Foto de la muestra" style="max-width: 100%; max-height: 500px; border-radius: 10px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Clasificación -->
        <div class="form-group">
            <label>Clasificación</label>
            <select name="clasificacion_id" id="clasificacion_id" class="form-control" required>
                <option value="">Seleccione una clasificación</option>
                @foreach ($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->id }}" 
                        {{ $clasificacion->id == $muestra->clasificacion_id ? 'selected' : '' }}>
                        {{ $clasificacion->nombre_clasificacion }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Unidad de medida -->
        <div class="form-group">
            <label>Unidad de Medida</label>
            <input type="text" name="unidad_de_medida" id="unidad_de_medida" class="form-control" readonly required
                value="{{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida ?? '' }}">
        </div>

        <!-- Nombre del doctor -->
        <div class="form-group">
            <label for="name_doctor">Nombre del doctor</label>
            <input type="text" id="name_doctor" name="name_doctor" class="form-control" value="{{ $muestra->name_doctor }}" required />
        </div>

        <!-- Tipo de muestra -->
        <div class="form-group">
            <label>Tipo de Muestra</label>
            <select name="tipo_muestra" class="form-control" required>
                <option value="frasco original" {{ trim(strtolower($muestra->tipo_muestra)) === 'frasco original' ? 'selected' : '' }}>Frasco Original</option>
                <option value="frasco muestra" {{ trim(strtolower($muestra->tipo_muestra)) === 'frasco muestra' ? 'selected' : '' }}>Frasco Muestra</option>
            </select>
        </div>

        <!-- Cantidad de muestra -->
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Cantidad de Muestras</label>
                <input type="number" id="cantidad_de_muestra" name="cantidad_de_muestra" class="form-control" required value="{{ $muestra->cantidad_de_muestra }}" min="1" />
                @if($errors->has('cantidad_de_muestra'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('cantidad_de_muestra') }}</div>
                @endif
            </div>
        </div>

        <!-- Observaciones -->
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Observaciones</label>
                <textarea name="observacion" class="form-control" rows="3">{{ $muestra->observacion }}</textarea>
            </div>
        </div>

        <!-- Botón -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn_add"><i class="fas fa-edit"></i>
                Actualizar Muestra
            </button>
        </div>
    </form>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">
    <style>
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            background-color: #fe495f;
            color: white;
        }
    </style>
@stop

@section('js')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const clasificacionSelect = document.getElementById('clasificacion_id');
        const unidadMedidaInput = document.getElementById('unidad_de_medida');
        
        // Cargar las unidades de medida en las opciones del select
        const clasificaciones = {!! json_encode($clasificaciones->mapWithKeys(function ($item) {
            return [$item->id => $item->unidadMedida->nombre_unidad_de_medida ?? ''];
        })) !!};
        
        clasificacionSelect.addEventListener('change', function() {
            const clasificacionId = this.value;
            unidadMedidaInput.value = clasificaciones[clasificacionId] || '';
        });
    });
    document.querySelector('.custom-file-input').addEventListener('change', function (e){ 
        var fileName = document.getElementById("foto").files[0].name;
        var nextSibling = e.target.nextElementSibling
        nextSibling.innerText = fileName
    });
</script>
@stop