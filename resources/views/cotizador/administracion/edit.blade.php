@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <div class="form-check mb-3 d-flex align-items-center justify-content-center position-relative"> 
        <a class="text-secondary" title="Volver" href="{{ route('insumo_empaque.index') }}" style="position: absolute; left:0; font-size: 2rem;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="m-0">Editar {{ ucfirst($tipo) }}</h1>
    </div>

    <form action="{{ route('insumo_empaque.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="tipo" value="{{ $tipo }}">
        <div class="row">
            {{-- Tipo (solo lectura) --}}
            <div class="col-md-6 mb-3">
                <label for="tipo">Tipo</label>
                <select class="form-control" disabled>
                    @foreach ($tipos as $key => $value)
                        <option value="{{ $key }}" {{ $tipo === $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
                {{-- === CAMPOS PARA INSUMOS === --}}
            @if ($tipo === 'insumo')
                <div class="col-md-6 mb-3">
                    <label>Unidad de Medida</label>
                    <select name="unidad_de_medida_id" class="form-control" required>
                        @foreach ($unidades as $id => $unidad)
                            <option value="{{ $id }}" {{ $item->unidad_de_medida_id == $id ? 'selected' : '' }}>{{ $unidad }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <input type="hidden" name="es_caro" value="0">
                    <label>
                        <input type="checkbox" name="es_caro" value="1" {{ old('es_caro', $item->es_caro) ? 'checked' : '' }}>
                        <span style="margin-left: 6px;">¿Es caro?</span>
                    </label>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nombre</label>
                <input name="nombre" class="form-control" value="{{ old('nombre', $item->articulo->nombre) }}" required>
                @error('nombre')
                    <div class="text-success">
                        <i class="fa-solid fa-triangle-exclamation"></i>{{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label>Precio</label>
                <input name="precio" type="number" step="0.0001" class="form-control"
                    value="{{ old('precio', $item->precio ?? $item->precio) }}" required>
            </div>
        </div>

        @if($item->articulo->estado === 'inactivo')
        <div class="col-md-6 mb-3">
            <label for="estado" class="form-label">Estado del Insumo</label>
            <div class="form-check form-switch">
                <label class="form-check-label" for="estado">
                <input class="form-check-input" type="checkbox" name="estado" id="estado"
                    value="activo" {{ $item->articulo->estado === 'activo' ? 'checked' : '' }} required>
                <span style="margin-left: 6px;">Activo</span>
                </label>
            </div>
        </div><br>
    @endif
        <button class="btn btn_crear"><i class="far fa-edit"></i>  Actualizar</button>
    </form>
</div>
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop
@section('js')
@stop