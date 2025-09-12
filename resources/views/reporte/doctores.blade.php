@extends('adminlte::page')

@section('title', 'Reporte de Doctores')

@section('content_header')
    <h1><i class="fas fa-user-md text-primary"></i> Reporte de Doctores</h1>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@stop

@section('content')
<div class="container-fluid">
    <div class="card bg-light">
        <div class="card-header bg-white">
            <ul class="nav nav-tabs card-header-tabs" id="doctoresTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="tipo-doctor-tab" data-toggle="tab" data-target="#tipo-doctor" type="button" role="tab">
                        <i class="fas fa-stethoscope"></i> Tipo Doctor
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="doctor-tab" data-toggle="tab" data-target="#doctor" type="button" role="tab">
                        <i class="fas fa-user-md"></i> Doctor
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <div class="tab-content" id="doctoresTabsContent">
                @include('reporte.componentes.doctores.tipo-doctor')
                @include('reporte.componentes.doctores.doctor')
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
const datosDoctores = {
    tipos: {
        labels: ['Prescriptor', 'Comprador', 'En Progreso'],
        datos: [45, 20, 10],
        colores: ['#dc3545', '#28a745', '#ffc107'],
        meses: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            prescriptor: [40, 42, 38, 45, 48, 50, 47, 52, 49, 55, 53, 58],
            comprador: [18, 19, 17, 20, 22, 21, 20, 23, 22, 25, 24, 26],
            progreso: [8, 9, 7, 10, 11, 9, 8, 12, 10, 13, 11, 14]
        }
    },
    doctores: {
        'Dr. Juan Pérez': {
            especialidad: 'Cardiología',
            meses: [2500, 3200, 2800, 3500, 4100, 3800, 4200, 3900, 4500, 4300, 4700, 5000],
            productos: ['Vitaminas', 'Medicamentos', 'Suplementos'],
            datosProductos: [1200, 1800, 1500]
        },
        'Dra. María García': {
            especialidad: 'Pediatría',
            meses: [2200, 2800, 2600, 3200, 3800, 3500, 4000, 3700, 4200, 4100, 4500, 4800],
            productos: ['Vitaminas', 'Jarabe', 'Suplementos'],
            datosProductos: [1100, 1600, 1400]
        }
    }
};

$(document).ready(function() {
    console.log('Iniciando reportes de doctores...');
    
    // Configurar datepickers
    flatpickr('#anio_tipo_doctor', {
        dateFormat: 'Y',
        locale: 'es'
    });
    
    flatpickr('#anio_doctor', {
        dateFormat: 'Y',
        locale: 'es'
    });

    // Crear gráficos iniciales
    crearGraficoTipoDoctor();
    crearGraficoPieTipoDoctor();
    
    // Mostrar doctor por defecto
    const doctorPorDefecto = 'Dr. Juan Pérez';
    $('#buscador_doctor').val(doctorPorDefecto);
    crearGraficoDoctor(doctorPorDefecto);
    crearGraficoProductosDoctor(doctorPorDefecto);

    // Eventos
    $('#filtrar_tipo_doctor').click(function() {
        const anio = $('#anio_tipo_doctor').val();
        if (anio) {
            alert('Filtrando tipos de doctor para el año ' + anio);
        } else {
            alert('Selecciona un año');
        }
    });
    
    $('#filtrar_doctor').click(function() {
        const doctor = $('#buscador_doctor').val();
        const anio = $('#anio_doctor').val();
        
        if (doctor && anio) {
            // Mostrar info del doctor
            if (datosDoctores.doctores[doctor]) {
                $('#doctor-nombre').text(doctor);
                $('#doctor-info').show();
                crearGraficoDoctor(doctor);
                crearGraficoProductosDoctor(doctor);
                alert('Mostrando datos de ' + doctor + ' para ' + anio);
            } else {
                alert('Doctor no encontrado');
            }
        } else {
            alert('Ingresa nombre del doctor y año');
        }
    });
    
    $('#limpiar_doctor').click(function() {
        $('#buscador_doctor').val('');
        $('#anio_doctor').val('');
        $('#doctor-info').hide();
        alert('Filtros limpiados');
    });
    
    // Botones de descarga
    $('#descargar-excel-tipo-doctor').click(function() {
        alert('Descargando reporte de tipos de doctor en Excel...');
    });
    
    $('#descargar-excel-doctor').click(function() {
        alert('Descargando reporte del doctor en Excel...');
    });
});

function crearGraficoTipoDoctor() {
    const ctx = document.getElementById('tipoDoctorChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: datosDoctores.tipos.meses.labels,
            datasets: [{
                label: 'Prescriptor',
                data: datosDoctores.tipos.meses.prescriptor,
                backgroundColor: '#dc3545',
                borderColor: '#dc3545',
                borderWidth: 1
            }, {
                label: 'Comprador',
                data: datosDoctores.tipos.meses.comprador,
                backgroundColor: '#28a745',
                borderColor: '#28a745',
                borderWidth: 1
            }, {
                label: 'En Progreso',
                data: datosDoctores.tipos.meses.progreso,
                backgroundColor: '#ffc107',
                borderColor: '#ffc107',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Evolución Mensual por Tipo de Doctor'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });
    console.log('Gráfico de tipos de doctor creado');
}

function crearGraficoPieTipoDoctor() {
    const ctx = document.getElementById('tipoDoctorPieChart');
    if (!ctx) return;
    
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: datosDoctores.tipos.labels,
            datasets: [{
                data: datosDoctores.tipos.datos,
                backgroundColor: datosDoctores.tipos.colores,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribución de Doctores por Tipo'
                },
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
    console.log('Gráfico de pie tipos de doctor creado');
}

function crearGraficoDoctor(doctorNombre) {
    const ctx = document.getElementById('doctorChart');
    if (!ctx) return;
    
    const doctor = datosDoctores.doctores[doctorNombre];
    const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    
    // Actualizar información del doctor
    $('#doctor-nombre').text(doctorNombre);
    $('#doctor-info p').text('Especialidad: ' + doctor.especialidad);
    
    // Destruir gráfico anterior si existe
    if (window.doctorChartInstance) {
        window.doctorChartInstance.destroy();
    }
    
    window.doctorChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Ventas (S/)',
                data: doctor.meses,
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
                    text: 'Ventas Mensuales de ' + doctorNombre
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
    console.log('Gráfico del doctor creado para:', doctorNombre);
}

function crearGraficoProductosDoctor(doctorNombre) {
    const ctx = document.getElementById('doctorProductosChart');
    if (!ctx) return;
    
    const doctor = datosDoctores.doctores[doctorNombre];
    
    // Destruir gráfico anterior si existe
    if (window.doctorProductosChartInstance) {
        window.doctorProductosChartInstance.destroy();
    }
    
    window.doctorProductosChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: doctor.productos,
            datasets: [{
                label: 'Ventas por Producto (S/)',
                data: doctor.datosProductos,
                backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                borderColor: ['#007bff', '#28a745', '#ffc107'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Productos Más Vendidos por ' + doctorNombre
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
    console.log('Gráfico de productos del doctor creado para:', doctorNombre);
}
</script>
@endsection