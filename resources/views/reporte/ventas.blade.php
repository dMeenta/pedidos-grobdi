@extends('adminlte::page')

@section('title', 'Reporte de Ventas')

@section('content_header')
    <h1><i class="fas fa-chart-line text-primary"></i> Reporte de Ventas</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="ventasTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="visitadora-tab" data-toggle="tab" data-target="#visitadora" type="button" role="tab">
                        <i class="fas fa-user-md"></i> Visitadora
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="producto-tab" data-toggle="tab" data-target="#producto" type="button" role="tab">
                        <i class="fas fa-box"></i> Producto
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="provincia-tab" data-toggle="tab" data-target="#provincia" type="button" role="tab">
                        <i class="fas fa-map-marker-alt"></i> Provincia
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="general-tab" data-toggle="tab" data-target="#general" type="button" role="tab">
                        <i class="fas fa-chart-bar"></i> General
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="ventasTabsContent">
                @include('reporte.componentes.ventas.visitadora')
                @include('reporte.componentes.ventas.producto')
                @include('reporte.componentes.ventas.provincia')
                @include('reporte.componentes.ventas.general', ['data' => $data])
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<!-- Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Datos en memoria
const datosVentas = {
    visitadoras: {
        labels: ['Visitadora Sur', 'Visitadora Norte', 'Visitadora Centro'],
        datos: [1500, 2000, 1800],
        visitas: [45, 60, 55],
        colores: ['#dc3545', '#007bff', '#ffc107']
    },
    productos: {
        labels: ['Vitaminas Prenatales', 'Suplementos de Hierro', 'Ácido Fólico', 'Calcio'],
        datos: [2400, 1425, 850, 975],
        cantidades: [120, 95, 85, 65],
        colores: ['#28a745', '#17a2b8', '#ffc107', '#6f42c1']
    },
    provincias: {
        labels: ['Ica', 'Arequipa', 'Lima'],
        datos: [2500, 2200, 800],
        visitas: [80, 75, 30],
        colores: ['#dc3545', '#28a745', '#007bff']
    },
    reportesMes: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datos: [4200, 3800, 5300, 4900, 5600, 5850, 5200, 6100, 5800, 6300, 6000, 6500],
        colores: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8', '#fd7e14', '#e83e8c', '#20c997', '#6c757d', '#343a40', '#f8f9fa']
    },
    ventasDia: {
        labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
        datos: [150, 200, 180, 220, 190, 210, 230, 250, 240, 260, 280, 270, 290, 300, 310, 320, 330, 340, 350, 360, 370, 380, 390, 400, 410, 420, 430, 440, 450, 460]
    },
    tendencia: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datos: [4200, 3800, 5300, 4900, 5600, 5850]
    }
};

$(document).ready(function() {
    console.log('Iniciando reportes...');
    
    // Configurar datepickers
    flatpickr('#fecha_inicio', {
        dateFormat: 'Y-m-d',
        locale: 'es'
    });
    
    flatpickr('#fecha_fin', {
        dateFormat: 'Y-m-d',  
        locale: 'es'
    });
    
    flatpickr('#fecha_inicio_provincia', {
        dateFormat: 'Y-m-d',
        locale: 'es'
    });
    
    flatpickr('#fecha_fin_provincia', {
        dateFormat: 'Y-m-d',  
        locale: 'es'
    });
    
    flatpickr('#mes_general', {
        dateFormat: 'Y-m',
        locale: 'es'
    });
    
    flatpickr('#anio_general', {
        dateFormat: 'Y',
        locale: 'es'
    });
    
    flatpickr('#fecha_inicio_producto', {
        dateFormat: 'Y-m-d',
        locale: 'es'
    });
    
    flatpickr('#fecha_fin_producto', {
        dateFormat: 'Y-m-d',  
        locale: 'es'
    });

    // Crear gráficos
    crearGraficoVisitadoras();
    crearGraficoPieVisitadoras();
    crearGraficoProductos();
    crearGraficoProvincias();
    crearGraficoPieProvincias();
    crearGraficoReportesMes();
    crearGraficoVentasDia();
    crearGraficoTendencia();

    // Eventos
    $('#filtrar').click(function() {
        const inicio = $('#fecha_inicio').val();
        const fin = $('#fecha_fin').val();
        
        if (inicio && fin) {
            alert('Filtrando desde ' + inicio + ' hasta ' + fin);
            // Aquí actualizarías los gráficos con datos filtrados
        } else {
            alert('Selecciona ambas fechas');
        }
    });
    
    $('#limpiar').click(function() {
        $('#fecha_inicio').val('');
        $('#fecha_fin').val('');
        alert('Filtros limpiados');
    });
    
    $('#filtrar_provincia').click(function() {
        const inicio = $('#fecha_inicio_provincia').val();
        const fin = $('#fecha_fin_provincia').val();
        
        if (inicio && fin) {
            alert('Filtrando provincia desde ' + inicio + ' hasta ' + fin);
            // Aquí actualizarías los gráficos con datos filtrados
        } else {
            alert('Selecciona ambas fechas para provincia');
        }
    });
    
    $('#limpiar_provincia').click(function() {
        $('#fecha_inicio_provincia').val('');
        $('#fecha_fin_provincia').val('');
        alert('Filtros de provincia limpiados');
    });
    
    $('#descargar-excel-provincia').click(function() {
        alert('Descargando reporte detallado de Provincias en Excel...');
    });
    
    $('#filtrar_general').click(function() {
        const mes = $('#mes_general').val();
        const anio = $('#anio_general').val();
        
        if (mes && anio) {
            alert('Filtrando general para ' + mes + ' del año ' + anio);
            // Aquí actualizarías los gráficos con datos filtrados
        } else {
            alert('Selecciona mes y año');
        }
    });
    
    $('#limpiar_general').click(function() {
        $('#mes_general').val('');
        $('#anio_general').val('');
        alert('Filtros generales limpiados');
    });
    
    $('#descargar-excel-general').click(function() {
        alert('Descargando reporte general detallado en Excel...');
    });
    
    // Botones de descarga Excel
    $('#descargar-excel-visitadora').click(function() {
        alert('Descargando reporte detallado de Visitadoras en Excel...');
    });
    
    $('#descargar-excel-producto').click(function() {
        alert('Descargando reporte detallado de Productos en Excel...');
    });
    
    $('#descargar-excel-general').click(function() {
        alert('Descargando reporte general detallado en Excel...');
    });
    
    $('#filtrar_producto').click(function() {
        const inicio = $('#fecha_inicio_producto').val();
        const fin = $('#fecha_fin_producto').val();
        
        if (inicio && fin) {
            alert('Filtrando productos desde ' + inicio + ' hasta ' + fin);
            // Aquí actualizarías los gráficos con datos filtrados
        } else {
            alert('Selecciona ambas fechas para productos');
        }
    });
    
    $('#limpiar_producto').click(function() {
        $('#fecha_inicio_producto').val('');
        $('#fecha_fin_producto').val('');
        alert('Filtros de productos limpiados');
    });
});

function crearGraficoVisitadoras() {
    const ctx = document.getElementById('ventasChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosVentas.visitadoras.labels,
            datasets: [{
                label: 'Ventas (S/)',
                data: datosVentas.visitadoras.datos,
                backgroundColor: datosVentas.visitadoras.colores,
                borderColor: datosVentas.visitadoras.colores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas por Visitadora'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de visitadoras creado');
}

function crearGraficoPieVisitadoras() {
    const ctx = document.getElementById('ventasPieChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: datosVentas.visitadoras.labels,
            datasets: [{
                data: datosVentas.visitadoras.datos,
                backgroundColor: datosVentas.visitadoras.colores,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Ventas'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': S/ ' + context.parsed;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico pie de visitadoras creado');
}

function crearGraficoProductos() {
    const ctx = document.getElementById('productosChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosVentas.productos.labels,
            datasets: [{
                label: 'Ingresos (S/)',
                data: datosVentas.productos.datos,
                backgroundColor: datosVentas.productos.colores,
                borderColor: datosVentas.productos.colores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas por Producto'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de productos creado');
}

function crearGraficoProvincias() {
    const ctx = document.getElementById('provinciaChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosVentas.provincias.labels,
            datasets: [{
                label: 'Ventas (S/)',
                data: datosVentas.provincias.datos,
                backgroundColor: datosVentas.provincias.colores,
                borderColor: datosVentas.provincias.colores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Ventas por Provincia'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de provincias creado');
}

function crearGraficoPieProvincias() {
    const ctx = document.getElementById('provinciaPieChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: datosVentas.provincias.labels,
            datasets: [{
                data: datosVentas.provincias.datos,
                backgroundColor: datosVentas.provincias.colores,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Ventas por Provincia'
                },
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += 'S/ ' + context.parsed;
                            return label;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de pie provincias creado');
}

function crearGraficoReportesMes() {
    const ctx = document.getElementById('reportesMesChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosVentas.reportesMes.labels,
            datasets: [{
                label: 'Ventas por Mes (S/)',
                data: datosVentas.reportesMes.datos,
                backgroundColor: datosVentas.reportesMes.colores,
                borderColor: datosVentas.reportesMes.colores,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Reportes de Ventas por Mes'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de reportes por mes creado');
}

function crearGraficoVentasDia() {
    const ctx = document.getElementById('ventasDiaChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: datosVentas.ventasDia.labels,
            datasets: [{
                label: 'Ventas por Día (S/)',
                data: datosVentas.ventasDia.datos,
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia de Ventas Diarias'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de ventas por día creado');
}

function crearGraficoTendencia() {
    const ctx = document.getElementById('tendenciaChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: datosVentas.tendencia.labels,
            datasets: [{
                label: 'Ventas (S/)',
                data: datosVentas.tendencia.datos,
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia Mensual de Ventas'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'S/ ' + value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de tendencia creado');
}
</script>
@endsection