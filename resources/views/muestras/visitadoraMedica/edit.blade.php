@extends('adminlte::page')

@section('title', 'Editar Muestra')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="container">
    <h1 class="text-center">
        <a class="float-left text-secondary" title="Volver" href="{{ route('muestras.index') }}">
            <i class="fas fa-arrow-left"></i>
        </a>
        Editar Muestra
        <hr>
    </h1>

    <form action="{{ route('muestras.update', $muestra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Nombre de la Muestra</label>
                <input type="text" name="nombre_muestra" class="form-control" required value="{{ $muestra->nombre_muestra }}">
            </div>
        </div>

        <!-- FOTO CON MODAL -->
        <div class="form-group">
            <label for="foto" class="form-label">Foto de la muestra <small class="text-muted">(opcional)</small></label>
            <div class="d-flex align-items-center">
                <div class="custom-file mr-2" style="width: 80%;">
                    <input type="file" class="custom-file-input" name="foto" id="foto" accept="image/*">
                    <label class="custom-file-label" for="foto">Seleccionar imagen</label>
                </div>
                @if($muestra->foto)
                    <button type="button" class="btn" style="background-color: #fe495f; color: white; border-radius: 5px;" data-toggle="modal" data-target="#fotoModal">
                        <i class="fas fa-eye"></i>  Ver Foto
                    </button>
                @endif
            </div>
        </div>
        <!-- MODAL DE FOTO -->
        <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header" style="background-color:hsl(353, 100%, 69.6%); color: white;">
                        <h5 class="modal-title" id="fotoModalLabel"><i class="fas fa-camera-retro"></i>     Foto de la Muestra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
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
            <label class="form-label">Clasificación</label>
            <select name="clasificacion_id" id="clasificacion_id" class="form-control" required>
                <option value="">Seleccione una clasificación</option>
                @foreach ($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->id }}" {{ $clasificacion->id == $muestra->clasificacion_id ? 'selected' : '' }}>
                        {{ $clasificacion->nombre_clasificacion }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Unidad de Medida -->
        <div class="form-group">
            <label class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_de_medida" id="unidad_de_medida" class="form-control" readonly required
                   value="{{ $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida ?? '' }}">
        </div>

        <!-- Nombre del doctor -->
        <div class="form-group">
            <label for="name_doctor" class="form-label">Nombre del doctor</label>
            <input type="text" id="name_doctor" name="name_doctor" class="form-control" value="{{ $muestra->name_doctor }}" required>
        </div>

        <!-- Tipo de muestra -->
        <div class="form-group">
            <label class="form-label">Tipo de Muestra</label>
            <select name="tipo_muestra" class="form-control" required>
                <option value="frasco original" {{ $muestra->tipo_muestra == 'frasco original' ? 'selected' : '' }}>Frasco Original</option>
                <option value="frasco muestra" {{ $muestra->tipo_muestra == 'frasco muestra' ? 'selected' : '' }}>Frasco Muestra</option>
            </select>
        </div>

        <!-- Cantidad -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="form-label">Cantidad de Muestras</label>
                <input type="number" id="cantidad_de_muestra" name="cantidad_de_muestra" class="form-control" required value="{{ $muestra->cantidad_de_muestra }}" min="1">
            </div>
        </div>

        <!-- Observaciones -->
        <div class="form-group">
            <label class="form-label">Observaciones</label>
            <textarea name="observacion" class="form-control" rows="3">{{ $muestra->observacion }}</textarea>
        </div>

        <!-- Botón -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn_crear">
                <i class="fas fa-save"></i> Actualizar Muestra
            </button>
        </div>
    </form>
</div>

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">
@stop

@section('js')
    <script>
        document.getElementById('foto').addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : "Seleccionar imagen";
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
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
</script>
@stop