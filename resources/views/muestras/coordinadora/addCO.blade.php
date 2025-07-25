@extends('adminlte::page')

@section('title', 'Registrar Muestra')

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
        <form action="{{ route('muestras.storeCO') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Campo para el nombre de la muestra -->
            <div class="form-group">
                <label>Nombre de la Muestra</label>
                <input type="text" name="nombre_muestra" class="form-control" required />
                @if($errors->has('nombre_muestra'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('nombre_muestra') }}</div>
                @endif
            </div>

            <!-- Campo para la foto -->
            <div class="form-group">
                <label for="foto">Foto de la muestra (opcional)</label>
                <div class="custom-file"> 
                    <input type="file" name="foto" id="foto" class="custom-file-input" accept="image/*">
                    <label class="custom-file-label" for="foto">Selecciona una imagen</label>
                    @if($errors->has('foto'))
                        <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('foto') }}</div>
                    @endif
                </div>
            </div>

            <!-- Campo para la clasificación -->
            <div class="form-group">
                <label>Clasificación</label>
                <select name="clasificacion_id" id="clasificacion_id" class="form-control" required>
                    <option value="">Seleccione una clasificación</option>
                    @foreach ($clasificaciones as $clasificacion)
                        <option value="{{ $clasificacion->id }}">{{ $clasificacion->nombre_clasificacion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campo para unidad de medida -->
            <div class="form-group">
                <label>Unidad de Medida</label>
                <input type="text" name="unidad_de_medida" id="unidad_de_medida" class="form-control" readonly required>
            </div>

            <!-- Campo para tipo de muestra -->
            <div class="form-group">
                <label>Tipo de Muestra</label>
                <select name="tipo_muestra" class="form-control" required>
                    <option value="">Seleccione el tipo de muestra</option>
                    <option value="frasco original">Frasco Original</option>
                    <option value="frasco muestra">Frasco Muestra</option>
                </select>
            </div>

            <!-- Campo para nombre del doctor -->
            <div class="form-group">
                <label for="name_doctor">Nombre del doctor</label>
                <input type="text" id="name_doctor" name="name_doctor" class="form-control" value="{{ old('name_doctor') }}" required />
            </div>

            <!-- Campo para cantidad de muestras -->
            <div class="form-group">
                <label>Cantidad de Muestras</label>
                <input type="number" id="cantidad_de_muestra" name="cantidad_de_muestra" class="form-control" required min="1" />
                @if($errors->has('cantidad_de_muestra'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('cantidad_de_muestra') }}</div>
                @endif
            </div>

            <!-- Campo para observaciones -->
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observacion" class="form-control" rows="3" required></textarea>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn_add"><i class="fas fa-save"></i>
                    Registrar Muestra
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
                document.querySelector('.custom-file-input').addEventListener('change', function (e) {
                    var fileName = document.getElementById("foto").files[0].name;
                    var nextSibling = e.target.nextElementSibling
                    nextSibling.innerText = fileName
                });
                </script>
@stop

