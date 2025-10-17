<?php return array (
  4 => 'concurrency',
  5 => 'cors',
  8 => 'hashing',
  14 => 'view',
  'adminlte' => 
  array (
    'title' => 'Grobdi System',
    'title_prefix' => '',
    'title_postfix' => '',
    'use_ico_only' => false,
    'use_full_favicon' => false,
    'google_fonts' => 
    array (
      'allowed' => true,
    ),
    'logo' => '<b>Grobdi</b>',
    'logo_img' => 'images/logo_solo.png',
    'logo_img_class' => 'brand-image  elevation-3',
    'logo_img_xl' => NULL,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',
    'auth_logo' => 
    array (
      'enabled' => false,
      'img' => 
      array (
        'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
        'alt' => 'Auth Logo',
        'class' => '',
        'width' => 50,
        'height' => 50,
      ),
    ),
    'preloader' => 
    array (
      'enabled' => true,
      'mode' => 'fullscreen',
      'img' => 
      array (
        'path' => 'images/logo_solo.png',
        'alt' => 'Grobdi Preloader Image',
        'effect' => 'animation__shake',
        'width' => 80,
        'height' => 80,
      ),
    ),
    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,
    'layout_topnav' => NULL,
    'layout_boxed' => NULL,
    'layout_fixed_sidebar' => NULL,
    'layout_fixed_navbar' => NULL,
    'layout_fixed_footer' => NULL,
    'layout_dark_mode' => NULL,
    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-danger elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',
    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,
    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',
    'menu' => 
    array (
      0 => 
      array (
        'type' => 'fullscreen-widget',
        'topnav_right' => true,
      ),
      1 => 
      array (
        'type' => 'sidebar-menu-search',
        'text' => 'Buscar',
      ),
      2 => 
      array (
        'header' => 'Reportes',
        'can' => 
        array (
          0 => 'admin',
        ),
      ),
      3 => 
      array (
        'text' => 'Reportes Comercial',
        'icon' => 'fas fa-chart-bar',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Rutas',
            'url' => 'reports/rutas',
            'icon' => 'fas fa-route',
            'can' => 
            array (
              0 => 'admin',
              1 => 'jefe-comercial',
            ),
          ),
          1 => 
          array (
            'text' => 'Ventas',
            'url' => 'reports/ventas',
            'icon' => 'fas fa-briefcase',
            'can' => 
            array (
              0 => 'admin',
            ),
          ),
          2 => 
          array (
            'text' => 'Doctores',
            'url' => 'reports/doctores',
            'icon' => 'fas fa-fw fa-user-md',
            'can' => 
            array (
              0 => 'admin',
            ),
          ),
        ),
      ),
      4 => 
      array (
        'header' => 'Muestras',
        'can' => 
        array (
          0 => 'admin',
          1 => 'visitador',
          2 => 'coordinador-lineas',
          3 => 'jefe-comercial',
          4 => 'contabilidad',
          5 => 'jefe-operaciones',
          6 => 'laboratorio',
        ),
      ),
      5 => 
      array (
        'text' => 'Muestras',
        'url' => 'muestras',
        'icon' => 'fas fa-pump-medical',
        'can' => 
        array (
          0 => 'admin',
          1 => 'visitador',
          2 => 'coordinador-lineas',
          3 => 'jefe-comercial',
          4 => 'contabilidad',
          5 => 'jefe-operaciones',
          6 => 'laboratorio',
        ),
      ),
      6 => 
      array (
        'header' => 'Counter',
        'can' => 
        array (
          0 => 'counter',
          1 => 'administracion',
        ),
      ),
      7 => 
      array (
        'text' => 'Pedidos',
        'icon' => 'fas fa-fw fa-share',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Cargar pedidos',
            'url' => 'cargarpedidos',
            'icon' => 'fas fa-fw fa-upload',
            'can' => 
            array (
              0 => 'counter',
              1 => 'administracion',
            ),
          ),
          1 => 
          array (
            'text' => 'Historial pedidos',
            'url' => 'historialpedidos',
            'icon' => 'fas fa-fw fa-history',
            'can' => 
            array (
              0 => 'jefe_operaciones',
              1 => 'counter',
              2 => 'administracion',
            ),
          ),
          2 => 
          array (
            'text' => 'Asignar Pedidos',
            'url' => 'asignarpedidos',
            'icon' => 'fas fa-fw fa-user',
            'can' => 
            array (
              0 => 'counter',
              1 => 'administracion',
            ),
          ),
        ),
      ),
      8 => 
      array (
        'header' => 'Administracion',
        'can' => 'administracion',
      ),
      9 => 
      array (
        'text' => 'Articulos',
        'icon' => 'fas fa-cogs',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Insumos',
            'url' => 'insumos',
            'icon' => 'fas fa-vial',
            'can' => 'administracion',
          ),
          1 => 
          array (
            'text' => 'Material',
            'url' => 'material',
            'icon' => 'fas fa-cube',
            'can' => 'administracion',
          ),
          2 => 
          array (
            'text' => 'Envases',
            'url' => 'envases',
            'icon' => 'fas fa-pump-soap',
            'can' => 'administracion',
          ),
          3 => 
          array (
            'text' => 'Merchandise',
            'url' => 'merchandise',
            'icon' => 'fas fa-box-open',
            'can' => 'administracion',
          ),
          4 => 
          array (
            'text' => 'Utiles',
            'url' => 'util',
            'icon' => 'fas fa-paperclip',
            'can' => 'administracion',
          ),
        ),
      ),
      10 => 
      array (
        'text' => 'Compras',
        'url' => 'compras',
        'icon' => 'fas fa-shopping-bag',
        'can' => 'administracion',
      ),
      11 => 
      array (
        'text' => 'Proveedores',
        'url' => 'proveedores',
        'icon' => 'fas fa-truck',
        'can' => 'administracion',
      ),
      12 => 
      array (
        'text' => 'Guía de Ingreso',
        'url' => 'guia_ingreso',
        'icon' => 'fas fa-file-import',
        'can' => 'administracion',
      ),
      13 => 
      array (
        'text' => 'Tipo de Cambio',
        'url' => '/resumen-tipo-cambio',
        'icon' => 'fas fa-exchange-alt',
        'can' => 'administracion',
      ),
      14 => 
      array (
        'header' => 'Laboratorio',
        'can' => 'laboratorio',
      ),
      15 => 
      array (
        'text' => 'Pedidos',
        'url' => 'pedidoslaboratorio',
        'icon' => 'fas fa-fw fa-user',
        'can' => 'laboratorio',
      ),
      16 => 
      array (
        'text' => 'Detalles Pedidos',
        'url' => 'pedidoslaboratoriodetalles',
        'icon' => 'fas fa-fw fa-user',
        'can' => 'laboratorio',
      ),
      17 => 
      array (
        'text' => 'Historial pedidos',
        'url' => 'historialpedidos',
        'icon' => 'fas fa-fw fa-history',
        'can' => 'laboratorio',
      ),
      18 => 
      array (
        'text' => 'Presentaciones',
        'url' => 'presentacionfarmaceutica',
        'icon' => 'fas fa-fw fa-flask',
        'can' => 'laboratorio',
      ),
      19 => 
      array (
        'text' => 'Producto Final',
        'url' => 'producto_final',
        'icon' => 'fas fa-vial',
        'can' => 'laboratorio',
      ),
      20 => 
      array (
        'text' => 'Base',
        'url' => 'bases',
        'icon' => 'fas fa-atom',
        'can' => 'laboratorio',
      ),
      21 => 
      array (
        'text' => 'Volumen',
        'url' => 'volumen',
        'icon' => 'fas fa-balance-scale',
        'can' => 'laboratorio',
      ),
      22 => 
      array (
        'header' => 'Produccion',
        'can' => 'tecnico_produccion',
      ),
      23 => 
      array (
        'text' => 'Ordenes',
        'url' => 'pedidosproduccion',
        'icon' => 'fas fa-fw fa-flask',
        'can' => 'tecnico_produccion',
      ),
      24 => 
      array (
        'header' => 'Contabilidad',
        'can' => 'contabilidad',
      ),
      25 => 
      array (
        'text' => 'Pedidos',
        'url' => 'pedidoscontabilidad',
        'icon' => 'fas fa-fw fa-user',
        'can' => 'contabilidad',
      ),
      26 => 
      array (
        'text' => 'Marcar Insumo Caro',
        'url' => '/insumo/marcar-caro',
        'icon' => 'fas fa-fw fa-dollar-sign',
        'can' => 'contabilidad',
      ),
      27 => 
      array (
        'header' => 'Motorizado',
        'can' => 'motorizados',
      ),
      28 => 
      array (
        'text' => 'Pedidos',
        'url' => 'pedidosmotorizado',
        'icon' => 'fas fa-fw fa-user',
        'can' => 'motorizados',
      ),
      29 => 
      array (
        'header' => 'Ajustes',
        'can' => 'jefe-operaciones',
      ),
      30 => 
      array (
        'text' => 'Usuarios',
        'url' => 'usuarios',
        'icon' => 'fas fa-fw fa-user',
        'can' => 'jefe-operaciones',
      ),
      31 => 
      array (
        'text' => 'Roles',
        'url' => 'roles',
        'icon' => 'fas fa-fw fa-user-shield',
        'can' => 'jefe-operaciones',
      ),
      32 => 
      array (
        'text' => 'Modulos',
        'url' => 'modules',
        'icon' => 'fas fa-fw fa-th-large',
        'can' => 'jefe-operaciones',
      ),
      33 => 
      array (
        'text' => 'Vistas',
        'url' => 'views',
        'icon' => 'fas fa-fw fa-eye',
        'can' => 'jefe-operaciones',
      ),
      34 => 
      array (
        'header' => 'Supervisor',
        'can' => 'supervisor',
      ),
      35 => 
      array (
        'text' => 'Mantenimiento',
        'icon' => 'fas fa-fw fa-wrench',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Centro de Salud',
            'url' => 'centrosalud',
            'icon' => 'fas fa-fw fa-h-square',
            'can' => 'supervisor',
          ),
          1 => 
          array (
            'text' => 'Especialidad',
            'url' => 'especialidad',
            'icon' => 'fas fa-fw fa-medkit',
            'can' => 'supervisor',
          ),
          2 => 
          array (
            'text' => 'Categorias',
            'url' => 'categoriadoctor',
            'icon' => 'fas fa-fw fa-medkit',
            'can' => 'supervisor',
          ),
          3 => 
          array (
            'text' => 'Doctor',
            'url' => 'doctor',
            'icon' => 'fas fa-fw fa-user-md',
            'can' => 'supervisor',
          ),
        ),
      ),
      36 => 
      array (
        'text' => 'Enrutamiento',
        'icon' => 'fas fa-list-alt',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Listas',
            'url' => 'lista',
            'icon' => 'fas fa-list',
            'can' => 'supervisor',
          ),
          1 => 
          array (
            'text' => 'Enrutamiento',
            'url' => 'enrutamiento',
            'icon' => 'fas fa-calendar',
            'can' => 'supervisor',
          ),
        ),
      ),
      37 => 
      array (
        'header' => 'Visitador Medico',
        'can' => 'visitador',
      ),
      38 => 
      array (
        'text' => 'Rutas',
        'icon' => 'fa fa-map-marker',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Calendario',
            'url' => 'calendariovisitadora',
            'icon' => 'fa fa-calendar',
            'can' => 'visitador',
          ),
          1 => 
          array (
            'text' => 'Mis rutas',
            'url' => 'rutasvisitadora',
            'icon' => 'fa fa-map',
            'can' => 'visitador',
          ),
          2 => 
          array (
            'text' => 'Mapa de Rutas',
            'url' => 'ruta-mapa',
            'icon' => 'fa fa-map',
            'can' => 'visitador',
          ),
        ),
      ),
      39 => 
      array (
        'header' => 'Jefe de Operaciones',
        'can' => 'jefe-operaciones',
      ),
      40 => 
      array (
        'header' => 'Coordinador de Lineas',
        'can' => 'coordinador-lineas',
      ),
      41 => 
      array (
        'header' => 'Jefe Comercial',
        'can' => 'jefe-comercial',
      ),
      42 => 
      array (
        'text' => 'Ventas x Clientes',
        'url' => 'ventascliente',
        'icon' => '	fas fa-pump-medical',
        'can' => 'jefe-comercial',
      ),
      43 => 
      array (
        'header' => 'Reportes',
        'can' => 'gerencia-general',
      ),
      44 => 
      array (
        'text' => 'Muestras',
        'icon' => 'fas fa-pump-medical',
        'submenu' => 
        array (
          0 => 
          array (
            'text' => 'Clasificaciones',
            'url' => 'reporte',
            'icon' => 'fas fa-chart-bar',
            'can' => 'gerencia-general',
          ),
          1 => 
          array (
            'text' => 'Frasco Muestra',
            'url' => 'reporte/frasco-muestra',
            'icon' => 'fas fa-chart-line',
            'can' => 'gerencia-general',
          ),
          2 => 
          array (
            'text' => 'Frasco Original',
            'url' => 'reporte/frasco-original',
            'icon' => 'fas fa-chart-line',
            'can' => 'gerencia-general',
          ),
        ),
      ),
    ),
    'filters' => 
    array (
      0 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\GateFilter',
      1 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\HrefFilter',
      2 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\SearchFilter',
      3 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\ActiveFilter',
      4 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\ClassesFilter',
      5 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\LangFilter',
      6 => 'JeroenNoten\\LaravelAdminLte\\Menu\\Filters\\DataFilter',
    ),
    'plugins' => 
    array (
      'Datatables' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
          ),
          2 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
          ),
        ),
      ),
      'Select2' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
          ),
          1 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
          ),
        ),
      ),
      'Flatpickr' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => 'https://cdn.jsdelivr.net/npm/flatpickr',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => 'https://npmcdn.com/flatpickr/dist/l10n/es.js',
          ),
          2 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
          ),
        ),
      ),
      'Sweetalert2' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11',
          ),
          1 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css',
          ),
        ),
      ),
      'Pace' => 
      array (
        'active' => false,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
          ),
        ),
      ),
      'Moment' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js',
          ),
        ),
      ),
      'Chartjs' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
          ),
        ),
      ),
      'DateRangePicker' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js',
          ),
        ),
      ),
      'DatePicker' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
          ),
          2 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js',
          ),
        ),
      ),
      'Toastr' => 
      array (
        'active' => true,
        'files' => 
        array (
          0 => 
          array (
            'type' => 'css',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
          ),
          1 => 
          array (
            'type' => 'js',
            'asset' => false,
            'location' => '//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
          ),
        ),
      ),
    ),
    'iframe' => 
    array (
      'default_tab' => 
      array (
        'url' => NULL,
        'title' => NULL,
      ),
      'buttons' => 
      array (
        'close' => true,
        'close_all' => true,
        'close_all_other' => true,
        'scroll_left' => true,
        'scroll_right' => true,
        'fullscreen' => true,
      ),
      'options' => 
      array (
        'loading_screen' => 1000,
        'auto_show_new_tab' => true,
        'use_navbar_items' => true,
      ),
    ),
    'livewire' => false,
  ),
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'America/Lima',
    'locale' => 'es',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:IdHOtLe6oP5Bvv6yc11dk05EH8NXaE8uGVGBp83RIL0=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Concurrency\\ConcurrencyServiceProvider',
      6 => 'Illuminate\\Cookie\\CookieServiceProvider',
      7 => 'Illuminate\\Database\\DatabaseServiceProvider',
      8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      10 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      11 => 'Illuminate\\Hashing\\HashServiceProvider',
      12 => 'Illuminate\\Mail\\MailServiceProvider',
      13 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      14 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      15 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      16 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      17 => 'Illuminate\\Queue\\QueueServiceProvider',
      18 => 'Illuminate\\Redis\\RedisServiceProvider',
      19 => 'Illuminate\\Session\\SessionServiceProvider',
      20 => 'Illuminate\\Translation\\TranslationServiceProvider',
      21 => 'Illuminate\\Validation\\ValidationServiceProvider',
      22 => 'Illuminate\\View\\ViewServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Concurrency' => 'Illuminate\\Support\\Facades\\Concurrency',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Uri' => 'Illuminate\\Support\\Uri',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'pusher',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => 'e4c5eef429639dfca470',
        'secret' => 'ce31d40ba666d33352a6',
        'app_id' => '1965689',
        'options' => 
        array (
          'cluster' => 'us2',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'database',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'cache',
        'lock_connection' => NULL,
        'lock_table' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\framework/cache/data',
        'lock_path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => '',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'grobdi_db',
        'prefix' => '',
        'foreign_key_constraints' => true,
        'busy_timeout' => NULL,
        'journal_mode' => NULL,
        'synchronous' => NULL,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'grobdi_db',
        'username' => 'root',
        'password' => 'Grobdi123',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'grobdi_db',
        'username' => 'root',
        'password' => 'Grobdi123',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'grobdi_db',
        'username' => 'root',
        'password' => 'Grobdi123',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'grobdi_db',
        'username' => 'root',
        'password' => 'Grobdi123',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'laravel_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\app/private',
        'serve' => true,
        'throw' => false,
        'report' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
        'report' => false,
      ),
    ),
    'links' => 
    array (
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\public\\storage' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\app/public',
    ),
  ),
  'imports' => 
  array (
    'column_mappings' => 
    array (
      'pedidos' => 
      array (
        'old_format' => 
        array (
          'orderId' => 3,
          'customerName' => 4,
          'customerNumber' => 5,
          'prize' => 8,
          'paymentMethod' => 10,
          'productionStatus' => 12,
          'deliveryDate' => 13,
          'doctorName' => 15,
          'district' => 16,
          'address' => 17,
          'reference' => 18,
          'userName' => 19,
          'createdAt' => 20,
        ),
      ),
      'detail_pedidos' => 
      array (
        'new_format' => 
        array (
          'numero' => 0,
          'articulo' => 1,
          'cantidad' => 2,
          'precio' => 3,
          'subtotal' => 4,
          'fecha' => 21,
        ),
        'old_format' => 
        array (
          'numero' => 3,
          'articulo' => 16,
          'cantidad' => 17,
          'precio' => 18,
          'subtotal' => 19,
          'fecha' => 21,
        ),
      ),
      'doctores' => 
      array (
        'default' => 
        array (
          'name' => 2,
          'CMP' => 3,
          'phone' => 4,
          'name_secretariat' => 7,
          'observations' => 8,
          'especialidad' => 9,
          'district_info' => 11,
          'centro_salud' => 12,
          'categoria_medico' => 15,
          'tipo_medico' => 16,
          'lunes' => 21,
          'martes' => 22,
          'miercoles' => 23,
          'jueves' => 24,
          'viernes' => 25,
        ),
      ),
    ),
    'validation' => 
    array (
      'required_fields' => 
      array (
        'pedidos' => 
        array (
          0 => 'orderId',
          1 => 'customerName',
          2 => 'deliveryDate',
        ),
        'detail_pedidos' => 
        array (
          0 => 'numero',
          1 => 'articulo',
          2 => 'cantidad',
        ),
        'doctores' => 
        array (
          0 => 'name',
          1 => 'CMP',
          2 => 'centro_salud',
        ),
      ),
      'header_keywords' => 
      array (
        'pedidos' => 
        array (
          0 => 'pedido',
          1 => 'order',
          2 => 'numero',
          3 => 'customer',
        ),
        'detail_pedidos' => 
        array (
          0 => 'numero',
          1 => 'articulo',
          2 => 'cantidad',
          3 => 'precio',
        ),
        'doctores' => 
        array (
          0 => 'doctor',
          1 => 'medico',
          2 => 'nombre',
          3 => 'cmp',
        ),
      ),
    ),
    'district_normalizations' => 
    array (
      'CERCADO DE LIMA' => 'LIMA',
      'SURCO' => 'SANTIAGO DE SURCO',
      'ATE ' => 'ATE',
      'MAGDALENA' => 'MAGDALENA DEL MAR',
      'BREÃ\'A' => 'BREÑA',
      'BREÃ\'A ' => 'BREÑA',
      'ZARATE' => 'SAN JUAN DE LURIGANCHO',
    ),
    'production_status_mapping' => 
    array (
      'PENDIENTE' => 0,
      'APROBADO' => 1,
      'PREPARADO' => 1,
      'EN_PREPARACION' => 1,
    ),
    'default_values' => 
    array (
      'doctores' => 
      array (
        'categoria_medico' => 'Visitador',
        'tipo_medico' => 'En Proceso',
        'asignado_consultorio' => 0,
        'categoriadoctor_id' => 5,
      ),
      'pedidos' => 
      array (
        'paymentStatus' => 'PENDIENTE',
        'deliveryStatus' => 'Pendiente',
        'accountingStatus' => 0,
        'turno' => 0,
      ),
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => 
    array (
      'channel' => NULL,
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'log',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'scheme' => NULL,
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '2525',
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'local_domain' => 'localhost',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Laravel',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'batching' => 
    array (
      'database' => 'mysql',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'reportes' => 
  array (
    'tipos' => 
    array (
      'ventas' => 
      array (
        'nombre' => 'Reporte de Ventas',
        'modelo' => 'App\\Models\\Venta',
        'servicio' => 'App\\Application\\Services\\Reportes\\VentasReporteService',
        'dto' => 'App\\Application\\DTOs\\Reportes\\VentasDTO',
        'permisos' => 
        array (
          0 => 'ver-reportes-ventas',
        ),
        'cache_ttl' => 3600,
      ),
      'doctores' => 
      array (
        'nombre' => 'Reporte de Doctores',
        'modelo' => 'App\\Models\\Doctor',
        'servicio' => 'App\\Application\\Services\\Reportes\\DoctoresReporteService',
        'dto' => 'App\\Application\\DTOs\\Reportes\\DoctoresDTO',
        'permisos' => 
        array (
          0 => 'ver-reportes-doctores',
        ),
        'cache_ttl' => 3600,
      ),
      'visitadoras' => 
      array (
        'nombre' => 'Reporte de Visitadoras',
        'modelo' => 'App\\Models\\Visitadora',
        'servicio' => 'App\\Application\\Services\\Reportes\\VisitadorasReporteService',
        'dto' => 'App\\Application\\DTOs\\Reportes\\VisitadorasDTO',
        'permisos' => 
        array (
          0 => 'ver-reportes-visitadoras',
        ),
        'cache_ttl' => 3600,
      ),
    ),
    'cache' => 
    array (
      'prefix' => 'reporte_',
      'ttl' => 3600,
      'driver' => 'file',
    ),
    'excel' => 
    array (
      'disk' => 'public',
      'path' => 'reportes/',
      'queue' => 'default',
    ),
    'filtros_comunes' => 
    array (
      'fecha_inicio' => 
      array (
        'type' => 'date',
        'label' => 'Fecha Inicio',
        'required' => false,
      ),
      'fecha_fin' => 
      array (
        'type' => 'date',
        'label' => 'Fecha Fin',
        'required' => false,
      ),
      'anio' => 
      array (
        'type' => 'select',
        'label' => 'Año',
        'options' => 'getAniosDisponibles',
        'required' => false,
      ),
      'mes' => 
      array (
        'type' => 'select',
        'label' => 'Mes',
        'options' => 'getMeses',
        'required' => false,
      ),
    ),
    'export_formats' => 
    array (
      'excel' => 'xlsx',
      'csv' => 'csv',
      'pdf' => 'pdf',
    ),
    'dashboard' => 
    array (
      'widgets_por_pagina' => 6,
      'refresh_interval' => 300,
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'localhost',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'token_prefix' => '',
    'middleware' => 
    array (
      'authenticate_session' => 'Laravel\\Sanctum\\Http\\Middleware\\AuthenticateSession',
      'encrypt_cookies' => 'Illuminate\\Cookie\\Middleware\\EncryptCookies',
      'validate_csrf_token' => 'Illuminate\\Foundation\\Http\\Middleware\\ValidateCsrfToken',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'sys_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
  ),
  'concurrency' => 
  array (
    'default' => 'process',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => '12',
      'verify' => true,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\resources\\views',
    ),
    'compiled' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\framework\\views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\fonts',
      'font_cache' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\progr\\AppData\\Local\\Temp',
      'chroot' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi',
      'allowed_protocols' => 
      array (
        'data://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'artifactPathValidation' => NULL,
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => false,
      'allowed_remote_hosts' => NULL,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'image' => 
  array (
    'driver' => 'Intervention\\Image\\Drivers\\Gd\\Driver',
    'options' => 
    array (
      'autoOrientation' => true,
      'decodeAnimation' => true,
      'blendingColor' => 'ffffff',
      'strip' => false,
    ),
  ),
  'localization-private' => 
  array (
    'plugins' => 
    array (
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\actions' => 
      array (
        0 => 'LaravelLang\\Actions\\Plugins\\Main',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\attributes' => 
      array (
        0 => 'LaravelLang\\Attributes\\Plugins\\Laravel',
        1 => 'LaravelLang\\Attributes\\Plugins\\Lumen',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\http-statuses' => 
      array (
        0 => 'LaravelLang\\HttpStatuses\\Plugins\\Main',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\lang' => 
      array (
        0 => 'LaravelLang\\Lang\\Plugins\\Breeze\\Master',
        1 => 'LaravelLang\\Lang\\Plugins\\Breeze\\V2',
        2 => 'LaravelLang\\Lang\\Plugins\\Cashier\\Stripe\\Master',
        3 => 'LaravelLang\\Lang\\Plugins\\Cashier\\Stripe\\V15',
        4 => 'LaravelLang\\Lang\\Plugins\\Fortify\\Master',
        5 => 'LaravelLang\\Lang\\Plugins\\Fortify\\V1',
        6 => 'LaravelLang\\Lang\\Plugins\\Jetstream\\Master',
        7 => 'LaravelLang\\Lang\\Plugins\\Jetstream\\V5',
        8 => 'LaravelLang\\Lang\\Plugins\\Laravel\\Master',
        9 => 'LaravelLang\\Lang\\Plugins\\Laravel\\V11',
        10 => 'LaravelLang\\Lang\\Plugins\\Laravel\\V12',
        11 => 'LaravelLang\\Lang\\Plugins\\Nova\\DuskSuite\\Main',
        12 => 'LaravelLang\\Lang\\Plugins\\Nova\\LogViewer\\Main',
        13 => 'LaravelLang\\Lang\\Plugins\\Nova\\V4',
        14 => 'LaravelLang\\Lang\\Plugins\\Nova\\V5',
        15 => 'LaravelLang\\Lang\\Plugins\\Spark\\Paddle',
        16 => 'LaravelLang\\Lang\\Plugins\\Spark\\Stripe',
        17 => 'LaravelLang\\Lang\\Plugins\\UI\\Master',
        18 => 'LaravelLang\\Lang\\Plugins\\UI\\V4',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\moonshine' => 
      array (
        0 => 'LaravelLang\\MoonShine\\Plugins\\V3',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\starter-kits' => 
      array (
        0 => 'LaravelLang\\StarterKits\\Plugins\\Livewire',
        1 => 'LaravelLang\\StarterKits\\Plugins\\React',
        2 => 'LaravelLang\\StarterKits\\Plugins\\Vue',
      ),
    ),
    'packages' => 
    array (
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\actions' => 
      array (
        'class' => 'LaravelLang\\Actions\\Plugin',
        'name' => 'laravel-lang/actions',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\attributes' => 
      array (
        'class' => 'LaravelLang\\Attributes\\Plugin',
        'name' => 'laravel-lang/attributes',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\http-statuses' => 
      array (
        'class' => 'LaravelLang\\HttpStatuses\\Plugin',
        'name' => 'laravel-lang/http-statuses',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\lang' => 
      array (
        'class' => 'LaravelLang\\Lang\\Plugin',
        'name' => 'laravel-lang/lang',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\moonshine' => 
      array (
        'class' => 'LaravelLang\\MoonShine\\Plugin',
        'name' => 'moonshine/moonshine',
      ),
      'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor\\laravel-lang\\starter-kits' => 
      array (
        'class' => 'LaravelLang\\StarterKits\\Plugin',
        'name' => 'laravel-lang/starter-kits',
      ),
    ),
    'models' => 
    array (
      'directory' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\app',
    ),
    'map' => 
    array (
      'af' => 
      array (
        'type' => 'Latn',
        'regional' => 'af_ZA',
      ),
      'sq' => 
      array (
        'type' => 'Latn',
        'regional' => 'sq_AL',
      ),
      'am' => 
      array (
        'type' => 'Ethi',
        'regional' => 'am_ET',
      ),
      'ar' => 
      array (
        'type' => 'Arab',
        'regional' => 'ar_AE',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'hy' => 
      array (
        'type' => 'Armn',
        'regional' => 'hy_AM',
      ),
      'as' => 
      array (
        'type' => 'Beng',
        'regional' => 'as_IN',
      ),
      'az' => 
      array (
        'type' => 'Latn',
        'regional' => 'az_AZ',
      ),
      'bm' => 
      array (
        'type' => 'Latn',
        'regional' => 'bm_ML',
      ),
      'bho' => 
      array (
        'type' => 'Deva',
        'regional' => 'bho_IN',
      ),
      'eu' => 
      array (
        'type' => 'Latn',
        'regional' => 'eu_ES',
      ),
      'be' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'be_BY',
      ),
      'bn' => 
      array (
        'type' => 'Beng',
        'regional' => 'bn_BD',
      ),
      'bs' => 
      array (
        'type' => 'Latn',
        'regional' => 'bs_BA',
      ),
      'bg' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'bg_BG',
      ),
      'en_CA' => 
      array (
        'type' => 'Latn',
        'regional' => 'en_CA',
      ),
      'ca' => 
      array (
        'type' => 'Latn',
        'regional' => 'ca_ES',
      ),
      'ceb' => 
      array (
        'type' => 'Latn',
        'regional' => 'ceb_PH',
      ),
      'km' => 
      array (
        'type' => 'Khmr',
        'regional' => 'km_KH',
      ),
      'zh_CN' => 
      array (
        'type' => 'Hans',
        'regional' => 'zh_CN',
      ),
      'zh_HK' => 
      array (
        'type' => 'Hans',
        'regional' => 'zh_HK',
      ),
      'zh_TW' => 
      array (
        'type' => 'Hans',
        'regional' => 'zh_TW',
      ),
      'hr' => 
      array (
        'type' => 'Latn',
        'regional' => 'hr_HR',
      ),
      'cs' => 
      array (
        'type' => 'Latn',
        'regional' => 'cs_CZ',
      ),
      'da' => 
      array (
        'type' => 'Latn',
        'regional' => 'da_DK',
      ),
      'doi' => 
      array (
        'type' => 'Deva',
        'regional' => 'doi_IN',
      ),
      'nl' => 
      array (
        'type' => 'Latn',
        'regional' => 'nl_NL',
      ),
      'en' => 
      array (
        'type' => 'Latn',
        'regional' => 'en_GB',
      ),
      'eo' => 
      array (
        'type' => 'Latn',
        'regional' => 'eo_001',
      ),
      'et' => 
      array (
        'type' => 'Latn',
        'regional' => 'et_EE',
      ),
      'ee' => 
      array (
        'type' => 'Latn',
        'regional' => 'ee_GH',
      ),
      'fi' => 
      array (
        'type' => 'Latn',
        'regional' => 'fi_FI',
      ),
      'fr' => 
      array (
        'type' => 'Latn',
        'regional' => 'fr_FR',
      ),
      'fy' => 
      array (
        'type' => 'Latn',
        'regional' => 'fy_NL',
      ),
      'gl' => 
      array (
        'type' => 'Latn',
        'regional' => 'gl_ES',
      ),
      'ka' => 
      array (
        'type' => 'Geor',
        'regional' => 'ka_GE',
      ),
      'de' => 
      array (
        'type' => 'Latn',
        'regional' => 'de_DE',
      ),
      'de_CH' => 
      array (
        'type' => 'Latn',
        'regional' => 'de_CH',
      ),
      'el' => 
      array (
        'type' => 'Grek',
        'regional' => 'el_GR',
      ),
      'gu' => 
      array (
        'type' => 'Gujr',
        'regional' => 'gu_IN',
      ),
      'ha' => 
      array (
        'type' => 'Latn',
        'regional' => 'ha_NG',
      ),
      'haw' => 
      array (
        'type' => 'Latn',
        'regional' => 'haw',
      ),
      'he' => 
      array (
        'type' => 'Hebr',
        'regional' => 'he_IL',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'hi' => 
      array (
        'type' => 'Deva',
        'regional' => 'hi_IN',
      ),
      'hu' => 
      array (
        'type' => 'Latn',
        'regional' => 'hu_HU',
      ),
      'is' => 
      array (
        'type' => 'Latn',
        'regional' => 'is_IS',
      ),
      'ig' => 
      array (
        'type' => 'Latn',
        'regional' => 'ig_NG',
      ),
      'id' => 
      array (
        'type' => 'Latn',
        'regional' => 'id_ID',
      ),
      'ga' => 
      array (
        'type' => 'Latn',
        'regional' => 'ga_IE',
      ),
      'it' => 
      array (
        'type' => 'Latn',
        'regional' => 'it_IT',
      ),
      'ja' => 
      array (
        'type' => 'Jpan',
        'regional' => 'ja_JP',
      ),
      'kn' => 
      array (
        'type' => 'Knda',
        'regional' => 'kn_IN',
      ),
      'kk' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'kk_KZ',
      ),
      'rw' => 
      array (
        'type' => 'Latn',
        'regional' => 'rw_RW',
      ),
      'ko' => 
      array (
        'type' => 'Hang',
        'regional' => 'ko_KR',
      ),
      'ku' => 
      array (
        'type' => 'Latn',
        'regional' => 'ku_TR',
      ),
      'ckb' => 
      array (
        'type' => 'Arab',
        'regional' => 'ckb_IQ',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'ky' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'ky_KG',
      ),
      'lo' => 
      array (
        'type' => 'Laoo',
        'regional' => 'lo_LA',
      ),
      'lv' => 
      array (
        'type' => 'Latn',
        'regional' => 'lv_LV',
      ),
      'ln' => 
      array (
        'type' => 'Latn',
        'regional' => 'ln_CD',
      ),
      'lt' => 
      array (
        'type' => 'Latn',
        'regional' => 'lt_LT',
      ),
      'lg' => 
      array (
        'type' => 'Latn',
        'regional' => 'lg_UG',
      ),
      'lb' => 
      array (
        'type' => 'Latn',
        'regional' => 'lb_LU',
      ),
      'mk' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'mk_MK',
      ),
      'mai' => 
      array (
        'type' => 'Deva',
        'regional' => 'mai_IN',
      ),
      'mg' => 
      array (
        'type' => 'Latn',
        'regional' => 'mg_MG',
      ),
      'ml' => 
      array (
        'type' => 'Mlym',
        'regional' => 'ml_IN',
      ),
      'ms' => 
      array (
        'type' => 'Latn',
        'regional' => 'ms_MY',
      ),
      'mt' => 
      array (
        'type' => 'Latn',
        'regional' => 'mt_MT',
      ),
      'mr' => 
      array (
        'type' => 'Deva',
        'regional' => 'mr_IN',
      ),
      'mi' => 
      array (
        'type' => 'Latn',
        'regional' => 'mi_NZ',
      ),
      'mni_Mtei' => 
      array (
        'type' => 'Beng',
        'regional' => 'mni_IN',
      ),
      'mn' => 
      array (
        'type' => 'Mong',
        'regional' => 'mn_MN',
      ),
      'my' => 
      array (
        'type' => 'Mymr',
        'regional' => 'my_MM',
      ),
      'ne' => 
      array (
        'type' => 'Deva',
        'regional' => 'ne',
      ),
      'nb' => 
      array (
        'type' => 'Latn',
        'regional' => 'nb_NO',
      ),
      'nn' => 
      array (
        'type' => 'Latn',
        'regional' => 'nn_NO',
      ),
      'oc' => 
      array (
        'type' => 'Latn',
        'regional' => 'oc_FR',
      ),
      'or' => 
      array (
        'type' => 'Orya',
        'regional' => 'or_IN',
      ),
      'om' => 
      array (
        'type' => 'Latn',
        'regional' => 'om_ET',
      ),
      'ps' => 
      array (
        'type' => 'Arab',
        'regional' => 'ps_AF',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'fa' => 
      array (
        'type' => 'Arab',
        'regional' => 'fa_IR',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'fil' => 
      array (
        'type' => 'Latn',
        'regional' => 'fil_PH',
      ),
      'pl' => 
      array (
        'type' => 'Latn',
        'regional' => 'pl_PL',
      ),
      'pt' => 
      array (
        'type' => 'Latn',
        'regional' => 'pt_PT',
      ),
      'pt_BR' => 
      array (
        'type' => 'Latn',
        'regional' => 'pt_BR',
      ),
      'pa' => 
      array (
        'type' => 'Guru',
        'regional' => 'pa_IN',
      ),
      'qu' => 
      array (
        'type' => 'Latn',
        'regional' => 'qu_PE',
      ),
      'ro' => 
      array (
        'type' => 'Latn',
        'regional' => 'ro_RO',
      ),
      'ru' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'ru_RU',
      ),
      'sa' => 
      array (
        'type' => 'Deva',
        'regional' => 'sa_IN',
      ),
      'sc' => 
      array (
        'type' => 'Latn',
        'regional' => 'sc_IT',
      ),
      'gd' => 
      array (
        'type' => 'Latn',
        'regional' => 'gd_GB',
      ),
      'sr_Cyrl' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'sr_RS',
      ),
      'sr_Latn' => 
      array (
        'type' => 'Latn',
        'regional' => 'sr_RS',
      ),
      'sr_Latn_ME' => 
      array (
        'type' => 'Latn',
        'regional' => 'sr_Latn_ME',
      ),
      'sn' => 
      array (
        'type' => 'Latn',
        'regional' => 'sn_ZW',
      ),
      'sd' => 
      array (
        'type' => 'Arab',
        'regional' => 'sd_PK',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'si' => 
      array (
        'type' => 'Sinh',
        'regional' => 'si_LK',
      ),
      'sk' => 
      array (
        'type' => 'Latn',
        'regional' => 'sk_SK',
      ),
      'sl' => 
      array (
        'type' => 'Latn',
        'regional' => 'sl_SI',
      ),
      'so' => 
      array (
        'type' => 'Latn',
        'regional' => 'so_SO',
      ),
      'es' => 
      array (
        'type' => 'Latn',
        'regional' => 'es_ES',
      ),
      'su' => 
      array (
        'type' => 'Latn',
        'regional' => 'su_ID',
      ),
      'sw' => 
      array (
        'type' => 'Latn',
        'regional' => 'sw_KE',
      ),
      'sv' => 
      array (
        'type' => 'Latn',
        'regional' => 'sv_SE',
      ),
      'tl' => 
      array (
        'type' => 'Latn',
        'regional' => 'tl_PH',
      ),
      'tg' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'tg_TJ',
      ),
      'ta' => 
      array (
        'type' => 'Taml',
        'regional' => 'ta_IN',
      ),
      'tt' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'tt_RU',
      ),
      'te' => 
      array (
        'type' => 'Telu',
        'regional' => 'te_IN',
      ),
      'ti' => 
      array (
        'type' => 'Ethi',
        'regional' => 'ti_ET',
      ),
      'th' => 
      array (
        'type' => 'Thai',
        'regional' => 'th_TH',
      ),
      'tr' => 
      array (
        'type' => 'Latn',
        'regional' => 'tr_TR',
      ),
      'tk' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'tk_TM',
      ),
      'ak' => 
      array (
        'type' => 'Latn',
        'regional' => 'ak_GH',
      ),
      'ug' => 
      array (
        'type' => 'Arab',
        'regional' => 'ug_CN',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'uk' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'uk_UA',
      ),
      'ur' => 
      array (
        'type' => 'Arab',
        'regional' => 'ur_PK',
        'direction' => 
        \LaravelLang\LocaleList\Direction::RightToLeft,
      ),
      'uz_Cyrl' => 
      array (
        'type' => 'Cyrl',
        'regional' => 'uz_UZ',
      ),
      'uz_Latn' => 
      array (
        'type' => 'Latn',
        'regional' => 'uz_UZ',
      ),
      'vi' => 
      array (
        'type' => 'Latn',
        'regional' => 'vi_VN',
      ),
      'cy' => 
      array (
        'type' => 'Latn',
        'regional' => 'cy_GB',
      ),
      'xh' => 
      array (
        'type' => 'Latn',
        'regional' => 'xh_ZA',
      ),
      'yi' => 
      array (
        'type' => 'Hebr',
        'regional' => 'yi_001',
      ),
      'yo' => 
      array (
        'type' => 'Latn',
        'regional' => 'yo_NG',
      ),
      'zu' => 
      array (
        'type' => 'Latn',
        'regional' => 'zu_ZA',
      ),
    ),
  ),
  'localization' => 
  array (
    'inline' => false,
    'align' => true,
    'aliases' => 
    array (
    ),
    'smart_punctuation' => 
    array (
      'enable' => false,
      'common' => 
      array (
        'double_quote_opener' => '“',
        'double_quote_closer' => '”',
        'single_quote_opener' => '‘',
        'single_quote_closer' => '’',
      ),
      'locales' => 
      array (
        'fr' => 
        array (
          'double_quote_opener' => '«&nbsp;',
          'double_quote_closer' => '&nbsp;»',
          'single_quote_opener' => '‘',
          'single_quote_closer' => '’',
        ),
        'ru' => 
        array (
          'double_quote_opener' => '«',
          'double_quote_closer' => '»',
          'single_quote_opener' => '‘',
          'single_quote_closer' => '’',
        ),
        'uk' => 
        array (
          'double_quote_opener' => '«',
          'double_quote_closer' => '»',
          'single_quote_opener' => '‘',
          'single_quote_closer' => '’',
        ),
        'be' => 
        array (
          'double_quote_opener' => '«',
          'double_quote_closer' => '»',
          'single_quote_opener' => '‘',
          'single_quote_closer' => '’',
        ),
      ),
    ),
    'routes' => 
    array (
      'names' => 
      array (
        'parameter' => 'locale',
        'header' => 'Accept-Language',
        'cookie' => 'Accept-Language',
        'session' => 'Accept-Language',
        'column' => 'locale',
      ),
      'name_prefix' => 'localized.',
      'redirect_default' => false,
      'hide_default' => false,
      'group' => 
      array (
        'middlewares' => 
        array (
          'default' => 
          array (
            0 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByCookie',
            1 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByHeader',
            2 => 'LaravelLang\\Routes\\Middlewares\\LocalizationBySession',
            3 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByModel',
          ),
          'prefix' => 
          array (
            0 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByParameterPrefix',
            1 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByCookie',
            2 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByHeader',
            3 => 'LaravelLang\\Routes\\Middlewares\\LocalizationBySession',
            4 => 'LaravelLang\\Routes\\Middlewares\\LocalizationByModel',
          ),
        ),
      ),
    ),
    'models' => 
    array (
      'suffix' => 'Translation',
      'filter' => 
      array (
        'enabled' => true,
      ),
      'helpers' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\vendor/_laravel_lang',
    ),
    'translators' => 
    array (
      'channels' => 
      array (
        'google' => 
        array (
          'translator' => '\\LaravelLang\\Translator\\Integrations\\Google',
          'enabled' => true,
          'priority' => 1,
        ),
        'deepl' => 
        array (
          'translator' => '\\LaravelLang\\Translator\\Integrations\\Deepl',
          'enabled' => false,
          'priority' => 2,
          'credentials' => 
          array (
            'key' => '',
          ),
        ),
        'yandex' => 
        array (
          'translator' => '\\LaravelLang\\Translator\\Integrations\\Yandex',
          'enabled' => false,
          'priority' => 3,
          'credentials' => 
          array (
            'key' => '',
            'folder' => '',
          ),
        ),
      ),
      'options' => 
      array (
        'preserve_parameters' => true,
      ),
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
        'test_auto_detect' => true,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => NULL,
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'guess',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
      'cells' => 
      array (
        'middleware' => 
        array (
        ),
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
      'default_ttl' => 10800,
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\progr\\Desktop\\proyectos\\sistema_grobdi\\storage\\framework/cache/laravel-excel',
      'local_permissions' => 
      array (
      ),
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
