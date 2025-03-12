@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Actualizar Pedido</h2>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Atrás</a>
        </div>
        <br>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
                 Primero cargar el excel con las direcciones
            </div>
        </div>
        <form action="{{ route('cargarpedidos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="pedidos_excel" class="form-label"><strong>Cargar Pedidos con direcciones:</strong></label>
            <input 
                type="file" 
                name="archivo" 
                class="form-control"
                accept=".xlsx, .csv" 
                id="pedidos_excel"
                required
            >
            @error('archivo')
            <p style="color: red;">{{ $archivo }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Importar Pedidos Excel</button>
        </form>
        <br>
        <br>
        <form action="{{ route('cargarpedidos.excelarticulos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-5">
            <label for="detail_excel" class="form-label"><strong>Cargar Pedidos con articulos:</strong></label>
            <input type="file" name="archivo" accept=".xlsx, .csv" class="form-control" id="detail_excel" required>
            @error('archivo')
                <p style="color: red;">{{ $archivo }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Importar pedidos articulos Excel</button>
        </form>

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
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
    </div>
</div>
    <!-- <form action="{{ route('cargarpedidos.store') }}" method="POST">
        @csrf
  
        <div class="mb-3">
            <label for="inputDetail" class="form-label"><strong>pedidos:</strong></label>
            <textarea
                class="form-control @error('detail') is-invalid @enderror" 
                style="height:150px" 
                id="message"
                name="message" 
                placeholder="Cargar texto de pedidos"></textarea>
            @error('message')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Cargar</button>
    </form>
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif -->

    
    @endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop