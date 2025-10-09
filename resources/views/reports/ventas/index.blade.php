@extends('adminlte::page')

@section('title', 'Reporte de Ventas')

@section('content_header')

    <div class="row mb-2">
        <div class="col-sm-6">
            <h1><i class="fas fa-chart-line text-danger"></i> Reporte Comercial - Ventas</h1>
        </div>
        <div class="col-sm-6 align-self-end">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Reporte de Ventas</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-danger card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="ventasTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-target="#general" role="tab" data-toggle="pill"
                        href="#general" aria-controls="general" aria-selected="true">
                        <i class="fas fa-chart-bar"></i> General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="visitadoras-tab" data-target="#visitadoras" role="tab" data-toggle="pill"
                        href="#visitadoras" aria-controls="visitadoras" aria-selected="false">
                        <i class="fas fa-user-tie"></i> Visitadoras
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="productos-tab" data-target="#productos" role="tab" data-toggle="pill"
                        href="#productos" aria-controls="productos" aria-selected="false">
                        <i class="fas fa-box"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="provincias-tab" data-target="#provincias" role="tab" data-toggle="pill"
                        href="#provincias" aria-controls="provincias" aria-selected="false">
                        <i class="fas fa-globe-americas"></i> Provincias
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="ventasTabsContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    @include('reports.ventas.partials.general')
                </div>
                <div class="tab-pane fade" id="visitadoras" role="tabpanel">
                    @include('reports.ventas.partials.visitadoras')
                </div>
                <div class="tab-pane fade" id="productos" role="tabpanel">
                    @include('reports.ventas.partials.productos')
                </div>
                <div class="tab-pane fade" id="provincias" role="tabpanel">
                    @include('reports.ventas.partials.provincias')
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Moment', true)
@section('plugins.DateRangePicker', true)
@section('plugins.Chartjs', true)
@section('plugins.Toastr', true)
@section('plugins.Flatpickr', true)
@section('plugins.Sweetalert2', true)

@section('js')
    <script src="{{ asset('js/chart-helpers.js') }}"></script>
    <script src="{{ asset('js/table-helpers.js') }}"></script>
    <script src="{{ asset('js/sweetalert2-factory.js') }}"></script>
    <script src="{{ asset('js/get-money-format.js') }}"></script>
    <script src="{{ asset('js/generate-hsl-color.js') }}"></script>

    @stack('partial-js')

@endsection
