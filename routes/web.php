<?php

use App\Http\Controllers\ajustes\UbigeoController;
use App\Http\Controllers\ajustes\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Route::get('/', function () {
    //     return view('home');
    // });
use App\Http\Controllers\pedidos\laboratorio\PedidoslabController;
use App\Http\Controllers\pedidos\contabilidad\PedidosContaController;
use App\Http\Controllers\pedidos\counter\AsignarPedidoController;
use App\Http\Controllers\pedidos\counter\CargarPedidosController;
use App\Http\Controllers\pedidos\counter\HistorialPedidosController;
use App\Http\Controllers\pedidos\Motorizado\PedidosMotoController;
use App\Http\Controllers\rutas\enrutamiento\AsignacionSemanal;
use App\Http\Controllers\rutas\enrutamiento\ListaController;
use App\Http\Controllers\rutas\mantenimiento\CentroSaludController;
use App\Http\Controllers\rutas\mantenimiento\DoctorController;
use App\Http\Controllers\rutas\mantenimiento\EspecialidadController;

//modulo muestras
use App\Http\Controllers\muestras\coordinadoraController;
use App\Http\Controllers\muestras\gerenciaController;
use App\Http\Controllers\muestras\JcomercialController;
use App\Http\Controllers\muestras\jefe_proyectosController;
use App\Http\Controllers\muestras\laboratorioController;
use App\Http\Controllers\muestras\MuestrasController;
use App\Http\Controllers\rutas\enrutamiento\EnrutamientoController;

// use App\Http\Middleware\RoleMiddleware;

// use Auth;
Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['checkRole:counter,admin'])->group(function () {
    
    // Route::resource('cargarpedidos', PedidosController::class);
    Route::resource('cargarpedidos', CargarPedidosController::class);
    Route::post('/cargarpedidosdetail',CargarPedidosController::class.'@cargarExcelArticulos')->name('cargarpedidos.excelarticulos');
    Route::get('/cargarpedidos/{pedido}/uploadfile', CargarPedidosController::class .'@uploadfile')->name('cargarpedidos.uploadfile');
    Route::put('/cargarpedidos/cargarImagen/{post}', CargarPedidosController::class .'@cargarImagen')->name('cargarpedidos.cargarImagen');
    Route::put('/cargarpedidos/cargarImagenReceta/{post}', CargarPedidosController::class .'@cargarImagenReceta')->name('cargarpedidos.cargarImagenReceta');
    
    Route::resource('/historialpedidos', HistorialPedidosController::class);
    Route::resource('asignarpedidos', AsignarPedidoController::class);
});
    
Route::resource('usuarios', UsuariosController::class)->middleware(['checkRole:admin']);
Route::put('/usuarios/changepass/{fecha}', UsuariosController::class .'@changepass')
    ->name('usuarios.changepass')
    ->middleware(['checkRole:admin']);



Route::get('/pedidoslaboratorio/{fecha}/downloadWord', PedidoslabController::class .'@downloadWord')
    ->name('pedidoslaboratorio.downloadWord')
    ->middleware(['checkRole:laboratorio,counter']);

Route::resource('pedidoscontabilidad', PedidosContaController::class)->middleware(['checkRole:contabilidad,admin']);
Route::get('/pedidoscontabilidad/downloadExcel/{fechainicio}/{fechafin}', PedidosContaController::class .'@downloadExcel')
    ->name('pedidoscontabilidad.downloadExcel')
    ->middleware(['checkRole:contabilidad,admin']);

    
Route::resource('pedidosmotorizado', PedidosMotoController::class)->middleware(['checkRole:motorizado,admin']);

Route::middleware(['checkRole:visitador,admin'])->group(function () {

    Route::resource('centrosalud', CentroSaludController::class);
    Route::get('centrosaludbuscar', CentroSaludController::class.'@buscar');
    Route::resource('especialidad', EspecialidadController::class);
    Route::resource('doctor', DoctorController::class);
    Route::post('/doctor/cargadata', [DoctorController::class, 'cargadata'])->name('doctor.cargadata');
    Route::resource('lista', ListaController::class);
    Route::get('/enrutamiento', [EnrutamientoController::class, 'index'])->name('enrutamiento.index');
    Route::post('/enrutamiento/store', [EnrutamientoController::class, 'store'])->name('enrutamiento.store');
    Route::post('/enrutamientolista/store', [EnrutamientoController::class, 'Enrutamientolistastore'])->name('enrutamientolista.store');
    Route::get('/enrutamiento/{id}', [EnrutamientoController::class, 'agregarLista'])->name('enrutamiento.agregarlista');
    //=============================Muestras - Modulo
    // Ruta principal que muestra todas las muestras
    Route::resource('muestras', MuestrasController::class);
});


Route::get('/diasdelmes', AsignacionSemanal::class .'@mostrarDiasDelMes')
    ->name('mostrarDiasDelMes');
Route::get('/prueba', function () {
    return view('pedidos.counter.cargar_pedido.prueba');
});

Route::get('/distritoslimacallao', UbigeoController::class .'@ObtenerDistritosLimayCallao')
    ->name('distritoslimacallao');
// Route::middleware(['checkRole:contabilidad'])->group(function () {
//     Route::resource('pedidoscontabilidad', PedidosContaController::class);
// });



//laboratorio======================
Route::middleware(['checkRole:laboratorio,admin'])->group(function () {
    Route::resource('pedidoslaboratorio', PedidoslabController::class);
    Route::get('/laboratorio', [laboratorioController::class, 'estado'])->name('muestras.estado');
    Route::put('/laboratorio/{id}/actualizar-estado', [laboratorioController::class, 'actualizarEstado'])
        ->name('muestras.actualizarEstado');
    Route::get('/laboratorio/{id}', [laboratorioController::class, 'showLab'])->name('muestras.showLab');
    Route::put('/laboratorio/{id}/actualizar-fecha', [laboratorioController::class, 'actualizarFechaEntrega'])->name('muestras.actualizarFechaEntrega');
    Route::get('/get-unidades/{clasificacionId}', [MuestrasController::class, 'getUnidadesPorClasificacion']);
    Route::put('/muestras/{id}/comentario', [laboratorioController::class, 'actualizarComentario'])->name('muestras.actualizarComentario');
});
// Ruta para actualizar el precio de una muestra
// Ruta para la gestión de precios en la vista de jefe de proyectos
Route::middleware(['checkRole:jefe-operaciones,admin'])->group(function () {
    Route::get('/jefe-operaciones', [jefe_proyectosController::class, 'precio'])->name('muestras.precio');
    Route::get('/jefe_proyectos/{id}', [jefe_proyectosController::class, 'show'])->name('muestras.show');
    Route::put('/muestras/{id}/actualizar-precio', [jefe_proyectosController::class, 'actualizarPrecio'])->name('muestras.actualizarPrecio');
});

//coordinadora 
//Aprobaciones

Route::middleware(['checkRole:coordinador-lineas,admin'])->group(function () {
    Route::get('/Coordinadora', [coordinadoraController::class, 'aprobacionCoordinadora'])->name('muestras.aprobacion.coordinadora');
    Route::put('/muestras/{id}/actualizar-fecha', [coordinadoraController::class, 'actualizarFechaEntrega'])->name('muestras.actualizarFechaEntrega');
    Route::get('/coordinadora/{id}', [coordinadoraController::class, 'showCo'])->name('muestras.showCo');
});

Route::put('/muestras/{id}/actualizar-aprobacion', [coordinadoraController::class, 'actualizarAprobacion'])->name('muestras.actualizarAprobacion')->middleware(['checkRole:jefe-comercial,coordinador-lineas,admin']);

//Jcomercial
Route::get('/jefe-comercial', [JcomercialController::class, 'confirmar'])->name('muestras.confirmar')->middleware(['checkRole:jefe-comercial,admin']);
Route::get('/jefe-comercial/{id}', [JcomercialController::class, 'show'])->name('muestras.show');

//GERENCIACONTROLLER
Route::middleware(['checkRole:gerencia-general,admin'])->group(function () {
    //Reporte gerencia - Clasificaciones
    Route::get('/reporte', [gerenciaController::class, 'mostrarReporte'])->name('muestras.reporte');
    //Reporte Gerencia frasco original
    Route::get('/reporte/frasco-original', [gerenciaController::class, 'mostrarReporteFrascoOriginal'])->name('muestras.reporte.frasco-original');
    //Reporte Gerencia Frasco Muestra
    Route::get('/reporte/frasco-muestra', [gerenciaController::class, 'mostrarReporteFrascoMuestra'])->name('muestras.reporte.frasco-muestra');
    //exportar pdf en Reportes
    Route::get('reporte/PDF-frascoMuestra', [gerenciaController::class, 'exportarPDF'])->name('muestras.exportarPDF');
    Route::get('reporte/PDF-frascoOriginal', [gerenciaController::class, 'exportarPDFFrascoOriginal'])->name('muestras.frasco.original.pdf');
});
