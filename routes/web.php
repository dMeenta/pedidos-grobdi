<?php

use App\Http\Controllers\ajustes\UbigeoController;
use App\Http\Controllers\ajustes\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Modulo - MUESTRAS
use App\Http\Controllers\muestras\MuestrasController;
use App\Http\Controllers\muestras\gerenciaController;

//Modulo - Reports
use App\Http\Controllers\ReportsController;

use App\Http\Controllers\pedidos\laboratorio\PresentacionFarmaceuticaController;
use App\Http\Controllers\pedidos\produccion\OrdenesController;
use App\Http\Controllers\pedidos\reportes\FormatosController;
use App\Http\Controllers\rutas\enrutamiento\EnrutamientoController;
use App\Http\Controllers\rutas\visita\VisitaDoctorController;
//COTIZADOR GENERAL
use App\Http\Controllers\cotizador\ProductoFinalController;
use App\Http\Controllers\cotizador\BaseController;
use App\Http\Controllers\cotizador\InsumoEmpaqueController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\rutas\mantenimiento\CategoriaDoctorController;
//cruds separados de envase, material e insumo
use App\Http\Controllers\cotizador\EnvaseController;
use App\Http\Controllers\cotizador\MaterialController;
use App\Http\Controllers\cotizador\InsumoController;
use App\Http\Controllers\rutas\enrutamiento\RutasVisitadoraController;
//softlyn modulos
use App\Http\Controllers\softlyn\VolumenController;
use App\Http\Controllers\softlyn\ProveedorController;
use App\Http\Controllers\softlyn\TipoCambioController;
use App\Http\Controllers\softlyn\MerchandiseController;
use App\Http\Controllers\softlyn\CompraController;
use App\Http\Controllers\softlyn\UtilController;

// use App\Http\Middleware\RoleMiddleware;

// use Auth;
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Modulo de Muestras
Route::prefix('muestras')
    ->middleware(['checkRole:admin,visitador,coordinador-lineas,jefe-comercial,contabilidad,jefe-operaciones,laboratorio'])
    ->group(function () {

        Route::get("/", [MuestrasController::class, 'index'])->name('muestras.index');
        Route::get("/export", [MuestrasController::class, 'exportExcel'])->name('muestras.exportExcel');
        Route::delete('/disable/{id}', [MuestrasController::class, 'disableMuestra'])->name('muestras.disable')->middleware(['checkRole:admin,coordinador-lineas,jefe-comercial,jefe-operaciones']);
        Route::get('/{id}', [MuestrasController::class, 'show'])->name('muestras.show');

        Route::prefix('/create')->middleware(['checkRole:admin,coordinador-lineas,visitador'])->group(function () {
            Route::get("/form", [MuestrasController::class, 'create'])->name('muestras.create');
            Route::post("/", [MuestrasController::class, 'store'])->name('muestras.store');
        });

        Route::prefix('edit')->middleware(['checkRole:admin,coordinador-lineas'])->group(function () {
            Route::get('/{id}', [MuestrasController::class, 'edit'])->name('muestras.edit');
            Route::put('/{id}', [MuestrasController::class, 'update'])->name('muestras.update');
            Route::put('/{id}/update-tipo-muestra', [MuestrasController::class, 'updateTipoMuestra'])->name('muestras.updateTipoMuestra');
            Route::put('/{id}/update-fecha-hora-entrega', [MuestrasController::class, 'updateDateTimeScheduled'])->name('muestras.updateDateTimeScheduled');
        });

        Route::prefix('laboratorio')->middleware(['checkRole:admin,laboratorio'])->group(function () {
            Route::put('/{id}/comentario', [MuestrasController::class, 'updateComentarioLab'])->name('muestras.updateComentarioLab');
            Route::put('/{id}/state', [MuestrasController::class, 'markAsElaborated'])->name('muestras.markAsElaborated');
        });

        /* ---- CONTABILIDAD --- */

        Route::put('/{id}/update-price', [MuestrasController::class, 'updatePrice'])->name('muestras.update_price')->middleware(['checkRole:contabilidad,admin']);

        /* ---- APROBACIONES --- */

        //Coordinadora
        Route::middleware(['checkRole:coordinador-lineas,admin'])->group(function () {
            Route::put('/aprove-coordinador', [MuestrasController::class, 'aproveMuestraByCoordinadora']);
        });
        //Jefe Comercial
        Route::middleware(['checkRole:jefe-comercial,admin'])->group(function () {
            Route::put('/aprove-jcomercial', [MuestrasController::class, 'aproveMuestraByJefeComercial']);
        });
        //Jefe de Operaciones
        Route::middleware(['checkRole:jefe-operaciones,admin'])->group(function () {
            Route::put('/aprove-joperaciones', [MuestrasController::class, 'aproveMuestraByJefeOperaciones']);
        });
    });

Route::get('/doctors/search', [DoctorController::class, 'showByNameLike'])->name('doctors.search')->middleware(['checkRole:admin,coordinador-lineas,visitador']);

Route::prefix('reports')
    ->middleware(['checkRole:admin'])
    ->group(function () {

        Route::prefix('visitadoras')->group(function () {
            Route::get('/', [ReportsController::class, 'indexVisitadoras'])->name('reports.visitadoras.index');
            Route::get('/distritos/{zoneId}', [ReportsController::class, 'getDistritosByZone'])->name('getDistritosByZone');
            Route::get('/filter', [ReportsController::class, 'filterVisitasDoctor'])->name('reports.visitas.filter');
        });
    });


//COUNTER
Route::middleware(['checkRole:counter,admin,Administracion'])->group(function () {

    Route::get('pedido/{id}/state', [PedidosController::class, 'showDeliveryStates'])->name('pedidos.showDeliveryStates');

    // Route::resource('cargarpedidos', PedidosController::class);
    Route::resource('cargarpedidos', CargarPedidosController::class);
    Route::post('/cargarpedidosdetail', CargarPedidosController::class . '@cargarExcelArticulos')->name('cargarpedidos.excelarticulos');
    Route::post('/cargarpedidos/articulos/store', CargarPedidosController::class . '@storeArticulos')->name('cargarpedidos.articulos.store');
    Route::get('/cargarpedidos/{pedido}/uploadfile', CargarPedidosController::class . '@uploadfile')->name('cargarpedidos.uploadfile');
    Route::put('/cargarpedidos/cargarImagen/{post}', CargarPedidosController::class . '@cargarImagen')->name('cargarpedidos.cargarImagen');
    Route::put('/cargarpedidos/actualizarPago/{post}', CargarPedidosController::class . '@actualizarPago')->name('cargarpedidos.actualizarPago');
    Route::put('/cargarpedidos/cargarImagenReceta/{post}', CargarPedidosController::class . '@cargarImagenReceta')->name('cargarpedidos.cargarImagenReceta');
    Route::delete('cargarpedidos/eliminarFotoVoucher/{id}', CargarPedidosController::class . '@eliminarFotoVoucher')->name('cargarpedidos.eliminarFotoVoucher');
    Route::put('/cargarpedidos/actualizarTurno/{id}', CargarPedidosController::class . '@actualizarTurno')->name('cargarpedidos.actualizarTurno');
    
    // New routes for preview functionality
    Route::get('/cargarpedidos/preview/changes', CargarPedidosController::class . '@preview')->name('cargarpedidos.preview');
    Route::post('/cargarpedidos/confirm/changes', CargarPedidosController::class . '@confirmChanges')->name('cargarpedidos.confirm');
    Route::post('/cargarpedidos/cancel/changes', CargarPedidosController::class . '@cancelChanges')->name('cargarpedidos.cancel');
    
    // New routes for articles preview functionality
    Route::get('/cargarpedidos/preview/articulos', CargarPedidosController::class . '@previewArticulos')->name('cargarpedidos.preview-articulos');
    Route::post('/cargarpedidos/confirm/articulos', CargarPedidosController::class . '@confirmArticulos')->name('cargarpedidos.confirm-articulos');
    Route::post('/cargarpedidos/cancel/articulos', CargarPedidosController::class . '@cancelArticulos')->name('cargarpedidos.cancel-articulos');
    
    Route::get('/pedidos/sincronizar', CargarPedidosController::class . '@sincronizarDoctoresPedidos')->name('pedidos.sincronizar');
    Route::get('/api/doctores/search', CargarPedidosController::class . '@searchDoctores')->name('api.doctores.search');
    
    // Incluir ruta de prueba
    require __DIR__.'/test.php';
    
    Route::resource('asignarpedidos', AsignarPedidoController::class);
    Route::post('/cargarpedidos/downloadWord', CargarPedidosController::class . '@downloadWord')
        ->name('cargarpedidos.downloadWord');
});
//counter - jefe de operaciones -laboratorio
Route::get('historialpedidos', HistorialPedidosController::class . '@index')
    ->name('historialpedidos.index')
    ->middleware(['checkRole:counter,admin,jefe-operaciones,laboratorio,Administracion']);
Route::get('historialpedidos/{historialpedido}', HistorialPedidosController::class . '@show')
    ->name('historialpedidos.show')
    ->middleware(['checkRole:counter,admin,jefe-operaciones,laboratorio,Administracion']);
//Jefe de operaciones
Route::delete('historialpedidos/{historialpedido}', HistorialPedidosController::class . '@destroy')
    ->name('historialpedidos.destroy')
    ->middleware(['checkRole:admin,jefe-operaciones,Administracion']);
Route::put('historial/{historialpedido}/actualizar', HistorialPedidosController::class . '@update')
    ->name('historialpedidos.update')
    ->middleware(['checkRole:admin,jefe-operaciones,Administracion']);
Route::resource('usuarios', UsuariosController::class)->middleware(['checkRole:admin,jefe-operaciones']);
Route::put('/usuarios/changepass/{fecha}', UsuariosController::class . '@changepass')
    ->name('usuarios.changepass')
    ->middleware(['checkRole:admin,jefe-operaciones']);
Route::get('sincronizarpedidos', [CargarPedidosController::class, 'sincronizarDoctoresPedidos'])
    ->name('pedidos.sincronizar')
    ->middleware(['checkRole:admin,jefe-operaciones']);

Route::resource('pedidoscontabilidad', PedidosContaController::class)->middleware(['checkRole:contabilidad,admin']);
Route::get('/pedidoscontabilidad/downloadExcel/{fechainicio}/{fechafin}', PedidosContaController::class . '@downloadExcel')
    ->name('pedidoscontabilidad.downloadExcel')
    ->middleware(['checkRole:contabilidad,admin']);

//ADMINISTRACION
Route::get('hoja-ruta-motorizado', [PedidosController::class, 'exportHojaDeRutaByMotorizadoForm'])->name('export.hojaDeRuta')->middleware(['checkRole:admin,Administracion']);
Route::post('export-hoja-ruta-motorizado', [PedidosController::class, 'exportHojaDeRutaByMotorizadoExcel'])->name('motorizado.exportHojaDeRuta')->middleware(['checkRole:admin,Administracion']);

Route::post('excelhojaruta', FormatosController::class . '@excelhojaruta')->name('formatos.excelhojaruta');

//MOTORIZADO
Route::resource('pedidosmotorizado', PedidosMotoController::class)->middleware(['checkRole:motorizado,admin']);
Route::put('/pedidosmotorizado/fotos/{id}', [PedidosMotoController::class, 'cargarFotos'])->name('pedidosmotorizado.cargarfotos')->middleware(['checkRole:motorizado,admin']);

Route::put('/pedidos-motorizado/{id}', [PedidosMotoController::class, 'updatePedidoByMotorizado'])->name('pedidosmotorizado.updatePedidoByMotorizado')->middleware(['checkRole:motorizado,admin']);

//SUPERVISOR
Route::middleware(['checkRole:supervisor,admin'])->group(function () {
    Route::resource('centrosalud', CentroSaludController::class);
    Route::post('centrosalud/creacionflotante', [CentroSaludController::class, 'creacionRapida'])->name('centrosalud.crearflorante');
    Route::resource('especialidad', EspecialidadController::class);
    Route::resource('doctor', DoctorController::class);
    Route::post('/doctor/cargadata', [DoctorController::class, 'cargadata'])->name('doctor.cargadata');
    Route::resource('lista', ListaController::class);
    Route::get('/enrutamiento', [EnrutamientoController::class, 'index'])->name('enrutamiento.index');
    Route::post('/enrutamiento/store', [EnrutamientoController::class, 'store'])->name('enrutamiento.store');
    Route::post('/enrutamientolista/store', [EnrutamientoController::class, 'Enrutamientolistastore'])->name('enrutamientolista.store');
    Route::get('/enrutamiento/{id}', [EnrutamientoController::class, 'agregarLista'])->name('enrutamiento.agregarlista');
    Route::get('/enrutamientolista/{id}', [EnrutamientoController::class, 'DoctoresLista'])->name('enrutamientolista.doctores');
    Route::put('/enrutamientolista/doctor/{id}', [EnrutamientoController::class, 'DoctoresListaUpdate'])->name('enrutamientolista.doctoresupdate');
    Route::post('/visitadoctornuevo/{id}/aprobar', [VisitaDoctorController::class, 'aprobar']);
    Route::post('/visitadoctornuevo/{id}/rechazar', [VisitaDoctorController::class, 'rechazar']);
    Route::resource('categoriadoctor', CategoriaDoctorController::class);
});
//VISITADOR
Route::middleware(['checkRole:visitador,admin'])->group(function () {

    Route::resource('visitadoctor', VisitaDoctorController::class);


    Route::get('calendariovisitadora', [EnrutamientoController::class, 'calendariovisitadora'])->name('enrutamientolista.calendariovisitadora');
    Route::get('/rutasdoctor/{id}', [EnrutamientoController::class, 'DetalleDoctorRutas']);
    Route::get('/detalle-visita-doctor/{id}', [VisitaDoctorController::class, 'FindDetalleVisitaByID']);
    Route::put('/update-visita-doctor/{id}', [VisitaDoctorController::class, 'UpdateVisitaDoctor'])->name('rutas.guardarvisita');
    Route::post('guardar-visita', [EnrutamientoController::class, 'GuardarVisita'])->name('rutas.guardarvisita');
    Route::get('rutasvisitadora', [RutasVisitadoraController::class, 'index'])->name('rutasvisitadora.index');
    Route::get('rutasvisitadora/{id}', [RutasVisitadoraController::class, 'listadoctores'])->name('rutasvisitadora.listadoctores');
    Route::post('/rutasvisitadora/asignar', [RutasVisitadoraController::class, 'asignar'])->name('rutasvisitadora.asignar');
    Route::get('/rutasvisitadora/buscardoctor/{cmp}', [DoctorController::class, 'buscarCMP']);
    Route::post('/rutasvisitadora/doctores', [DoctorController::class, 'guardarDoctorVisitador']);
    Route::get('centrosaludbuscar', CentroSaludController::class . '@buscar')->name('centrosalud.buscar');

    Route::get('ruta-mapa', [VisitaDoctorController::class, 'mapa'])->name('ruta.mapa');
});



Route::get('/distritoslimacallao', UbigeoController::class . '@ObtenerDistritosLimayCallao')
    ->name('distritoslimacallao');

//laboratorio
Route::middleware(['checkRole:laboratorio,admin'])->group(function () {
    Route::resource('pedidoslaboratorio', PedidoslabController::class);

    Route::get('/get-unidades/{clasificacionId}', [MuestrasController::class, 'getUnidadesPorClasificacion']);

    Route::get('/pedidoslaboratorio/{fecha}/downloadWord/{turno}', PedidoslabController::class . '@downloadWord')
        ->name('pedidoslaboratorio.downloadWord');
    Route::post('/pedidoslaboratorio/cambio-masivo', [PedidoslabController::class, 'cambioMasivo'])->name('pedidoslaboratorio.cambioMasivo');
    Route::get('/pedidoslaboratoriodetalles', [PedidoslabController::class, 'pedidosDetalles'])->name('pedidosLaboratorio.detalles');
    Route::put('pedidoslaboratoriodetalles/asignar/{id}/', [PedidoslabController::class, 'asignarTecnicoProd'])->name('pedidosLaboratorio.asignarTecnicoProd');
    Route::post('/pedidoslaboratoriodetalles/asignarmultiple', [PedidoslabController::class, 'asignarmultipletecnico'])->name('pedidosLaboratorio.asignarmultipletecnico');

    Route::resource('presentacionfarmaceutica', PresentacionFarmaceuticaController::class);
    Route::get('ingredientes/{base_id}', [PresentacionFarmaceuticaController::class, 'listaringredientes'])->name('ingredientes.index');
    Route::post('base', [PresentacionFarmaceuticaController::class, 'guardarbases'])->name('base.store');
    Route::post('ingredientes', [PresentacionFarmaceuticaController::class, 'guardaringredientes'])->name('ingredientes.store');
    Route::put('ingredientes/{id}', [PresentacionFarmaceuticaController::class, 'actualizaringredientes'])->name('ingredientes.update');
    Route::post('excipientes', [PresentacionFarmaceuticaController::class, 'guardarexcipientes'])->name('excipientes.store');
    Route::delete('excipientes/{id}', [PresentacionFarmaceuticaController::class, 'eliminarexcipientes'])->name('excipientes.delete');
});
//ROL DE TECNICA DE PRODUCCION
Route::get('pedidosproduccion', OrdenesController::class . '@index')->name('produccion.index')->middleware(['checkRole:tecnico_produccion,admin']);
Route::post('pedidosproduccion/{detalleId}/actualizarestado', [OrdenesController::class, 'actualizarEstado'])->name('pedidosproduccion.actualizarEstado');
// Ruta para actualizar el precio de una muestra
// Ruta para la gestión de precios en la vista de jefe de proyectos


//JEFE COMERCIAL
Route::middleware(['checkRole:jefe-comercial,admin'])->group(function () {
    Route::resource('categoriadoctor', CategoriaDoctorController::class);
    Route::get('/ventascliente', [PedidosController::class, 'listPedCliente'])->name('pedidosxcliente.listar');
});

/*
EN REVISIÓN, REPORTES DE MUESTRAS PARA GERENCIA
*/

//GERENCIACONTROLLER
Route::middleware(['checkRole:gerencia-general,admin'])->group(function () {

    // REVISION //
    //Reporte gerencia - Clasificaciones
    Route::get('/reporte', [gerenciaController::class, 'mostrarReporte'])->name('muestras.reporte');

    // REVISION //
    //Reporte Gerencia frasco original
    Route::get('/reporte/frasco-original', [gerenciaController::class, 'mostrarReporteFrascoOriginal'])->name('muestras.reporte.frasco-original');

    // REVISION //
    //Reporte Gerencia Frasco Muestra
    Route::get('/reporte/frasco-muestra', [gerenciaController::class, 'mostrarReporteFrascoMuestra'])->name('muestras.reporte.frasco-muestra');

    // REVISION //
    //exportar pdf en Reportes
    Route::get('reporte/PDF-frascoMuestra', [gerenciaController::class, 'exportarPDF'])->name('muestras.exportarPDF');

    // REVISION //
    Route::get('reporte/PDF-frascoOriginal', [gerenciaController::class, 'exportarPDFFrascoOriginal'])->name('muestras.frasco.original.pdf');
});

//COTIZADOR GENERAL----------
//modulos del softlyn
Route::middleware(['checkRole:Administracion,admin'])->group(function () {
    //Administración
    Route::resource('insumo_empaque', InsumoEmpaqueController::class);
    // CRUDs separados para envases, material e insumos
    Route::resource('envases', EnvaseController::class);
    Route::resource('material', MaterialController::class);
    Route::resource('insumos', InsumoController::class);
    //Crud proveedores
    Route::resource('proveedores', ProveedorController::class)->parameters([
        'proveedores' => 'proveedor'
    ]);
    //Crud tipo de cambio- EL PRINCIPAL ES RESUMEN-TIPO-CAMBIO!!!
    Route::resource('tipo_cambio', TipoCambioController::class);
    Route::get('/resumen-tipo-cambio', [TipoCambioController::class, 'resumenTipoCambio'])->name('tipo_cambio.resumen');
    Route::delete('/tipo-cambio/{id}', [TipoCambioController::class, 'destroy'])->name('tipo_cambio.destroy');

    //crud para merchandise
    Route::resource('merchandise', MerchandiseController::class);
    //Ruta para utiles
    Route::resource('util', UtilController::class);
    //crud compras
    Route::resource('compras', CompraController::class);
    // CRUD Guía de Ingreso
    Route::resource('guia_ingreso', \App\Http\Controllers\softlyn\GuiaIngresoController::class);
    // Ruta AJAX para obtener detalles de compra
    Route::get('lotes/por-articulo/{articulo_id}', [\App\Http\Controllers\softlyn\GuiaIngresoController::class, 'getLotesPorArticulo'])->name('lotes.por_articulo');
    Route::get('guia_ingreso/detalles-compra/{compra_id}', [\App\Http\Controllers\softlyn\GuiaIngresoController::class, 'getDetallesCompra'])->name('guia_ingreso.detalles_compra');
});

Route::middleware(['checkRole:Administracion,admin'])->group(function () {
    // Rutas estándar del CRUD
    Route::resource('producto_final', ProductoFinalController::class);

    //crud volumen
    Route::resource('volumen', VolumenController::class);

    //Laboratorio 
    Route::resource('bases', BaseController::class);
    // Rutas adicionales para AJAX
    /* Route::get('articulos/por-tipo', [CompraController::class, 'getArticulosByTipo'])
        ->name('articulos.por-tipo');
    */
});

Route::middleware(['checkRole:contabilidad,admin'])->group(function () {
    //contabilidad  marcará si el insumo es caro o no
    Route::get('/insumo/marcar-caro', [InsumoController::class, 'marcarCaro'])->name('insumos.marcar-caro');
    Route::post('/insumo/marcar-caro', [InsumoController::class, 'actualizarEsCaro'])->name('insumos.actualizar-es-caro');
});
