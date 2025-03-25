@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-5">
  <h2 class="card-header">Actualizar Especialidad</h2>
  <div class="card-body">
  
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
    </div>
  
    <form action="{{ route('especialidad.update',$especialidad->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="inputName" class="form-label"><strong>Nombre:</strong></label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ $especialidad->name }}"
                    class="form-control @error('name') is-invalid @enderror" 
                    id="inputName" 
                    placeholder="Ingresar nombre de la especialidad">
                @error('name')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <label for="description" class="form-label"><strong>Descripción:</strong></label>
                <input 
                    type="text" 
                    name="description" 
                    value="{{ $especialidad->description }}"
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    placeholder="Descripción de la especialidad">
                @error('description')
                    <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar</button>
    </form>
  
  </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
@stop

@section('js')
    <!-- <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script> -->
@stop