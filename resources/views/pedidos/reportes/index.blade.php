@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')

<div class="card mt-3">
    <h2 class="card-header">FORMATOS</h2>
    <div class="card-body">
        <div class="mb-3">
            <h4>Hoja de Ruta - Motorizado</h4>
        </div>
        <form action="{{ route('formatos.excelhojaruta') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label>Fecha de Entrega:</label>
                    <input class="form-control" type="date" name="fecha" required>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label>Ruta:</label>
                    <select name="ruta" class="form-control">
                        <option value="0">Norte</option>
                        <option value="0">Centro</option>
                        <option value="1">Sur</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2">
                    <label>Turno:</label>
                    <select name="turno" class="form-control">
                        <option value="0">Mañana</option>
                        <option value="1">Tarde</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-success" type="input"><i class="fa fa-file-excel">   Descargar</i></button>
        </form>

    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">
    </style>
    
@stop

@section('js')

@stop