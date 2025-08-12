# Copilot Instructions for pedidos-grobdi

## Arquitectura General
- Proyecto basado en Laravel, siguiendo la estructura estándar de MVC (Model-View-Controller).
- Los controladores principales están en `app/Http/Controllers/`, los modelos en `app/Models/` y las vistas en `resources/views/`.
- El flujo de datos sigue: rutas → controlador → modelo → vista.
- El sistema gestiona rutas médicas, listas de doctores y enrutamiento de visitas.

## Convenciones y Patrones
- Las relaciones Eloquent se usan extensivamente para acceder a datos relacionados (ejemplo: `$ruta_lista->lista->distritos`).
- Las vistas Blade usan Bootstrap y Flatpickr para UI y selección de fechas.
- Los formularios usan CSRF y validación estándar de Laravel.
- Los mensajes de éxito/error se muestran con sesiones y validaciones en Blade.
- Los modales y acciones de botones pueden requerir AJAX para evitar recargas (ver ejemplo en `enrutamientolista.blade.php`).

## Workflows de Desarrollo
- Para ejecutar el proyecto: `php artisan serve`.
- Migraciones: `php artisan migrate`.
- Pruebas: `php artisan test` o PHPUnit según configuración.
- Instalar dependencias: `composer install` y `npm install`.
- Compilar assets: `npm run dev` o `npm run build`.

## Integraciones y Dependencias
- Bootstrap y Flatpickr se cargan desde CDN en las vistas.
- El sistema puede usar AJAX (jQuery o fetch) para acciones sin recarga.
- El archivo `composer.json` define dependencias PHP, `package.json` para JS.

## Ejemplo de patrón importante
```blade
@foreach ($enrutamiento->enrutamiento_listas as $ruta_lista)
    <td>{{ $ruta_lista->fecha_inicio }} al {{ $ruta_lista->fecha_fin }}</td>
    <td>{{ $ruta_lista->lista->name }}</td>
    <td>
        @foreach ($ruta_lista->lista->distritos as $distrito)
            {{ $distrito->name }}<br>
        @endforeach
    </td>
@endforeach
```

## Archivos Clave
- `app/Http/Controllers/rutas/enrutamiento/RutasVisitadoraController.php`: lógica principal de rutas y visitas.
- `resources/views/rutas/enrutamiento/enrutamientolista.blade.php`: vista principal de listas y modales.
- `composer.json`, `package.json`: dependencias.
- `routes/web.php`: define rutas y endpoints.

## Notas
- Mantén las relaciones Eloquent actualizadas para evitar errores de null.
- Usa AJAX para acciones en botones que no deben recargar la página.
- Sigue la estructura MVC y las convenciones de Laravel para máxima compatibilidad.
