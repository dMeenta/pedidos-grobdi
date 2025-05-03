<!DOCTYPE html>
@extends('adminlte::page')

@section('title', 'Reporte Frasco Muestra')

@section('content_header')
    <!-- <h1>Pedidos</h1> -->
@stop

@section('content')
<div class="container">
        <div class="cont-report">
            <h1>Reporte - Frasco Muestra</h1>
            
            <div class="btn-container">
            <a href="{{ route('muestras.exportarPDF', ['mes' => $mesSeleccionado]) }}" class="btn btn-exportar">
                <i class="fas fa-file-pdf mr-2"></i> Exportar a PDF
            </a>
                

                <!-- Filtro de Mes -->
                <form class="form-graf" method="get" action="{{ route('muestras.reporte.frasco-muestra') }}">
                    <label for="mes">Mes:</label>
                    <input type="month" name="mes" id="mes" value="{{ $mesSeleccionado }}">
                    <button type="submit" class="btn-filtrar">Filtrar</button>
                </form>
            </div>

            <!-- Tabla de Muestras -->
            <h3>Tabla de Muestras</h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre de Muestra</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (S/)</th>
                            <th>Precio Total (S/)</th>
                            <th>Creado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($muestrasData as $data)
                            <tr>
                                <td>{{ $data['nombre_muestra'] }}</td>
                                <td>{{ $data['cantidad'] }}</td>
                                <td>{{ number_format($data['precio_unidad'], 2) }}</td>
                                <td>{{ number_format($data['precio_total'], 2) }}</td>
                                <td>{{ $data['creator'] ? $data['creator']->name : 'Desconocido' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {!! $muestras->appends(request()->except('page'))->links() !!}
                </div>
            </div>

            <!-- Tabla de Totales -->
            <div class="totales-container">
                <table class="tabla-totales">
                    <thead>
                        <tr>
                            <th colspan="2">Resumen de Totales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total de Muestras</td>
                            <td>{{ $totalCantidad }}</td>
                        </tr>
                        <tr>
                            <td>Total de Precio</td>
                            <td>S/ {{ number_format($totalPrecio, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
            :root {
                --primary: #fe495f;
                --secondary: #ff5475;
                --accent: #fff1be;
                --text-dark: #333;
                --text-light: #fff;
                --bg-light: #fff9f0;
                --border-radius: 8px;
                --box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                --transition: all 0.3s ease;
            }

            /* Contenido principal sin afectar sidebar */
            .content-wrapper {
                background-color: var(--bg-light);
                min-height: calc(100vh - calc(3.5rem + 1px));
                padding: 15px;

            }
            .content-header {
                padding: 5px 0.5rem;
            }
            /* Contenedor específico para el reporte */
            .container {
                background-color: white;
                border-radius: var(--border-radius);
                box-shadow: var(--box-shadow);
                padding: 15px;
                margin-top: 6px;
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;       
            }

            /* Encabezados */
            h1, h3 {
                color: var(--primary);
                text-align: center;
                word-wrap: break-word;
                margin-bottom: 15px;
            }

            h1 {
                font-size: clamp(1.5rem, 5vw, 2.2rem);
            }

            label{
                color: var(--primary);
            }
            h3 {
                font-size: clamp(1.2rem, 4vw, 1.5rem);
                margin-top: 20px;
            }

            /* Botones */
            .btn-container {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
                justify-content: center;
                margin-bottom: 25px;
            }

            .btn-exportar, .btn-filtrar {
                padding: 12px 20px;
                border: none;
                border-radius: 30px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                font-size: clamp(0.9rem, 3vw, 1rem);
                white-space: nowrap;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 140px;
            }

            .btn-exportar i {
                margin-right: 5px;
            }
            .btn-exportar {
                background-color: var(--primary);
                color: var(--text-light);
            }

            .btn-filtrar {
                background-color: var(--secondary);
                color: var(--text-light);
            }

            .btn-exportar:hover, .btn-filtrar:hover {
                transform: translateY(-3px);
                box-shadow: 0 5px 15px rgba(214, 37, 77, 0.3);
            }

            /* Formulario */
            .form-graf {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                align-items: center;
                justify-content: center;
                width: 100%;
            }

            .form-graf label {
                font-size: clamp(0.9rem, 3vw, 1rem);
                flex: 1 1 100%;
                text-align: center;
            }

            .form-graf input[type="month"] {
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: var(--border-radius);
                font-size: clamp(0.9rem, 3vw, 1rem);
                width: 100%;
                max-width: 280px;
                transition: var(--transition);
            }

            /* Tablas */
            .table-responsive {
                width: 100%;
                overflow-x: auto;
                margin: 25px 0;
                -webkit-overflow-scrolling: touch;
                box-shadow: 0 0 10px rgba(0,0,0,0.05);
                border-radius: var(--border-radius);
            }

            table {
                width: 100%;
                min-width: 320px;
                border-collapse: collapse;
            }

            th, td {
                padding: 12px 10px;
                text-align: left;
                border-bottom: 1px solid #eee;
                font-size: clamp(0.85rem, 3vw, 1rem);
                text-align: center;
            }

            th {
                background-color: var(--primary);
                color: var(--text-light);
                font-weight: 600;
                position: sticky;
                top: 0;
            }

            td:first-child {
                text-align: left;
                word-break: break-word;
            }

            tr:nth-child(even) {
                background-color: var(--accent);
            }

            /* Tabla de totales */
            .totales-container {
                width: 100%;
                display: flex;
                justify-content: center;
                margin-top: 30px;
            }

            .tabla-totales {
                width: 100%;
                min-width: 300px;
                max-width: 450px;
                border-collapse: collapse;
                box-shadow: var(--box-shadow);
                border-radius: var(--border-radius);
                overflow: hidden;
            }

            .tabla-totales th {
                background-color: var(--secondary);
                padding: 15px;
                font-size: clamp(1rem, 4vw, 1.2rem);
                text-align: center;
            }

            .tabla-totales tr:last-child {
                background-color: var(--accent);
                font-weight: bold;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .btn-container {
                    flex-direction: column;
                    align-items: center;
                }
                
                .btn-exportar, .btn-filtrar {
                    width: 100%;
                    max-width: 280px;
                }
                
                .form-graf input[type="month"] {
                    max-width: 280px;
                }
            }

            @media (max-width: 576px) {
                h1 {
                    font-size: 1.5rem;
                }
                
                h3 {
                    font-size: 1.2rem;
                }
                
                .btn-exportar, .btn-filtrar {
                    min-width: 100%;
                }
            }

            /* Estilos para PDF */
            @media print {
                .main-sidebar, .content-header, .btn-container {
                    display: none !important;
                }
                
                body, .content-wrapper {
                    padding: 0 !important;
                    margin: 0 !important;
                    background: white !important;
                }
                
                .container {
                    width: 100% !important;
                    box-shadow: none !important;
                    border: none !important;
                }
            }
</style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stop
