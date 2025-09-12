@extends('adminlte::page')

@section('title', 'Reporte de Visitadoras')

@section('content_header')
    <h1><i class="fas fa-user-friends text-success"></i> Reporte de Visitadoras</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('content')
<div class="container-fluid">
    <div class="card bg-light">
        <div class="card-header bg-white">
            <ul class="nav nav-tabs card-header-tabs" id="visitadorasTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="rutas-tab" data-toggle="tab" data-target="#rutas" type="button" role="tab">
                        <i class="fas fa-route"></i> Rutas
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="visitadorasTabsContent">
                @include('reporte.componentes.visitadoras.rutas')
            </div>
        </div>
    </div>
</div>
@stop

@section('plugins.Chartjs', true)

@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Datos en memoria
const datosVisitadoras = {
    asignadosVisitados: {
        asignados: 125,
        visitados: 104,
        colores: ['#28a745', '#007bff']
    },
    visitasSemana: {
        labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        datos: [18, 22, 25, 20, 15, 4]
    },
    tendenciaMensual: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        asignados: [110, 115, 120, 125, 130, 125],
        visitados: [95, 98, 105, 110, 118, 104]
    },
    rutas: [
        { visitadora: 'María González', zona: 'Centro', distrito: 'Lima', asignados: 25, visitados: 22 },
        { visitadora: 'Carmen Rodríguez', zona: 'Norte', distrito: 'Breña', asignados: 30, visitados: 24 },
        { visitadora: 'Ana López', zona: 'Sur', distrito: 'Jesús María', asignados: 20, visitados: 18 },
        { visitadora: 'Patricia Sánchez', zona: 'Centro', distrito: 'Lima', asignados: 28, visitados: 21 },
        { visitadora: 'Rosa Martínez', zona: 'Norte', distrito: 'Breña', asignados: 22, visitados: 19 }
    ]
};

$(document).ready(function() {
    console.log('Iniciando reportes de visitadoras...');

    // Crear gráficos iniciales
    crearGraficoAsignadosVisitados();
    crearGraficoVisitasSemana();
    crearGraficoTendenciaMensual();
    actualizarEstadisticas();

    // Eventos
    $('#filtrar_rutas').click(function() {
        const mes = $('#mes_rutas').val();
        const zona = $('#zona_rutas').val();
        const distrito = $('#distrito_rutas').val();

        if (mes || zona || distrito) {
            alert('Filtrando rutas - Mes: ' + (mes || 'Todos') + ', Zona: ' + (zona || 'Todas') + ', Distrito: ' + (distrito || 'Todos'));
        } else {
            alert('Selecciona al menos un filtro');
        }
    });

    // Botón de descarga
    $('#descargar-excel-rutas').click(function() {
        alert('Descargando reporte de rutas en Excel...');
    });
});

function crearGraficoAsignadosVisitados() {
    const ctx = document.getElementById('asignadosVisitadosChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Asignados', 'Visitados'],
            datasets: [{
                data: [datosVisitadoras.asignadosVisitados.asignados, datosVisitadoras.asignadosVisitados.visitados],
                backgroundColor: datosVisitadoras.asignadosVisitados.colores,
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Visitas'
                },
                legend: {
                    display: false // Ocultamos la leyenda porque la tenemos al costado
                }
            }
        }
    });
    console.log('Gráfico circular asignados vs visitados creado');
}

function crearGraficoVisitasSemana() {
    const ctx = document.getElementById('visitasSemanaChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosVisitadoras.visitasSemana.labels,
            datasets: [{
                label: 'Visitas por Día',
                data: datosVisitadoras.visitasSemana.datos,
                backgroundColor: '#28a745',
                borderColor: '#28a745',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Visitas por Día de la Semana'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
    console.log('Gráfico de visitas por semana creado');
}

function crearGraficoTendenciaMensual() {
    const ctx = document.getElementById('tendenciaMensualChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: datosVisitadoras.tendenciaMensual.labels,
            datasets: [{
                label: 'Asignados',
                data: datosVisitadoras.tendenciaMensual.asignados,
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 2,
                fill: false,
                tension: 0.4
            }, {
                label: 'Visitados',
                data: datosVisitadoras.tendenciaMensual.visitados,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 2,
                fill: false,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Tendencia Mensual de Visitas'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    console.log('Gráfico de tendencia mensual creado');
}

function actualizarEstadisticas() {
    const asignados = datosVisitadoras.asignadosVisitados.asignados;
    const visitados = datosVisitadoras.asignadosVisitados.visitados;
    const porcentaje = Math.round((visitados / asignados) * 100);

    $('#total-asignados').text(asignados);
    $('#total-visitados').text(visitados);
    $('#porcentaje-completado').text(porcentaje + '%');
}
</script>
@endsection