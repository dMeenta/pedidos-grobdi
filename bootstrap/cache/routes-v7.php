<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/adminlte/darkmode/toggle' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'adminlte.darkmode.toggle',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BjkCTIWbxub3kPV1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PDx0t2KiLf73HQNN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TrH31hT1cNjV3yvl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Lq9llPCifSGeGP2o',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DKtog214YVvh4s8x',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/muestras' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/muestras/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.exportExcel',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/muestras/create/form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoscomercial' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscomercial.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoscomercial/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscomercial.export',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/doctors/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctors.search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidosdetail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.excelarticulos',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/articulos/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.articulos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/preview/changes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.preview',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/confirm/changes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/cancel/changes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.cancel',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/preview/articulos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.preview-articulos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/confirm/articulos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.confirm-articulos',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cargarpedidos/cancel/articulos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.cancel-articulos',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidos/sincronizar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidos.sincronizar',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/doctores/search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.doctores.search',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/asignarpedidos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/asignarpedidos/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/historialpedidos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'historialpedidos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/usuarios/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'roles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/modules' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'modules.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'modules.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/modules/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'modules.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/views' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'views.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'views.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/views/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'views.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoscontabilidad' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoscontabilidad/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hoja-ruta-motorizado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'motorizado.viewFormHojaDeRuta',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export-hoja-ruta-motorizado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'motorizado.exportHojaDeRuta',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/excelhojaruta' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'formatos.excelhojaruta',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidosmotorizado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidosmotorizado/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrosalud' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrosalud/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/especialidad' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/especialidad/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/doctor/export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.export',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/doctor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/doctor/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/lista' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lista.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'lista.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/lista/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lista.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/enrutamiento' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamiento.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/enrutamiento/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamiento.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/enrutamientolista/store' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamientolista.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/categoriadoctor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/categoriadoctor/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/calendariovisitadora' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamientolista.calendariovisitadora',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guardar-visita' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutas.guardarvisita',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/rutasvisitadora' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasvisitadora.ListarMisRutas',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/centrosaludbuscar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.buscar',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ruta-mapa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruta.mapa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/distritoslimacallao' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'distritoslimacallao',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoslaboratorio' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoslaboratorio/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoslaboratoriodetalles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosLaboratorio.detalles',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidoslaboratoriodetalles/asignarmultiple' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosLaboratorio.asignarmultipletecnico',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presentacionfarmaceutica' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/presentacionfarmaceutica/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/base' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'base.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ingredientes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ingredientes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/excipientes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'excipientes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pedidosproduccion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'produccion.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/rutas' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.rutas',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/rutas/api/v1/zones' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.rutas.zones',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas/api/v1/general' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas.general',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas/api/v1/visitadoras' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas.visitadoras',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas/api/v1/productos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas.productos',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas/api/v1/provincias' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas.provincias',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/ventas/api/v1/detail-pedidos-by-departamento' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.ventas.provincias.departamento',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/doctores' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.doctors',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/doctores/api/v1/doctors' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.doctores.doctores',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/doctores/api/v1/tipo-doctor' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.doctores.tipo-doctor',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/muestras' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.muestras',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reports/muestras/api/v1/muestras' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reports.muestras.api',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reporte' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.reporte',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reporte/frasco-original' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.reporte.frasco-original',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reporte/frasco-muestra' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.reporte.frasco-muestra',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reporte/PDF-frascoMuestra' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.exportarPDF',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reporte/PDF-frascoOriginal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.frasco.original.pdf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/insumo_empaque' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/insumo_empaque/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/envases' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'envases.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'envases.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/envases/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'envases.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/material' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'material.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/material/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/insumos' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/insumos/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proveedores' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/proveedores/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipo_cambio' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tipo_cambio/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/resumen-tipo-cambio' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.resumen',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/merchandise' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/merchandise/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/util' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'util.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'util.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/util/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'util.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/compras' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'compras.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'compras.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/compras/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'compras.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guia_ingreso' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guia_ingreso/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/producto_final' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/producto_final/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/volumen' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/volumen/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bases' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bases.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'bases.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bases/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bases.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/insumo/marcar-caro' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.marcar-caro',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.actualizar-es-caro',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5PlmlYfDNQYnYJGb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/p(?|assword/reset/([^/]++)(*:34)|edido(?|/([^/]++)/state(*:64)|s(?|contabilidad/(?|([^/]++)(?|(*:102)|/edit(*:115)|(*:123))|downloadExcel/([^/]++)/([^/]++)(*:163))|motorizado/(?|([^/]++)(?|(*:197)|/edit(*:210)|(*:218))|fotos/([^/]++)(*:241))|\\-motorizado/([^/]++)(*:271)|laboratorio(?|/(?|([^/]++)(?|(*:308)|/(?|edit(*:324)|downloadWord/([^/]++)(*:353))|(*:362))|cambio\\-masivo(*:385))|detalles/asignar/([^/]++)(*:419))|produccion/([^/]++)/actualizarestado(*:464)))|r(?|esentacionfarmaceutica/([^/]++)(?|(*:512)|/edit(*:525)|(*:533))|o(?|veedores/([^/]++)(?|(*:566)|/edit(*:579)|(*:587))|ducto_final/([^/]++)(?|(*:619)|/edit(*:632)|(*:640)))))|/m(?|uestras/(?|disable/([^/]++)(*:684)|([^/]++)(*:700)|create(*:714)|edit/([^/]++)(?|(*:738)|/update\\-(?|tipo\\-muestra(*:771)|fecha\\-hora\\-entrega(*:799)))|laboratorio/([^/]++)/(?|comentario(*:843)|state(*:856))|([^/]++)/update\\-price(*:887)|aprove\\-(?|coordinador(*:917)|j(?|comercial(*:938)|operaciones(*:957))))|odules/([^/]++)(?|(*:986)|/edit(*:999)|(*:1007))|aterial/([^/]++)(?|(*:1036)|/edit(*:1050)|(*:1059))|erchandise/([^/]++)(?|(*:1091)|/edit(*:1105)|(*:1114)))|/c(?|a(?|rgarpedidos/(?|([^/]++)(?|(*:1160)|/(?|edit(*:1177)|uploadfile(*:1196))|(*:1206))|cargarImagen(?|/([^/]++)(*:1240)|Receta/([^/]++)(*:1264))|actualizar(?|Pago/([^/]++)(*:1300)|Turno/([^/]++)(*:1323))|eliminarFotoVoucher/([^/]++)(*:1361)|downloadWord(*:1382))|tegoriadoctor/([^/]++)(?|(*:1417)|/edit(*:1431)|(*:1440)))|entrosalud/(?|([^/]++)(?|(*:1476)|/edit(*:1490)|(*:1499))|creacionflotante(*:1525))|ompras/([^/]++)(?|(*:1553)|/edit(*:1567)|(*:1576)))|/asignarpedidos/([^/]++)(?|(*:1614)|/edit(*:1628)|(*:1637))|/historial(?|pedidos/([^/]++)(?|(*:1679))|/([^/]++)/actualizar(*:1709))|/u(?|suarios/(?|([^/]++)(?|(*:1746)|/edit(*:1760)|(*:1769))|changepass/([^/]++)(*:1798))|pdate\\-visita\\-doctor/([^/]++)(*:1838)|til/([^/]++)(?|(*:1862)|/edit(*:1876)|(*:1885)))|/r(?|oles/([^/]++)(?|(*:1917)|/(?|edit(*:1934)|permissions(?|(*:1957)))|(*:1968))|utas(?|doctor/([^/]++)(*:2000)|visitadora/(?|([^/]++)(*:2031)|asignar(*:2047)|buscardoctor/([^/]++)(*:2077)|doctores(*:2094)))|eports/rutas/api/v1/distritos/([^/]++)(*:2143))|/v(?|i(?|ews/([^/]++)(?|(*:2177)|/edit(*:2191)|(*:2200))|sitadoctornuevo/([^/]++)/(?|aprobar(*:2245)|rechazar(*:2262)))|olumen/([^/]++)(?|(*:2291)|/edit(*:2305)|(*:2314)))|/e(?|specialidad/([^/]++)(?|(*:2353)|/edit(*:2367)|(*:2376))|n(?|rutamiento(?|/([^/]++)(*:2412)|lista/(?|([^/]++)(*:2438)|doctor/([^/]++)(*:2462)))|vases/([^/]++)(?|(*:2490)|/edit(*:2504)|(*:2513)))|xcipientes/([^/]++)(*:2543))|/d(?|octor/(?|([^/]++)(?|(*:2578)|/edit(*:2592)|(*:2601))|cargadata(*:2620))|etalle\\-visita\\-doctor/([^/]++)(*:2661))|/l(?|ista/([^/]++)(?|(*:2692)|/edit(*:2706)|(*:2715))|otes/por\\-articulo/([^/]++)(*:2752))|/g(?|et\\-unidades/([^/]++)(*:2788)|uia_ingreso/(?|([^/]++)(?|(*:2823)|/edit(*:2837)|(*:2846))|detalles\\-compra/([^/]++)(*:2881)))|/in(?|gredientes/([^/]++)(?|(*:2920)|(*:2929))|sumo(?|_empaque/([^/]++)(?|(*:2966)|/edit(*:2980)|(*:2989))|s/([^/]++)(?|(*:3012)|/edit(*:3026)|(*:3035))))|/tipo_cambio/([^/]++)(?|(*:3071)|/edit(*:3085)|(*:3094))|/bases/([^/]++)(?|(*:3122)|/edit(*:3136)|(*:3145))|/storage/(.*)(*:3168))/?$}sDu',
    ),
    3 => 
    array (
      34 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      64 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidos.showDeliveryStates',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      102 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.show',
          ),
          1 => 
          array (
            0 => 'pedidoscontabilidad',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      115 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.edit',
          ),
          1 => 
          array (
            0 => 'pedidoscontabilidad',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      123 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.update',
          ),
          1 => 
          array (
            0 => 'pedidoscontabilidad',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.destroy',
          ),
          1 => 
          array (
            0 => 'pedidoscontabilidad',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      163 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoscontabilidad.downloadExcel',
          ),
          1 => 
          array (
            0 => 'fechainicio',
            1 => 'fechafin',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      197 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.show',
          ),
          1 => 
          array (
            0 => 'pedidosmotorizado',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      210 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.edit',
          ),
          1 => 
          array (
            0 => 'pedidosmotorizado',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      218 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.update',
          ),
          1 => 
          array (
            0 => 'pedidosmotorizado',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.destroy',
          ),
          1 => 
          array (
            0 => 'pedidosmotorizado',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      241 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.cargarfotos',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      271 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosmotorizado.updatePedidoByMotorizado',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      308 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.show',
          ),
          1 => 
          array (
            0 => 'pedidoslaboratorio',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      324 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.edit',
          ),
          1 => 
          array (
            0 => 'pedidoslaboratorio',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      353 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.downloadWord',
          ),
          1 => 
          array (
            0 => 'fecha',
            1 => 'turno',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      362 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.update',
          ),
          1 => 
          array (
            0 => 'pedidoslaboratorio',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.destroy',
          ),
          1 => 
          array (
            0 => 'pedidoslaboratorio',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      385 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidoslaboratorio.cambioMasivo',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      419 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosLaboratorio.asignarTecnicoProd',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      464 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pedidosproduccion.actualizarEstado',
          ),
          1 => 
          array (
            0 => 'detalleId',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      512 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.show',
          ),
          1 => 
          array (
            0 => 'presentacionfarmaceutica',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      525 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.edit',
          ),
          1 => 
          array (
            0 => 'presentacionfarmaceutica',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      533 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.update',
          ),
          1 => 
          array (
            0 => 'presentacionfarmaceutica',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'presentacionfarmaceutica.destroy',
          ),
          1 => 
          array (
            0 => 'presentacionfarmaceutica',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      566 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.show',
          ),
          1 => 
          array (
            0 => 'proveedor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      579 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.edit',
          ),
          1 => 
          array (
            0 => 'proveedor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      587 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.update',
          ),
          1 => 
          array (
            0 => 'proveedor',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'proveedores.destroy',
          ),
          1 => 
          array (
            0 => 'proveedor',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      619 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.show',
          ),
          1 => 
          array (
            0 => 'producto_final',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      632 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.edit',
          ),
          1 => 
          array (
            0 => 'producto_final',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      640 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.update',
          ),
          1 => 
          array (
            0 => 'producto_final',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'producto_final.destroy',
          ),
          1 => 
          array (
            0 => 'producto_final',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      684 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.disable',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      700 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      714 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.store',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      738 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.edit',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      771 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.updateTipoMuestra',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      799 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.updateDateTimeScheduled',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      843 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.updateComentarioLab',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      856 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.markAsElaborated',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      887 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.updatePrice',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      917 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.aproveCoordinadora',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      938 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.aproveJefeComercial',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      957 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'muestras.aproveJefeOperaciones',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      986 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'modules.show',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      999 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'modules.edit',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1007 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'modules.update',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'modules.destroy',
          ),
          1 => 
          array (
            0 => 'module',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1036 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.show',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1050 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.edit',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1059 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'material.update',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'material.destroy',
          ),
          1 => 
          array (
            0 => 'material',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1091 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.show',
          ),
          1 => 
          array (
            0 => 'merchandise',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1105 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.edit',
          ),
          1 => 
          array (
            0 => 'merchandise',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1114 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.update',
          ),
          1 => 
          array (
            0 => 'merchandise',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'merchandise.destroy',
          ),
          1 => 
          array (
            0 => 'merchandise',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1160 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.show',
          ),
          1 => 
          array (
            0 => 'cargarpedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1177 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.edit',
          ),
          1 => 
          array (
            0 => 'cargarpedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1196 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.uploadfile',
          ),
          1 => 
          array (
            0 => 'pedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1206 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.update',
          ),
          1 => 
          array (
            0 => 'cargarpedido',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.destroy',
          ),
          1 => 
          array (
            0 => 'cargarpedido',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1240 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.cargarImagen',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1264 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.cargarImagenReceta',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1300 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.actualizarPago',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1323 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.actualizarTurno',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1361 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.eliminarFotoVoucher',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1382 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cargarpedidos.downloadWord',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1417 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.show',
          ),
          1 => 
          array (
            0 => 'categoriadoctor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1431 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.edit',
          ),
          1 => 
          array (
            0 => 'categoriadoctor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1440 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.update',
          ),
          1 => 
          array (
            0 => 'categoriadoctor',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'categoriadoctor.destroy',
          ),
          1 => 
          array (
            0 => 'categoriadoctor',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1476 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.show',
          ),
          1 => 
          array (
            0 => 'centrosalud',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1490 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.edit',
          ),
          1 => 
          array (
            0 => 'centrosalud',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1499 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.update',
          ),
          1 => 
          array (
            0 => 'centrosalud',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.destroy',
          ),
          1 => 
          array (
            0 => 'centrosalud',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1525 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'centrosalud.crearflorante',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1553 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'compras.show',
          ),
          1 => 
          array (
            0 => 'compra',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1567 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'compras.edit',
          ),
          1 => 
          array (
            0 => 'compra',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1576 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'compras.update',
          ),
          1 => 
          array (
            0 => 'compra',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'compras.destroy',
          ),
          1 => 
          array (
            0 => 'compra',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1614 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.show',
          ),
          1 => 
          array (
            0 => 'asignarpedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1628 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.edit',
          ),
          1 => 
          array (
            0 => 'asignarpedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1637 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.update',
          ),
          1 => 
          array (
            0 => 'asignarpedido',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'asignarpedidos.destroy',
          ),
          1 => 
          array (
            0 => 'asignarpedido',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1679 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'historialpedidos.show',
          ),
          1 => 
          array (
            0 => 'historialpedido',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'historialpedidos.destroy',
          ),
          1 => 
          array (
            0 => 'historialpedido',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1709 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'historialpedidos.update',
          ),
          1 => 
          array (
            0 => 'historialpedido',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1746 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.show',
          ),
          1 => 
          array (
            0 => 'usuario',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1760 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.edit',
          ),
          1 => 
          array (
            0 => 'usuario',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1769 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.update',
          ),
          1 => 
          array (
            0 => 'usuario',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.destroy',
          ),
          1 => 
          array (
            0 => 'usuario',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1798 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'usuarios.changepass',
          ),
          1 => 
          array (
            0 => 'fecha',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1838 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasmapa.guardarvisita',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1862 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'util.show',
          ),
          1 => 
          array (
            0 => 'util',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1876 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'util.edit',
          ),
          1 => 
          array (
            0 => 'util',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1885 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'util.update',
          ),
          1 => 
          array (
            0 => 'util',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'util.destroy',
          ),
          1 => 
          array (
            0 => 'util',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1917 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.show',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1934 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1957 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.permissions',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'roles.updatePermissions',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1968 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'roles.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'roles.destroy',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2000 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutas.detalledoctor',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2031 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasvisitadora.listadoctores',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2047 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasvisitadora.asignar',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2077 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasvisitadora.buscarcmpdoctor',
          ),
          1 => 
          array (
            0 => 'cmp',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2094 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasvisitadora.guardardoctor',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2143 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutas.zones.distritos',
          ),
          1 => 
          array (
            0 => 'zoneId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2177 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'views.show',
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2191 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'views.edit',
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2200 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'views.update',
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'views.destroy',
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2245 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.aprobarVisita',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2262 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.rechazarVisita',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2291 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.show',
          ),
          1 => 
          array (
            0 => 'voluman',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.edit',
          ),
          1 => 
          array (
            0 => 'voluman',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2314 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.update',
          ),
          1 => 
          array (
            0 => 'voluman',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'volumen.destroy',
          ),
          1 => 
          array (
            0 => 'voluman',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2353 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.show',
          ),
          1 => 
          array (
            0 => 'especialidad',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2367 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.edit',
          ),
          1 => 
          array (
            0 => 'especialidad',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2376 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.update',
          ),
          1 => 
          array (
            0 => 'especialidad',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'especialidad.destroy',
          ),
          1 => 
          array (
            0 => 'especialidad',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2412 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamiento.agregarlista',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamientolista.doctores',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2462 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'enrutamientolista.doctoresupdate',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2490 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'envases.show',
          ),
          1 => 
          array (
            0 => 'envase',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2504 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'envases.edit',
          ),
          1 => 
          array (
            0 => 'envase',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2513 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'envases.update',
          ),
          1 => 
          array (
            0 => 'envase',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'envases.destroy',
          ),
          1 => 
          array (
            0 => 'envase',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2543 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'excipientes.delete',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2578 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.show',
          ),
          1 => 
          array (
            0 => 'doctor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2592 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.edit',
          ),
          1 => 
          array (
            0 => 'doctor',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2601 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.update',
          ),
          1 => 
          array (
            0 => 'doctor',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.destroy',
          ),
          1 => 
          array (
            0 => 'doctor',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2620 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'doctor.cargadata',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2661 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'rutasmapa.detallesdoctor',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2692 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lista.show',
          ),
          1 => 
          array (
            0 => 'listum',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2706 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lista.edit',
          ),
          1 => 
          array (
            0 => 'listum',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2715 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lista.update',
          ),
          1 => 
          array (
            0 => 'listum',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'lista.destroy',
          ),
          1 => 
          array (
            0 => 'listum',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2752 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'lotes.por_articulo',
          ),
          1 => 
          array (
            0 => 'articulo_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2788 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7lLICD5KUZGffqir',
          ),
          1 => 
          array (
            0 => 'clasificacionId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2823 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.show',
          ),
          1 => 
          array (
            0 => 'guia_ingreso',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2837 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.edit',
          ),
          1 => 
          array (
            0 => 'guia_ingreso',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2846 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.update',
          ),
          1 => 
          array (
            0 => 'guia_ingreso',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.destroy',
          ),
          1 => 
          array (
            0 => 'guia_ingreso',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2881 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guia_ingreso.detalles_compra',
          ),
          1 => 
          array (
            0 => 'compra_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2920 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ingredientes.index',
          ),
          1 => 
          array (
            0 => 'base_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2929 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ingredientes.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2966 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.show',
          ),
          1 => 
          array (
            0 => 'insumo_empaque',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2980 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.edit',
          ),
          1 => 
          array (
            0 => 'insumo_empaque',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2989 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.update',
          ),
          1 => 
          array (
            0 => 'insumo_empaque',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'insumo_empaque.destroy',
          ),
          1 => 
          array (
            0 => 'insumo_empaque',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3012 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.show',
          ),
          1 => 
          array (
            0 => 'insumo',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3026 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.edit',
          ),
          1 => 
          array (
            0 => 'insumo',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3035 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.update',
          ),
          1 => 
          array (
            0 => 'insumo',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'insumos.destroy',
          ),
          1 => 
          array (
            0 => 'insumo',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.show',
          ),
          1 => 
          array (
            0 => 'tipo_cambio',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3085 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.edit',
          ),
          1 => 
          array (
            0 => 'tipo_cambio',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3094 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.update',
          ),
          1 => 
          array (
            0 => 'tipo_cambio',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'tipo_cambio.destroy',
          ),
          1 => 
          array (
            0 => 'tipo_cambio',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3122 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bases.show',
          ),
          1 => 
          array (
            0 => 'basis',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3136 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bases.edit',
          ),
          1 => 
          array (
            0 => 'basis',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3145 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bases.update',
          ),
          1 => 
          array (
            0 => 'basis',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'bases.destroy',
          ),
          1 => 
          array (
            0 => 'basis',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3168 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'adminlte.darkmode.toggle' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'adminlte/darkmode/toggle',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'JeroenNoten\\LaravelAdminLte\\Http\\Controllers\\DarkModeController@toggle',
        'controller' => 'JeroenNoten\\LaravelAdminLte\\Http\\Controllers\\DarkModeController@toggle',
        'as' => 'adminlte.darkmode.toggle',
        'namespace' => NULL,
        'prefix' => 'adminlte',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BjkCTIWbxub3kPV1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000ad00000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::BjkCTIWbxub3kPV1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PDx0t2KiLf73HQNN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:853:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'C:\\\\Users\\\\progr\\\\Desktop\\\\proyectos\\\\sistema_grobdi\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000f700000000000000000";}}',
        'as' => 'generated::PDx0t2KiLf73HQNN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TrH31hT1cNjV3yvl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::TrH31hT1cNjV3yvl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Lq9llPCifSGeGP2o' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Lq9llPCifSGeGP2o',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DKtog214YVvh4s8x' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::DKtog214YVvh4s8x',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'muestras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@index',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@index',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.exportExcel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'muestras/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@exportExcel',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@exportExcel',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.exportExcel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.disable' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'muestras/disable/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@disableMuestra',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@disableMuestra',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.disable',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'muestras/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@show',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@show',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'muestras/create/form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@create',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@create',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'muestras/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@store',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@store',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'muestras/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@edit',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@edit',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.edit',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/edit/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@update',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@update',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.updateTipoMuestra' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/edit/{id}/update-tipo-muestra',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateTipoMuestra',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateTipoMuestra',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.updateTipoMuestra',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.updateDateTimeScheduled' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/edit/{id}/update-fecha-hora-entrega',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateDateTimeScheduled',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateDateTimeScheduled',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.updateDateTimeScheduled',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.updateComentarioLab' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/laboratorio/{id}/comentario',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateComentarioLab',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updateComentarioLab',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.updateComentarioLab',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.markAsElaborated' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/laboratorio/{id}/state',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@markAsElaborated',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@markAsElaborated',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.markAsElaborated',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.updatePrice' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/{id}/update-price',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updatePrice',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@updatePrice',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.updatePrice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.aproveCoordinadora' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/aprove-coordinador',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByCoordinadora',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByCoordinadora',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.aproveCoordinadora',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.aproveJefeComercial' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/aprove-jcomercial',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByJefeComercial',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByJefeComercial',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.aproveJefeComercial',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.aproveJefeOperaciones' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'muestras/aprove-joperaciones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByJefeOperaciones',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@aproveMuestraByJefeOperaciones',
        'namespace' => NULL,
        'prefix' => '/muestras',
        'where' => 
        array (
        ),
        'as' => 'muestras.aproveJefeOperaciones',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscomercial.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscomercial',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\comercial\\PedidosComercialController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\comercial\\PedidosComercialController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidoscomercial.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscomercial.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscomercial/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\comercial\\PedidosComercialController@export',
        'controller' => 'App\\Http\\Controllers\\pedidos\\comercial\\PedidosComercialController@export',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidoscomercial.export',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctors.search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctors/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@showByNameLike',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@showByNameLike',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'doctors.search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidos.showDeliveryStates' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedido/{id}/state',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\PedidosController@showDeliveryStates',
        'controller' => 'App\\Http\\Controllers\\PedidosController@showDeliveryStates',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidos.showDeliveryStates',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/{cargarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/{cargarpedido}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'cargarpedidos/{cargarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'cargarpedidos/{cargarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'cargarpedidos.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.excelarticulos' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidosdetail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarExcelArticulos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarExcelArticulos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.excelarticulos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.articulos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/articulos/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@storeArticulos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@storeArticulos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.articulos.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.uploadfile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/{pedido}/uploadfile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@uploadfile',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@uploadfile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.uploadfile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.cargarImagen' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'cargarpedidos/cargarImagen/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarImagen',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarImagen',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.cargarImagen',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.actualizarPago' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'cargarpedidos/actualizarPago/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@actualizarPago',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@actualizarPago',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.actualizarPago',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.cargarImagenReceta' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'cargarpedidos/cargarImagenReceta/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarImagenReceta',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cargarImagenReceta',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.cargarImagenReceta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.eliminarFotoVoucher' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'cargarpedidos/eliminarFotoVoucher/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@eliminarFotoVoucher',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@eliminarFotoVoucher',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.eliminarFotoVoucher',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.actualizarTurno' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'cargarpedidos/actualizarTurno/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@actualizarTurno',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@actualizarTurno',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.actualizarTurno',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.preview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/preview/changes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@preview',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@preview',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.preview',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/confirm/changes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@confirmChanges',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@confirmChanges',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.cancel' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/cancel/changes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cancelChanges',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cancelChanges',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.cancel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.preview-articulos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cargarpedidos/preview/articulos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@previewArticulos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@previewArticulos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.preview-articulos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.confirm-articulos' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/confirm/articulos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@confirmArticulos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@confirmArticulos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.confirm-articulos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.cancel-articulos' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/cancel/articulos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cancelArticulos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@cancelArticulos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.cancel-articulos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidos.sincronizar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidos/sincronizar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@sincronizarDoctoresPedidos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@sincronizarDoctoresPedidos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidos.sincronizar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.doctores.search' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/doctores/search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@searchDoctores',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@searchDoctores',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'api.doctores.search',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'asignarpedidos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'asignarpedidos/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'asignarpedidos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'asignarpedidos/{asignarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'asignarpedidos/{asignarpedido}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'asignarpedidos/{asignarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'asignarpedidos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'asignarpedidos/{asignarpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'asignarpedidos.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\AsignarPedidoController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cargarpedidos.downloadWord' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cargarpedidos/downloadWord',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@downloadWord',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\CargarPedidosController@downloadWord',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'cargarpedidos.downloadWord',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'historialpedidos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'historialpedidos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'historialpedidos.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'historialpedidos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'historialpedidos/{historialpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'historialpedidos.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'historialpedidos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'historialpedidos/{historialpedido}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'historialpedidos.destroy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'historialpedidos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'historial/{historialpedido}/actualizar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\counter\\HistorialPedidosController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'historialpedidos.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.index',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@index',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.create',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@create',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'usuarios',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.store',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@store',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/{usuario}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.show',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@show',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'usuarios/{usuario}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.edit',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@edit',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'usuarios/{usuario}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.update',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@update',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'usuarios/{usuario}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'usuarios.destroy',
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@destroy',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'usuarios.changepass' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'usuarios/changepass/{fecha}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@changepass',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UsuariosController@changepass',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'usuarios.changepass',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.index',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@index',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.create',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@create',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.store',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@store',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.show',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@show',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.edit',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@edit',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.update',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@update',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'roles.destroy',
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@destroy',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.permissions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles/{role}/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@permissions',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@permissions',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'roles.permissions',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'roles.updatePermissions' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'roles/{role}/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ajustes\\RolesController@updatePermissions',
        'controller' => 'App\\Http\\Controllers\\ajustes\\RolesController@updatePermissions',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'roles.updatePermissions',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'modules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.index',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@index',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'modules/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.create',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@create',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'modules',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.store',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@store',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.show',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@show',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'modules/{module}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.edit',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@edit',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.update',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@update',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'modules.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'modules/{module}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'modules.destroy',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ModuleController@destroy',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ModuleController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'views',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.index',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@index',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'views/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.create',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@create',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'views',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.store',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@store',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'views/{view}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.show',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@show',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'views/{view}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.edit',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@edit',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'views/{view}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.update',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@update',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'views.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'views/{view}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'views.destroy',
        'uses' => 'App\\Http\\Controllers\\ajustes\\ViewController@destroy',
        'controller' => 'App\\Http\\Controllers\\ajustes\\ViewController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscontabilidad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscontabilidad/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidoscontabilidad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscontabilidad/{pedidoscontabilidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscontabilidad/{pedidoscontabilidad}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'pedidoscontabilidad/{pedidoscontabilidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'pedidoscontabilidad/{pedidoscontabilidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoscontabilidad.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoscontabilidad.downloadExcel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoscontabilidad/downloadExcel/{fechainicio}/{fechafin}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@downloadExcel',
        'controller' => 'App\\Http\\Controllers\\pedidos\\contabilidad\\PedidosContaController@downloadExcel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidoscontabilidad.downloadExcel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'motorizado.viewFormHojaDeRuta' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hoja-ruta-motorizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\PedidosController@exportHojaDeRutaByMotorizadoForm',
        'controller' => 'App\\Http\\Controllers\\PedidosController@exportHojaDeRutaByMotorizadoForm',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'motorizado.viewFormHojaDeRuta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'motorizado.exportHojaDeRuta' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'export-hoja-ruta-motorizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\PedidosController@exportHojaDeRutaByMotorizadoExcel',
        'controller' => 'App\\Http\\Controllers\\PedidosController@exportHojaDeRutaByMotorizadoExcel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'motorizado.exportHojaDeRuta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'formatos.excelhojaruta' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'excelhojaruta',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\reportes\\FormatosController@excelhojaruta',
        'controller' => 'App\\Http\\Controllers\\pedidos\\reportes\\FormatosController@excelhojaruta',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'formatos.excelhojaruta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidosmotorizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidosmotorizado/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidosmotorizado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidosmotorizado/{pedidosmotorizado}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidosmotorizado/{pedidosmotorizado}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'pedidosmotorizado/{pedidosmotorizado}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'pedidosmotorizado/{pedidosmotorizado}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidosmotorizado.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.cargarfotos' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'pedidosmotorizado/fotos/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@cargarFotos',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@cargarFotos',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosmotorizado.cargarfotos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosmotorizado.updatePedidoByMotorizado' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'pedidos-motorizado/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@updatePedidoByMotorizado',
        'controller' => 'App\\Http\\Controllers\\pedidos\\Motorizado\\PedidosMotoController@updatePedidoByMotorizado',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosmotorizado.updatePedidoByMotorizado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrosalud',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.index',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrosalud/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.create',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@create',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'centrosalud',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.store',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrosalud/{centrosalud}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.show',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@show',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrosalud/{centrosalud}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.edit',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@edit',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'centrosalud/{centrosalud}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.update',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@update',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'centrosalud/{centrosalud}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'centrosalud.destroy',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@destroy',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.crearflorante' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'centrosalud/creacionflotante',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@creacionRapida',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@creacionRapida',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'centrosalud.crearflorante',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'especialidad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.index',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'especialidad/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.create',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@create',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'especialidad',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.store',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'especialidad/{especialidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.show',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@show',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'especialidad/{especialidad}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.edit',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@edit',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'especialidad/{especialidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.update',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@update',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'especialidad.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'especialidad/{especialidad}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'especialidad.destroy',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@destroy',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\EspecialidadController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.export' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctor/export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@export',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@export',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'doctor.export',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.index',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctor/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.create',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@create',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'doctor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.store',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctor/{doctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.show',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@show',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'doctor/{doctor}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.edit',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@edit',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'doctor/{doctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.update',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@update',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'doctor/{doctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'doctor.destroy',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@destroy',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.cargadata' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'doctor/cargadata',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@cargadata',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@cargadata',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'doctor.cargadata',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lista',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.index',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lista/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.create',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@create',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'lista',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.store',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lista/{listum}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.show',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@show',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lista/{listum}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.edit',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@edit',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'lista/{listum}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.update',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@update',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lista.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'lista/{listum}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'lista.destroy',
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@destroy',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\ListaController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamiento.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'enrutamiento',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamiento.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamiento.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'enrutamiento/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamiento.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamientolista.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'enrutamientolista/store',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@Enrutamientolistastore',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@Enrutamientolistastore',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamientolista.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamiento.agregarlista' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'enrutamiento/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@agregarLista',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@agregarLista',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamiento.agregarlista',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamientolista.doctores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'enrutamientolista/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DoctoresLista',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DoctoresLista',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamientolista.doctores',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamientolista.doctoresupdate' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'enrutamientolista/doctor/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DoctoresListaUpdate',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DoctoresListaUpdate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamientolista.doctoresupdate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.aprobarVisita' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'visitadoctornuevo/{id}/aprobar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@aprobar',
        'controller' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@aprobar',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'doctor.aprobarVisita',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'doctor.rechazarVisita' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'visitadoctornuevo/{id}/rechazar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@rechazar',
        'controller' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@rechazar',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'doctor.rechazarVisita',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categoriadoctor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.index',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@index',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categoriadoctor/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.create',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@create',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'categoriadoctor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.store',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@store',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categoriadoctor/{categoriadoctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.show',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@show',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'categoriadoctor/{categoriadoctor}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.edit',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@edit',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'categoriadoctor/{categoriadoctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.update',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@update',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categoriadoctor.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'categoriadoctor/{categoriadoctor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'categoriadoctor.destroy',
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@destroy',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CategoriaDoctorController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'enrutamientolista.calendariovisitadora' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'calendariovisitadora',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@calendariovisitadora',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@calendariovisitadora',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'enrutamientolista.calendariovisitadora',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutas.detalledoctor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rutasdoctor/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DetalleDoctorRutas',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@DetalleDoctorRutas',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutas.detalledoctor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasmapa.detallesdoctor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'detalle-visita-doctor/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@FindDetalleVisitaByID',
        'controller' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@FindDetalleVisitaByID',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasmapa.detallesdoctor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasmapa.guardarvisita' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'update-visita-doctor/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@UpdateVisitaDoctor',
        'controller' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@UpdateVisitaDoctor',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasmapa.guardarvisita',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutas.guardarvisita' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'guardar-visita',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@GuardarVisita',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\EnrutamientoController@GuardarVisita',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutas.guardarvisita',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasvisitadora.ListarMisRutas' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rutasvisitadora',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@ListarMisRutas',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@ListarMisRutas',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasvisitadora.ListarMisRutas',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasvisitadora.listadoctores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rutasvisitadora/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@listadoctores',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@listadoctores',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasvisitadora.listadoctores',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasvisitadora.asignar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rutasvisitadora/asignar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@asignar',
        'controller' => 'App\\Http\\Controllers\\rutas\\enrutamiento\\RutasVisitadoraController@asignar',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasvisitadora.asignar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasvisitadora.buscarcmpdoctor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'rutasvisitadora/buscardoctor/{cmp}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@buscarCMP',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@buscarCMP',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasvisitadora.buscarcmpdoctor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutasvisitadora.guardardoctor' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'rutasvisitadora/doctores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@guardarDoctorVisitador',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\DoctorController@guardarDoctorVisitador',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'rutasvisitadora.guardardoctor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'centrosalud.buscar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'centrosaludbuscar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@buscar',
        'controller' => 'App\\Http\\Controllers\\rutas\\mantenimiento\\CentroSaludController@buscar',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'centrosalud.buscar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ruta.mapa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ruta-mapa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@mapa',
        'controller' => 'App\\Http\\Controllers\\rutas\\visita\\VisitaDoctorController@mapa',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ruta.mapa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'distritoslimacallao' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'distritoslimacallao',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ajustes\\UbigeoController@ObtenerDistritosLimayCallao',
        'controller' => 'App\\Http\\Controllers\\ajustes\\UbigeoController@ObtenerDistritosLimayCallao',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'distritoslimacallao',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratorio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratorio/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidoslaboratorio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratorio/{pedidoslaboratorio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratorio/{pedidoslaboratorio}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'pedidoslaboratorio/{pedidoslaboratorio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'pedidoslaboratorio/{pedidoslaboratorio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'pedidoslaboratorio.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7lLICD5KUZGffqir' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get-unidades/{clasificacionId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\MuestrasController@getUnidadesPorClasificacion',
        'controller' => 'App\\Http\\Controllers\\muestras\\MuestrasController@getUnidadesPorClasificacion',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7lLICD5KUZGffqir',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.downloadWord' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratorio/{fecha}/downloadWord/{turno}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@downloadWord',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@downloadWord',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidoslaboratorio.downloadWord',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidoslaboratorio.cambioMasivo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidoslaboratorio/cambio-masivo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@cambioMasivo',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@cambioMasivo',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidoslaboratorio.cambioMasivo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosLaboratorio.detalles' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidoslaboratoriodetalles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@pedidosDetalles',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@pedidosDetalles',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosLaboratorio.detalles',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosLaboratorio.asignarTecnicoProd' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'pedidoslaboratoriodetalles/asignar/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@asignarTecnicoProd',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@asignarTecnicoProd',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosLaboratorio.asignarTecnicoProd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosLaboratorio.asignarmultipletecnico' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidoslaboratoriodetalles/asignarmultiple',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@asignarmultipletecnico',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PedidoslabController@asignarmultipletecnico',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosLaboratorio.asignarmultipletecnico',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presentacionfarmaceutica',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.index',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presentacionfarmaceutica/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.create',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@create',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'presentacionfarmaceutica',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.store',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@store',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presentacionfarmaceutica/{presentacionfarmaceutica}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.show',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@show',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'presentacionfarmaceutica/{presentacionfarmaceutica}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.edit',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@edit',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'presentacionfarmaceutica/{presentacionfarmaceutica}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.update',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@update',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'presentacionfarmaceutica.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'presentacionfarmaceutica/{presentacionfarmaceutica}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'as' => 'presentacionfarmaceutica.destroy',
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@destroy',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ingredientes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ingredientes/{base_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@listaringredientes',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@listaringredientes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ingredientes.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'base.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'base',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardarbases',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardarbases',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'base.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ingredientes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ingredientes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardaringredientes',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardaringredientes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ingredientes.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ingredientes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'ingredientes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@actualizaringredientes',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@actualizaringredientes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'ingredientes.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'excipientes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'excipientes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardarexcipientes',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@guardarexcipientes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'excipientes.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'excipientes.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'excipientes/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@eliminarexcipientes',
        'controller' => 'App\\Http\\Controllers\\pedidos\\laboratorio\\PresentacionFarmaceuticaController@eliminarexcipientes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'excipientes.delete',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'produccion.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pedidosproduccion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\produccion\\OrdenesController@index',
        'controller' => 'App\\Http\\Controllers\\pedidos\\produccion\\OrdenesController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'produccion.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pedidosproduccion.actualizarEstado' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pedidosproduccion/{detalleId}/actualizarestado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\pedidos\\produccion\\OrdenesController@actualizarEstado',
        'controller' => 'App\\Http\\Controllers\\pedidos\\produccion\\OrdenesController@actualizarEstado',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pedidosproduccion.actualizarEstado',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.rutas' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/rutas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@rutasView',
        'controller' => 'App\\Http\\Controllers\\ReportsController@rutasView',
        'namespace' => NULL,
        'prefix' => 'reports/rutas',
        'where' => 
        array (
        ),
        'as' => 'reports.rutas',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.rutas.zones' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/rutas/api/v1/zones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getZonesReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getZonesReport',
        'namespace' => NULL,
        'prefix' => 'reports/rutas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.rutas.zones',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'rutas.zones.distritos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/rutas/api/v1/distritos/{zoneId}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getDistritosByZone',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getDistritosByZone',
        'namespace' => NULL,
        'prefix' => 'reports/rutas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'rutas.zones.distritos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@ventasView',
        'controller' => 'App\\Http\\Controllers\\ReportsController@ventasView',
        'namespace' => NULL,
        'prefix' => 'reports/ventas',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas.general' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas/api/v1/general',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getGeneralReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getGeneralReport',
        'namespace' => NULL,
        'prefix' => 'reports/ventas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas.general',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas.visitadoras' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas/api/v1/visitadoras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getVisitadorasReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getVisitadorasReport',
        'namespace' => NULL,
        'prefix' => 'reports/ventas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas.visitadoras',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas.productos' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas/api/v1/productos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getProductosReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getProductosReport',
        'namespace' => NULL,
        'prefix' => 'reports/ventas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas.productos',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas.provincias' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas/api/v1/provincias',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getProvinciasReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getProvinciasReport',
        'namespace' => NULL,
        'prefix' => 'reports/ventas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas.provincias',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.ventas.provincias.departamento' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/ventas/api/v1/detail-pedidos-by-departamento',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getPedidosDetailsByProvincia',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getPedidosDetailsByProvincia',
        'namespace' => NULL,
        'prefix' => 'reports/ventas/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.ventas.provincias.departamento',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.doctors' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/doctores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@doctorsView',
        'controller' => 'App\\Http\\Controllers\\ReportsController@doctorsView',
        'namespace' => NULL,
        'prefix' => 'reports/doctores',
        'where' => 
        array (
        ),
        'as' => 'reports.doctors',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.doctores.doctores' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/doctores/api/v1/doctors',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getDoctorReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getDoctorReport',
        'namespace' => NULL,
        'prefix' => 'reports/doctores/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.doctores.doctores',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.doctores.tipo-doctor' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/doctores/api/v1/tipo-doctor',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getTipoDoctorReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getTipoDoctorReport',
        'namespace' => NULL,
        'prefix' => 'reports/doctores/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.doctores.tipo-doctor',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.muestras' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/muestras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@muestrasView',
        'controller' => 'App\\Http\\Controllers\\ReportsController@muestrasView',
        'namespace' => NULL,
        'prefix' => 'reports/muestras',
        'where' => 
        array (
        ),
        'as' => 'reports.muestras',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reports.muestras.api' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reports/muestras/api/v1/muestras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'check.permission',
        ),
        'uses' => 'App\\Http\\Controllers\\ReportsController@getMuestrasReport',
        'controller' => 'App\\Http\\Controllers\\ReportsController@getMuestrasReport',
        'namespace' => NULL,
        'prefix' => 'reports/muestras/api/v1',
        'where' => 
        array (
        ),
        'as' => 'reports.muestras.api',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.reporte' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reporte',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporte',
        'controller' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporte',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'muestras.reporte',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.reporte.frasco-original' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reporte/frasco-original',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporteFrascoOriginal',
        'controller' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporteFrascoOriginal',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'muestras.reporte.frasco-original',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.reporte.frasco-muestra' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reporte/frasco-muestra',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporteFrascoMuestra',
        'controller' => 'App\\Http\\Controllers\\muestras\\gerenciaController@mostrarReporteFrascoMuestra',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'muestras.reporte.frasco-muestra',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.exportarPDF' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reporte/PDF-frascoMuestra',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\gerenciaController@exportarPDF',
        'controller' => 'App\\Http\\Controllers\\muestras\\gerenciaController@exportarPDF',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'muestras.exportarPDF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'muestras.frasco.original.pdf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reporte/PDF-frascoOriginal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\muestras\\gerenciaController@exportarPDFFrascoOriginal',
        'controller' => 'App\\Http\\Controllers\\muestras\\gerenciaController@exportarPDFFrascoOriginal',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'muestras.frasco.original.pdf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumo_empaque',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumo_empaque/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'insumo_empaque',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumo_empaque/{insumo_empaque}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumo_empaque/{insumo_empaque}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'insumo_empaque/{insumo_empaque}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumo_empaque.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'insumo_empaque/{insumo_empaque}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumo_empaque.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoEmpaqueController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'envases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'envases/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'envases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'envases/{envase}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'envases/{envase}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'envases/{envase}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'envases.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'envases/{envase}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'envases.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\EnvaseController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'material/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'material',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'material/{material}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'material.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'material/{material}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'material.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\MaterialController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\MaterialController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumos/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'insumos',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumos/{insumo}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumos/{insumo}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'insumos/{insumo}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'insumos/{insumo}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'insumos.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proveedores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proveedores/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'proveedores',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proveedores/{proveedor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'proveedores/{proveedor}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'proveedores/{proveedor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'proveedores.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'proveedores/{proveedor}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'proveedores.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\ProveedorController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipo_cambio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipo_cambio/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'tipo_cambio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipo_cambio/{tipo_cambio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tipo_cambio/{tipo_cambio}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'tipo_cambio/{tipo_cambio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'tipo_cambio/{tipo_cambio}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'tipo_cambio.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tipo_cambio.resumen' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'resumen-tipo-cambio',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@resumenTipoCambio',
        'controller' => 'App\\Http\\Controllers\\softlyn\\TipoCambioController@resumenTipoCambio',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'tipo_cambio.resumen',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'merchandise',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'merchandise/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'merchandise',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'merchandise/{merchandise}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'merchandise/{merchandise}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'merchandise/{merchandise}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'merchandise.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'merchandise/{merchandise}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'merchandise.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\MerchandiseController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'util',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'util/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'util',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'util/{util}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'util/{util}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'util/{util}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'util.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'util/{util}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'util.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\UtilController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\UtilController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'compras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'compras/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'compras',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'compras/{compra}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'compras/{compra}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'compras/{compra}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'compras.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'compras/{compra}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'compras.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\CompraController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\CompraController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guia_ingreso',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guia_ingreso/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'guia_ingreso',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guia_ingreso/{guia_ingreso}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guia_ingreso/{guia_ingreso}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'guia_ingreso/{guia_ingreso}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'guia_ingreso/{guia_ingreso}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'guia_ingreso.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'lotes.por_articulo' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'lotes/por-articulo/{articulo_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@getLotesPorArticulo',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@getLotesPorArticulo',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'lotes.por_articulo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'guia_ingreso.detalles_compra' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guia_ingreso/detalles-compra/{compra_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@getDetallesCompra',
        'controller' => 'App\\Http\\Controllers\\softlyn\\GuiaIngresoController@getDetallesCompra',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'guia_ingreso.detalles_compra',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'producto_final',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'producto_final/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'producto_final',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'producto_final/{producto_final}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'producto_final/{producto_final}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'producto_final/{producto_final}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'producto_final.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'producto_final/{producto_final}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'producto_final.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\ProductoFinalController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'volumen',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.index',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@index',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'volumen/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.create',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@create',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'volumen',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.store',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@store',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'volumen/{voluman}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.show',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@show',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'volumen/{voluman}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.edit',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@edit',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'volumen/{voluman}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.update',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@update',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'volumen.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'volumen/{voluman}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'volumen.destroy',
        'uses' => 'App\\Http\\Controllers\\softlyn\\VolumenController@destroy',
        'controller' => 'App\\Http\\Controllers\\softlyn\\VolumenController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.index',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@index',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bases/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.create',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@create',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@create',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bases',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.store',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@store',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@store',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bases/{basis}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.show',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@show',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@show',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bases/{basis}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.edit',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@edit',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@edit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'bases/{basis}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.update',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@update',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@update',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bases.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'bases/{basis}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'bases.destroy',
        'uses' => 'App\\Http\\Controllers\\cotizador\\BaseController@destroy',
        'controller' => 'App\\Http\\Controllers\\cotizador\\BaseController@destroy',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.marcar-caro' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'insumo/marcar-caro',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@marcarCaro',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@marcarCaro',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'insumos.marcar-caro',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'insumos.actualizar-es-caro' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'insumo/marcar-caro',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\cotizador\\InsumoController@actualizarEsCaro',
        'controller' => 'App\\Http\\Controllers\\cotizador\\InsumoController@actualizarEsCaro',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'insumos.actualizar-es-caro',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5PlmlYfDNQYnYJGb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::5PlmlYfDNQYnYJGb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:67:"C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"00000000000011eb0000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
