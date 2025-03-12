@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar Usuario</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
    <form action="{{ route('usuarios.update',$usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Nombre de usuario:</strong></label>
            <input 
                type="text" 
                name="name" 
                value="{{ $usuario->name }}"
                class="form-control @error('name') is-invalid @enderror" 
                id="inputName" 
                placeholder="Ingresar el nombre del usuario" required>
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label"><strong>Email:</strong></label>
            <input 
                type="email" 
                name="email" 
                value="{{ $usuario->email }}"
                class="form-control @error('email') is-invalid @enderror" 
                id="inputEmail" 
                placeholder="ingrar correo electronico" required>
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="zone_id" class="form-label form-label-lg mb-3"><strong>Zonas:</strong></label>
            @foreach ($zonas as $zona)
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        value="{{ $zona->id }}" 
                        id="{{ $zona->id }}" 
                        name="zonas[]"
                        @if (in_array($zona->id,  $usuario->zones->pluck('id')->toArray())) checked @endif
                    >
                    <label class="form-check-label" for="{{ $zona->id }}">
                        {{ $zona->name }}
                    </label>
                </div>
            @endforeach
            @error('zonas')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-label-lg mb-3"><strong>Rol:</strong></label>
            <select class="form-select" name="role_id" id="role_id">
                <option value="" disabled>Selecciona un rol</option>
                @foreach ($roles as $rol )
                    <option value={{ $rol->id}} {{ $rol->id === $usuario->role_id ? 'selected' : '' }}> {{ $rol->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>

    @session('success')
        <br>
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
    @endsession
    <br>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Cambiar Contraseña
    </button>
    @error('password')
        <div class="form-text text-danger">No se pudo actualizar la contraseña, ingresar al formulario para detectar los errores</div>
    @enderror
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('usuarios.changepass',$usuario) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar de contraseña</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputPass" class="form-label"><strong>Ingresar Contraseña:</strong></label>
                        <input 
                            type="password" 
                            name="password" 
                            value=""
                            class="form-control @error('password') is-invalid @enderror" 
                            id="inputPass" 
                            placeholder="Ingresar la contraseña del usuario" required>
                        @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputConfirmedPass" class="form-label"><strong>Repetir Contraseña:</strong></label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            value=""
                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                            id="inputConfirmedPass" 
                            placeholder="Repetir la contraseña ingresada" required>
                        @error('password_confirmation')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</a>
                    <button type="submit" class="btn btn-primary" id="liveToastBtn">Actualizar</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@stop