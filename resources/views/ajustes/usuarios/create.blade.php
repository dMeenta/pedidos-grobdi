@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Crear Nuevo Usuario</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
  
        <div class="mb-3">
            <label for="inputName" class="form-label"><strong>Nombre de usuario:</strong></label>
            <input 
                type="text" 
                name="name" 
                value=""
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
                value=""
                class="form-control @error('email') is-invalid @enderror" 
                id="inputEmail" 
                placeholder="ingrar correo electronico" required>
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="passName" class="form-label"><strong>Contraseña:</strong></label>
            <input 
                type="password" 
                name="password" 
                value=""
                class="form-control @error('password') is-invalid @enderror" 
                id="passName" 
                placeholder="Ingresar contraseña" required>
            @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="passNameConfirm" class="form-label"><strong>Confirmar Contraseña:</strong></label>
            <input 
                type="password" 
                name="password_confirmation" 
                value=""
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                id="passNameConfirm" 
                placeholder="Repetir la contraseña" required>
            @error('password_confirmation')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="zone_id" class="form-select form-select-lg mb-3"><strong>Zonas:</strong></label>
            @foreach ($zonas as $zona)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $zona->id }}" id="{{ $zona->id }}" name="zonas[]">
                    <label class="form-check-label" for="{{ $zona->id }}">
                        {{ $zona->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="role_id" class="form-select form-select-lg mb-3"><strong>Rol:</strong></label>
            <select class="form-control" name="role_id" id="role_id">
                <option value="" disabled>Selecciona un rol</option>
                @foreach ($roles as $rol )
                    <option value={{ $rol->id}}> {{ $rol->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Crear</button>
    </form>
  
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop