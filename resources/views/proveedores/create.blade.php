@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>cotizador</h1> -->
@stop

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <a class="btn me-3" title="Volver" href="{{ route('proveedores.index') }}" style="color:#6c757d; font-size: 2.3rem;">
            <i class="bi bi-arrow-left-circle"></i>
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
                <input type="text" class="form-control" id="ruc" name="ruc" maxlength="11" required>
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
                <input type="email" class="form-control" id="correo" name="correo">
            </div>
            <div class="col-md-6 mb-3">
                <label for="correo_cpe" class="form-label">Correo CPE</label>
                <input type="email" class="form-control" id="correo_cpe" name="correo_cpe">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono_1" class="form-label">Teléfono 1 *</label>
                <input type="text" class="form-control" id="telefono_1" name="telefono_1" required>
                @error('telefono_1')
                    <div class="text-danger">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="telefono_2" class="form-label">Teléfono 2</label>
                <input type="text" class="form-control" id="telefono_2" name="telefono_2">
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

        <button type="submit" class="btn btn_crear btn-sm"><i class="fa-regular fa-floppy-disk"></i>Guardar</button>
    </form>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

<!-- Bootstrap Icons (Bootstrap 5 oficial) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

<!-- Font Awesome (opcional, solo si lo usas) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Tus estilos personalizados -->
<link href="{{ asset('css/muestras/home.css') }}" rel="stylesheet" />
<style>
    .btn-sm {
        font-size: 1rem; 
        padding: 8px 14px; 
        border-radius: 8px;
        display: flex; 
        align-items: center; 
        }

        .btn-sm i {
            margin-right: 4px; /* Espaciado entre el icono y el texto */
        }
</style>
@stop