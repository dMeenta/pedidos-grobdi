@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
     <div class="form-check mb-3 d-flex align-items-center justify-content-center position-relative">
        <a class="btn me-3 text-secondary" title="Volver" href="{{ route('proveedores.index') }}"  style="position: absolute; left: 0; font-size: 2rem">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="m-0">Editar Proveedor</h1>
    </div>
    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social *</label>
            <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social', $proveedor->razon_social) }}" required>
            @error('razon_social')
                <div class="text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ruc" class="form-label">RUC *</label>
                <input type=" text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc', $proveedor->ruc) }}" maxlength="11" required>
                @error('ruc')
                    <div class="text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="estado" class="form-label">Estado *</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="activo" {{ old('estado', $proveedor->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado', $proveedor->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección *</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $proveedor->correo) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="correo_cpe" class="form-label">Correo CPE</label>
                <input type="email" class="form-control" id="correo_cpe" name="correo_cpe" value="{{ old('correo_cpe', $proveedor->correo_cpe) }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono_1" class="form-label">Teléfono 1 *</label>
                <input type="text" class="form-control" id="telefono_1" name="telefono_1" value="{{ old('telefono_1', $proveedor->telefono_1) }}" required>
                @error('telefono_1')
                    <div class="text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_2" class="form-label">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono_2" name="telefono_2" value="{{ old('telefono_2', $proveedor->telefono_2) }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="persona_contacto" class="form-label">Persona de Contacto</label>
            <input type="text" class="form-control" id="persona_contacto" name="persona_contacto" value="{{ old('persona_contacto', $proveedor->persona_contacto) }}">
        </div>

        <div class="mb-3">
            <label for="observacion" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3">{{ old('observacion', $proveedor->observacion) }}</textarea>
        </div>

        <button type="submit" class="btn btn_crear btn-sm"><i class="fas fa-edit"></i>Actualizar</button>
    </form>
</div>
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop
@section('js')
@stop
