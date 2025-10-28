<?php

use App\Http\Controllers\ajustes\ModuleController;
use App\Http\Controllers\ajustes\RolesController;
use App\Http\Controllers\ajustes\UbigeoController;
use App\Http\Controllers\ajustes\UsuariosController;
use App\Http\Controllers\ajustes\ViewController;
use App\Http\Controllers\pedidos\comercial\PedidosComercialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\pedidos\laboratorio\PedidoslabController;
use App\Http\Controllers\pedidos\contabilidad\PedidosContaController;
use App\Http\Controllers\pedidos\counter\AsignarPedidoController;
use App\Http\Controllers\pedidos\counter\CargarPedidosController;
use App\Http\Controllers\pedidos\counter\HistorialPedidosController;
use App\Http\Controllers\pedidos\Motorizado\PedidosMotoController;
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
use App\Http\Controllers\Visitadoras\Metas\GoalNotReachedConfigController;
use App\Http\Controllers\Visitadoras\Metas\MetasController;
use App\Http\Controllers\Visitadoras\Metas\VisitorGoalController;

// use App\Http\Middleware\RoleMiddleware;

// use Auth;
Auth::routes();
Route::middleware(['check.permission'])->group(function () {
    // Reprogramar visita doctor
    Route::post('/rutasvisitadora/reprogramar', [\App\Http\Controllers\rutas\enrutamiento\RutasVisitadoraController::class, 'reprogramar'])
        ->name('rutasvisitadora.reprogramar')
        ->middleware('can:rutasvisitadora.reprogramar');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Modulo de Muestras
    Route::prefix('muestras')->group(function () {
        Route::get("/", [MuestrasController::class, 'index'])->name('muestras.index');
        Route::get("/export", [MuestrasController::class, 'exportExcel'])->name('muestras.exportExcel');
        Route::delete('/disable/{muestra}', [MuestrasController::class, 'disableMuestra'])->name('muestras.disable');
        Route::get('/{id}', [MuestrasController::class, 'show'])->name('muestras.show');
        Route::get("create/form", [MuestrasController::class, 'create'])->name('muestras.create');
        Route::post("create/", [MuestrasController::class, 'store'])->name('muestras.store');
        Route::get('edit/{muestra}', [MuestrasController::class, 'edit'])->name('muestras.edit');
        Route::put('edit/{muestra}', [MuestrasController::class, 'update'])->name('muestras.update');
        Route::put('edit/{muestra}/update-tipo-muestra', [MuestrasController::class, 'updateTipoMuestra'])->name('muestras.updateTipoMuestra');
        Route::put('edit/{muestra}/update-fecha-hora-entrega', [MuestrasController::class, 'updateDateTimeScheduled'])->name('muestras.updateDateTimeScheduled');

        Route::put('laboratorio/{muestra}/comentario', [MuestrasController::class, 'updateComentarioLab'])->name('muestras.updateComentarioLab');
        Route::put('laboratorio/{muestra}/state', [MuestrasController::class, 'markAsElaborated'])->name('muestras.markAsElaborated');

        /* ---- CONTABILIDAD --- */
        Route::put('/{muestra}/update-price', [MuestrasController::class, 'updatePrice'])->name('muestras.updatePrice');

        /* ---- APROBACIONES --- */

        //Coordinadora
        Route::put('/aprove-coordinador/{muestra}', [MuestrasController::class, 'aproveMuestraByCoordinadora'])->name('muestras.aproveCoordinadora');
        //Jefe Comercial
        Route::put('/aprove-jcomercial/{muestra}', [MuestrasController::class, 'aproveMuestraByJefeComercial'])->name('muestras.aproveJefeComercial');
        //Jefe de Operaciones
        Route::put('/aprove-joperaciones/{muestra}', [MuestrasController::class, 'aproveMuestraByJefeOperaciones'])->name('muestras.aproveJefeOperaciones');
    });

    Route::prefix('visitadoras')->group(function () {
        Route::get("/metas", [MetasController::class, 'index'])->name('visitadoras.metas');
        Route::get("/metas/crear", [MetasController::class, 'form'])->name('visitadoras.metas.form');
        Route::post('/metas/store', [MetasController::class, 'store'])->name('visitadoras.metas.store');
        Route::post('/metas/details/{visitorGoalId}', [MetasController::class, 'getDataForChartByVisitorGoal'])->name('visitadoras.metas.details');
        Route::post('/metas/not-reached-config/store', [GoalNotReachedConfigController::class, 'store'])->name('visitadoras.metas.not-reached-config.store');
        Route::get('/metas/not-reached-config/active', [GoalNotReachedConfigController::class, 'showActive'])->name('visitadoras.metas.not-reached-config.active');
        Route::put('/metas/update-debited-amount/{visitorGoal}', [VisitorGoalController::class, 'updateDebitedAmount'])->name('visitadoras.metas.update.debited-amount');

    });

    Route::get('pedidoscomercial', [PedidosComercialController::class, 'index'])->name('pedidoscomercial.index');
    Route::get('pedidoscomercial/export', [PedidosComercialController::class, 'export'])->name('pedidoscomercial.export');

    Route::get('/doctors/search', [DoctorController::class, 'showByNameLike'])->name('doctors.search');
    //COUNTER
    Route::get('pedido/{id}/state', [PedidosController::class, 'showDeliveryStates'])->name('pedidos.showDeliveryStates');

    // Route::resource('cargarpedidos', PedidosController::class);
    Route::resource('cargarpedidos', CargarPedidosController::class);
    Route::post('/cargarpedidosdetail', CargarPedidosController::class . '@cargarExcelArticulos')->name('cargarpedidos.excelarticulos');
    Route::post('/cargarpedidos/articulos/store', CargarPedidosController::class . '@storeArticulos')->name('cargarpedidos.articulos.store');
    Route::get('/cargarpedidos/{pedido}/uploadfile', [CargarPedidosController::class, 'uploadfile'])->name('cargarpedidos.uploadfile');
    Route::put('/cargarpedidos/cargarImagen/{id}', CargarPedidosController::class . '@cargarImagen')->name('cargarpedidos.cargarImagen');
    Route::put('/cargarpedidos/actualizarPago/{id}', CargarPedidosController::class . '@actualizarPago')->name('cargarpedidos.actualizarPago');
    Route::put('/cargarpedidos/cargarImagenReceta/{id}', CargarPedidosController::class . '@cargarImagenReceta')->name('cargarpedidos.cargarImagenReceta');
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

    Route::resource('asignarpedidos', AsignarPedidoController::class);
    Route::post('/cargarpedidos/downloadWord', CargarPedidosController::class . '@downloadWord')->name('cargarpedidos.downloadWord');
    //counter - jefe de operaciones -laboratorio
    Route::get('historialpedidos', HistorialPedidosController::class . '@index')->name('historialpedidos.index');
    Route::get('historialpedidos/{historialpedido}', HistorialPedidosController::class . '@show')->name('historialpedidos.show');
    //Jefe de operaciones
    Route::delete('historialpedidos/{historialpedido}', HistorialPedidosController::class . '@destroy')->name('historialpedidos.destroy');
    Route::put('historial/{historialpedido}/actualizar', HistorialPedidosController::class . '@update')->name('historialpedidos.update');
    Route::resource('usuarios', UsuariosController::class);
    Route::put('/usuarios/changepass/{fecha}', UsuariosController::class . '@changepass')->name('usuarios.changepass');
    Route::resource('roles', RolesController::class);
    Route::get('roles/{role}/permissions', [RolesController::class, 'permissions'])->name('roles.permissions');
    Route::put('roles/{role}/permissions', [RolesController::class, 'updatePermissions'])->name('roles.updatePermissions');
    Route::resource('modules', ModuleController::class);
    Route::resource('views', ViewController::class);
    Route::resource('pedidoscontabilidad', PedidosContaController::class);
    Route::get('/pedidoscontabilidad/downloadExcel/{fechainicio}/{fechafin}', PedidosContaController::class . '@downloadExcel')->name('pedidoscontabilidad.downloadExcel');

    //ADMINISTRACION
    Route::get('hoja-ruta-motorizado', [PedidosController::class, 'exportHojaDeRutaByMotorizadoForm'])->name('motorizado.viewFormHojaDeRuta');
    Route::post('export-hoja-ruta-motorizado', [PedidosController::class, 'exportHojaDeRutaByMotorizadoExcel'])->name('motorizado.exportHojaDeRuta');

    Route::post('excelhojaruta', FormatosController::class . '@excelhojaruta')->name('formatos.excelhojaruta');

    //MOTORIZADO
    Route::resource('pedidosmotorizado', PedidosMotoController::class);
    Route::put('/pedidosmotorizado/fotos/{id}', [PedidosMotoController::class, 'cargarFotos'])->name('pedidosmotorizado.cargarfotos');

    Route::put('/pedidos-motorizado/{id}', [PedidosMotoController::class, 'updatePedidoByMotorizado'])->name('pedidosmotorizado.updatePedidoByMotorizado');

    //SUPERVISOR
    Route::resource('centrosalud', CentroSaludController::class);
    Route::post('centrosalud/creacionflotante', [CentroSaludController::class, 'creacionRapida'])->name('centrosalud.crearflorante');
    Route::resource('especialidad', EspecialidadController::class);
    Route::get('/doctor/export', [DoctorController::class, 'export'])->name('doctor.export');
    Route::resource('doctor', DoctorController::class);
    Route::post('/doctor/cargadata', [DoctorController::class, 'cargadata'])->name('doctor.cargadata');
    Route::resource('lista', ListaController::class);
    Route::get('/enrutamiento', [EnrutamientoController::class, 'index'])->name('enrutamiento.index');
    Route::post('/enrutamiento/store', [EnrutamientoController::class, 'store'])->name('enrutamiento.store');
    Route::post('/enrutamientolista/store', [EnrutamientoController::class, 'Enrutamientolistastore'])->name('enrutamientolista.store');
    Route::get('/enrutamiento/{id}', [EnrutamientoController::class, 'agregarLista'])->name('enrutamiento.agregarlista');
    Route::get('/enrutamientolista/{id}', [EnrutamientoController::class, 'DoctoresLista'])->name('enrutamientolista.doctores');
    Route::post('/enrutamientolista/add-visita', [EnrutamientoController::class, 'addSpontaneousVisitaDoctor'])->name('visita.doctor.add.spontaneous');
    Route::put('/enrutamientolista/doctor/{id}', [EnrutamientoController::class, 'DoctoresListaUpdate'])->name('enrutamientolista.doctoresupdate');
    Route::delete('/enrutamientolista/doctor/{id}', [EnrutamientoController::class, 'destroyVisitaDoctor'])->name('enrutamientolista.doctoresdestroy');
    Route::post('/enrutamientolista/add-visita', [EnrutamientoController::class, 'addSpontaneousVisitaDoctor'])->name('visita.doctor.add.spontaneous');
    Route::post('/visitadoctornuevo/{id}/aprobar', [VisitaDoctorController::class, 'aprobar'])->name('doctor.aprobarVisita');
    Route::post('/visitadoctornuevo/{id}/rechazar', [VisitaDoctorController::class, 'rechazar'])->name('doctor.rechazarVisita');
    Route::resource('categoriadoctor', CategoriaDoctorController::class);

    Route::get('calendariovisitadora', [EnrutamientoController::class, 'calendariovisitadora'])->name('enrutamientolista.calendariovisitadora');
    Route::get('/rutasdoctor/{id}', [EnrutamientoController::class, 'DetalleDoctorRutas'])->name('rutas.detalledoctor');
    Route::get('/detalle-visita-doctor/{id}', [VisitaDoctorController::class, 'FindDetalleVisitaByID'])->name('rutasmapa.detallesdoctor');
    Route::put('/update-visita-doctor/{id}', [VisitaDoctorController::class, 'UpdateVisitaDoctor'])->name('rutasmapa.guardarvisita');
    Route::post('guardar-visita', [EnrutamientoController::class, 'GuardarVisita'])->name('rutas.guardarvisita');
    Route::get('rutasvisitadora', [RutasVisitadoraController::class, 'ListarMisRutas'])->name('rutasvisitadora.ListarMisRutas');
    Route::get('rutasvisitadora/{id}', [RutasVisitadoraController::class, 'listadoctores'])->name('rutasvisitadora.listadoctores');
    Route::post('/rutasvisitadora/asignar', [RutasVisitadoraController::class, 'asignar'])->name('rutasvisitadora.asignar');
    Route::get('/rutasvisitadora/buscardoctor/{cmp}', [DoctorController::class, 'buscarCMP'])->name('rutasvisitadora.buscarcmpdoctor');
    Route::post('/rutasvisitadora/doctores', [DoctorController::class, 'guardarDoctorVisitador'])->name('rutasvisitadora.guardardoctor');
    Route::get('centrosaludbuscar', CentroSaludController::class . '@buscar')->name('centrosalud.buscar');
    Route::post('/enrutamientolista/add-visita', [EnrutamientoController::class, 'addSpontaneousVisitaDoctor'])->name('visita.doctor.add.spontaneous');
    Route::get('ruta-mapa', [VisitaDoctorController::class, 'mapa'])->name('ruta.mapa');

    Route::get('/distritoslimacallao', UbigeoController::class . '@ObtenerDistritosLimayCallao')
        ->name('distritoslimacallao');

    //laboratorio
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
    //ROL DE TECNICA DE PRODUCCION
    Route::get('pedidosproduccion', OrdenesController::class . '@index')->name('produccion.index');
    Route::post('pedidosproduccion/{detalleId}/actualizarestado', [OrdenesController::class, 'actualizarEstado'])->name('pedidosproduccion.actualizarEstado');

    Route::prefix('reports')->group(function () {

        Route::prefix('rutas')->group(function () {
            Route::get('/', [ReportsController::class, 'rutasView'])->name('reports.rutas');

            Route::prefix('api/v1')->group(function () {
                Route::get('zones', [ReportsController::class, 'getZonesReport'])->name('reports.rutas.zones');
                Route::get('/distritos/{zoneId}', [ReportsController::class, 'getDistritosByZone'])->name('rutas.zones.distritos');
            });
        });

        Route::prefix('ventas')->group(function () {
            Route::get('/', [ReportsController::class, 'ventasView'])->name('reports.ventas');

            Route::prefix('api/v1')->group(function () {
                Route::get('general', [ReportsController::class, 'getGeneralReport'])->name('reports.ventas.general');
                Route::get('visitadoras', [ReportsController::class, 'getVisitadorasReport'])->name('reports.ventas.visitadoras');
                Route::get('productos', [ReportsController::class, 'getProductosReport'])->name('reports.ventas.productos');
                Route::get('provincias', [ReportsController::class, 'getProvinciasReport'])->name('reports.ventas.provincias');
                Route::get('detail-pedidos-by-departamento', [ReportsController::class, 'getPedidosDetailsByProvincia'])->name('reports.ventas.provincias.departamento');
            });
        });

        Route::prefix('doctores')->group(function () {
            Route::get('/', [ReportsController::class, 'doctorsView'])->name('reports.doctors');

            Route::prefix('api/v1')->group(function () {
                Route::get('doctors', [ReportsController::class, 'getDoctorReport'])->name('reports.doctores.doctores');
                Route::get('tipo-doctor', [ReportsController::class, 'getTipoDoctorReport'])->name('reports.doctores.tipo-doctor');
            });
        });
        Route::prefix('muestras')->group(function () {
            Route::get('/', [ReportsController::class, 'muestrasView'])->name('reports.muestras');
            Route::prefix('api/v1')->group(function () {
                Route::get('muestras', [ReportsController::class, 'getMuestrasReport'])->name('reports.muestras.api');
            });
        });

        Route::prefix('motorizados')->group(function () {
            Route::get('/', [ReportsController::class, 'muestrasView'])->name('reports.motorizados');
        });
    });

});

/*
EN REVISIÓN, REPORTES DE MUESTRAS PARA GERENCIA
*/

//GERENCIACONTROLLER

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


//COTIZADOR GENERAL----------
//modulos del softlyn
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
// Route::delete('/tipo-cambio/{id?}', [TipoCambioController::class, 'destroy'])->name('tipo_cambio.destroy');

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

//contabilidad  marcará si el insumo es caro o no
Route::get('/insumo/marcar-caro', [InsumoController::class, 'marcarCaro'])->name('insumos.marcar-caro');
Route::post('/insumo/marcar-caro', [InsumoController::class, 'actualizarEsCaro'])->name('insumos.actualizar-es-caro');
