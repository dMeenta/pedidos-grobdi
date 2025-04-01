@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
    
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Editar Lista</h3>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
        </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('lista.update',$lista->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Nombre de la lista</label>
                <input type="text" class="form-control" id="name" placeholder="Ingresar nombre" name="name" value="{{$lista->name}}">
            </div>
            <div class="form-group">
                <label for="name">Zona</label>
                <select class="form-control" name="zone_id">
                    <option selected disabled>Seleccione una zona</option>
                    @foreach ($zonas as $zona)
                        <option value={{ $zona->id}} {{ $zona->id === $lista->zone_id ? 'selected' : '' }}> {{ $zona->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">distritos</label>
                <div class="row">
                @foreach ($distritos as $distrito)
                    <div class="col-sm-2">
                        <div class="form-check">
                            <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="distritos[]" 
                            value="{{ $distrito->id }}" 
                            id="{{ $distrito->name }}"
                            @if (in_array($distrito->id,  $lista->distritos->pluck('id')->toArray())) checked @endif
                        >
                            <label class="form-check-label" for="{{ $distrito->name }}">{{ $distrito->name }}</label>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>
        @error('message')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    <br>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">
    </style>
    
@stop

@section('js')

@stop