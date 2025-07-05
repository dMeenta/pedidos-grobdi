@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <a class="btn me-3" title="Volver" href="{{ route('proveedores.index') }}" style="color:#6c757d; font-size: 2.3rem;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="flex-grow-1 text-center">Crear Proveedor</h1>
    </div>

    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="razon_social" class="form-label">Razón Social *</label>
            <input type="text" class="form-control" id="razon_social" name="razon_social" required>
            @error('razon_social')
                <div class="text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ruc" class="form-label">RUC *</label>
                <input type="text" class="form-control" id="ruc" name="ruc" pattern="(10|15|16|17|20)[0-9]{9}" title="Ingrese un RUC válido de 11 dígitos que comience con 10, 15, 16, 17 o 20" placeholder="Ej. 20123456789" maxlength="11" required>
                @error('ruc')
                    <div class="text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección *</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
            @error('direccion')
                <div class="text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ej. nombre@correo.com" maxlength="255" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                title="Ingrese un correo electrónico válido">
            </div>
            <div class="col-md-6 mb-3">
                <label for="correo_cpe" class="form-label">Correo CPE</label>
                <input type="email" class="form-control" id="correo_cpe" name="correo_cpe">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono_1" class="form-label">Teléfono 1 *</label>
                <input type="text" class="form-control" id="telefono_1" name="telefono_1" pattern="[9][0-9]{8}" maxlength="9" required placeholder="Ingresar un número de 9 dígitos" title="El número debe tener 9 dígitos y comenzar con 9">
                @error('telefono_1')
                    <div class="text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_2" class="form-label">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono_2" name="telefono_2" pattern="[9][0-9]{8}" maxlength="9" placeholder="Ej. 987654321" title="El número debe tener 9 dígitos y comenzar con 9">
            </div>
        </div>

        <div class="mb-3">
            <label for="persona_contacto" class="form-label">Persona de Contacto</label>
            <input type="text" class="form-control" id="persona_contacto" name="persona_contacto">
        </div>

        <div class="mb-3">
            <label for="observacion" class="form-label">Observaciones</label>
            <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn_crear btn-sm"><i class="fas fa-save"></i>Guardar</button>
    </form>
</div>
@stop

@section('css')
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
@stop