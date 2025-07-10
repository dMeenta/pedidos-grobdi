@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de centros de salud</h1>
@stop

@section('content')
<div class="card mt-5">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-medium">
            <a class="btn btn-success btn-sm" href="{{ route('centrosalud.create') }}"> <i class="fa fa-plus"></i> Registrar datos</a>
        </div>
    </div>
    <div class="card-body">
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>descripción</th>
                    <th>Dirección</th>
                    <th>Posición</th>
                    <th width="220px">Opciones</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($centrosalud as $centrosa)
                <tr>
                    <td>{{ $centrosa->name }}</td>
                    <td>{{ $centrosa->description }}</td>
                    <td>{{ $centrosa->adress }}</td>
                    <td>{{ $centrosa->latitude }} - {{ $centrosa->longitude }}</td>
                    <td>
                        <form action="{{ route('centrosalud.destroy',$centrosa->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('centrosalud.edit',$centrosa->id) }}"><i class="fas fa-pen"></i> Editar</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay información que mostrar</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $centrosalud->appends(request()->except('page'))->links() !!}

    </div>
</div> 
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
@stop