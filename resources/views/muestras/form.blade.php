@extends('adminlte::page')

@section('title', $muestra ? 'Editar Muestra' : 'Registrar Muestra')

@section('content_header')
<!-- <h1>Pedidos</h1> -->
@stop

@section('content')
@can($muestra ? 'muestras.edit' : 'muestras.create')
<div class="container">
    <h1 class="text-center position-relative">
        <a class="position-absolute text-secondary" style="left: 0;" title="Volver"
            href="{{ route('muestras.index') }}">
            <i class="fas fa-arrow-left"></i>
        </a>
        {{ $muestra ? 'Editar Muestra' : 'Registrar Muestra' }}
        <hr>
    </h1>
    <form action="{{ $muestra ? route('muestras.update', $muestra->id) : route('muestras.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($muestra)
            @method('PUT')
        @endif
        <!-- Campo para el nombre de la muestra -->
        <div class="form-group">
            <label>Nombre de la Muestra</label>
            <input type="text" name="nombre_muestra" class="form-control" required
                value="{{ old('nombre_muestra', $muestra->nombre_muestra ?? '') }}" />
            @if ($errors->has('nombre_muestra'))
                <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('nombre_muestra') }}
                </div>
            @endif
        </div>

        <!-- Campo para la foto -->
        <div class="form-group">
            <label for="foto">Foto de la muestra (opcional)</label>
            <div class="custom-file">
                <input type="file" name="foto" id="foto" class="custom-file-input" accept="image/*">
                <label class="custom-file-label" for="foto">Selecciona una imagen</label>
                @if ($errors->has('foto'))
                    <div class="text-success"><i class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('foto') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Campo para la clasificación -->
            <div class="form-group col-12 col-md-6">
                <label>Clasificación</label>
                <select name="clasificacion_id" id="clasificacion_id" class="custom-select" required>
                    <option disabled value="" selected>Seleccione una clasificación</option>
                    @foreach ($clasificaciones as $clasificacion)
                        <option value="{{ $clasificacion->id }}" {{ old('clasificacion_id', $muestra->clasificacion_id ?? '') == $clasificacion->id ? 'selected' : '' }}>
                            {{ $clasificacion->nombre_clasificacion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Campo para tipo de frasco -->
            <div class="form-group col-12 col-md-6">
                <label>Tipo de Frasco</label>
                <select name="tipo_frasco" id="tipo_frasco" class="custom-select" required>
                    <option value="" disabled selected>Seleccione el tipo de frasco</option>
                    <option value="frasco original" {{ old('tipo_frasco', $muestra->tipo_frasco ?? '') == 'Frasco Original' ? 'selected' : '' }}>
                        Frasco Original</option>
                    <option value="frasco muestra" {{ old('tipo_frasco', $muestra->tipo_frasco ?? '') == 'Frasco Muestra' ? 'selected' : '' }}>
                        Frasco Muestra</option>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Campo para unidad de medida -->
            <div class="form-group col-12 col-md-6">
                <label>Unidad de Medida</label>
                <input type="text" name="unidad_de_medida" id="unidad_de_medida" class="form-control" readonly required
                    value="{{ old('unidad_de_medida', $muestra->unidadDeMedida->nombre_unidad_de_medida ?? '') }}">
            </div>
            <!-- Campo para presentación por clasificación -->
            <div class="form-group col-12 col-md-6">
                <label>Presentaciones <i class="text-dark ml-1" id="presentacion_info" style="font-weight: lighter;">-
                        al seleccionar el Frasco Muestra no se usará el valor de este campo</i></label>
                <select name="clasificacion_presentacion_id" id="clasificacion_presentacion_id" class="custom-select"
                    required {{ old('tipo_frasco', $muestra->tipo_frasco ?? '') == 'Frasco Muestra' ? 'disabled' : '' }}>
                    @if (
                            $muestra &&
                                $muestra->clasificacion &&
                                $muestra->clasificacion->presentaciones &&
                                $muestra->tipo_frasco === 'Frasco Original')
                            @foreach ($muestra->clasificacion->presentaciones as $presentacion)
                                <option value="{{ $presentacion->id }}"
                                    {{ old('clasificacion_presentacion_id', $muestra->clasificacion_presentacion_id ?? '') == $presentacion->id ? 'selected' : '' }}>
                                    {{ $presentacion->quantity }}
                                    {{ $muestra->unidadDeMedida->nombre_unidad_de_medida ?? '' }}
                                </option>
                            @endforeach
                        @else
                            <option disabled selected>Seleccione una clasificación para ver las opciones</option>
                        @endif
                    </select>
                </div>
            </div>
            <!-- Campo para el doctor -->
            <div class="form-group position-relative">
                <label for="name-query">Nombre del doctor</label>
                <input type="text" id="name-query" name="name-query" class="form-control" autocomplete="off" required
                    value="{{ old('name-query', $muestra->doctor->name ?? '') }}" />
                <div id="doctors-suggestions-list" class="list-group position-absolute overflow-auto border"
                    style="z-index: 1000; max-height: 200px; width: 100%;">
                </div>
                <input type="hidden" name="id_doctor" id="id_doctor"
                    value="{{ old('id_doctor', $muestra->id_doctor ?? '') }}" />
            </div>

        <!-- Campo para cantidad de muestras -->
        <div class="form-group">
            <label>Cantidad de Muestras</label>
            <input type="number" id="cantidad_de_muestra" name="cantidad_de_muestra" class="form-control" required
                min="1" value="{{ old('cantidad_de_muestra', $muestra->cantidad_de_muestra ?? '') }}" />
            @if ($errors->has('cantidad_de_muestra'))
                <div class="text-success"><i
                        class="fas fa-skull-crossbones mr-2"></i>{{ $errors->first('cantidad_de_muestra') }}</div>
            @endif
        </div>

        <!-- Campo para observaciones -->
        <div class="form-group">
            <label>Observaciones</label>
            <textarea name="observacion" class="form-control" rows="3"
                required>{{ old('observacion', $muestra->observacion ?? '') }}</textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-danger w-75"><i class="fas fa-save"></i>
                {{ $muestra ? 'Actualizar Muestra' : 'Registrar Muestra' }}
            </button>
        </div>
    </form>
</div>
@endcan


@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/muestras/home.css') }}">
@stop

@section('js')
<script src="{{ asset('js/autocomplete-input.js') }}"></script>
<script>
    $(document).ready(function () {
        const presentacionInfo = $('#presentacion_info');
        presentacionInfo.hide();
        const selectedClasificacionId = $('#clasificacion_id').val();

            const doctorIdInput = $('#id_doctor');
            const doctorNameInput = $('#name-query');
            initAutocompleteInput({
                apiUrl: `{{ route('doctors.search') }}`,
                inputSelector: doctorNameInput,
                listSelector: '#doctors-suggestions-list',
                hiddenIdSelector: doctorIdInput,
            });
            const unidadMedidaInput = $('#unidad_de_medida');

        const tipoFrascoSelect = $('#tipo_frasco');
        const clasificacionSelect = $('#clasificacion_id');
        const presentacionSelect = $('#clasificacion_presentacion_id');

        const rawClasificaciones = JSON.parse('@json($clasificaciones)');
        const clasificaciones = {};

        rawClasificaciones.forEach(c => {
            clasificaciones[c.id] = {
                unidad_medida: c.unidad_medida.nombre_unidad_de_medida,
                presentaciones: c.presentaciones.map((p) =>
                ({
                    id: p.id,
                    quantity: p.quantity
                }))
            };
        });

        tipoFrascoSelect.on('change', function (e) {
            if (tipoFrascoSelect.val() === 'frasco original') {
                presentacionSelect.prop('disabled', false);
                presentacionInfo.hide();
                clasificacionSelect.trigger('change');
            } else {
                presentacionSelect.prop('disabled', true);
                presentacionInfo.show();
            }
        })

        clasificacionSelect.on('change', function () {
            const selectedId = parseInt(this.value);
            const clasificacion = clasificaciones[selectedId];
            unidadMedidaInput.val(clasificacion.unidad_medida || '');

            presentacionSelect.empty();

            presentacionSelect.append(
                '<option selected disabled value="">Seleccione la presentación deseada</option>');

            if (clasificacion && clasificacion.presentaciones.length > 0) {
                clasificacion.presentaciones.forEach(p => {
                    presentacionSelect.append(
                        `<option value="${p.id}">${p.quantity} ${clasificacion.unidad_medida}</option>`
                    );
                });
            }
        });

        $('.custom-file-input').on('change', function (e) {
            var fileName = $("#foto").files[0].name;
            var nextSibling = e.target.nextElementSibling
            nextSibling.innerText = fileName
        });
    });


    $('form').on('submit', function (e) {
        const idDoctor = idDoctorInput.val();
        const nameDoctor = doctorNameInput.val();

        if (!idDoctor) {
            e.preventDefault();
            alert('Por favor, selecciona un doctor registrado.');
            doctorNameInput.focus();
            return false;
        }
    });
</script>
@stop