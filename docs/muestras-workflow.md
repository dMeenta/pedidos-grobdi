# 🧪 Módulo Muestras - Workflow del Sistema

## 📊 Descripción General

El módulo de **Muestras** es el sistema de gestión de muestras médicas y productos farmacéuticos del sistema GROBDI. Se encarga del registro, seguimiento, aprobación y control de calidad de muestras médicas a través de diferentes roles jerárquicos, desde visitadores hasta gerencia general.

## 🔧 Componentes Técnicos

### Controladores Principales
- **MuestrasController** - CRUD principal de muestras (Visitadores)
- **coordinadoraController** - Gestión y aprobación por coordinadora
- **JcomercialController** - Aprobación por jefe comercial
- **laboratorioController** - Control de calidad y estado en laboratorio
- **jefe_proyectosController** - Gestión de precios por jefe de proyectos
- **gerenciaController** - Reportes y aprobación gerencial

### Modelos Utilizados
- **Muestras** - Entidad principal de muestras
- **Clasificacion** - Tipos de clasificación de muestras
- **UnidadMedida** - Unidades de medida asociadas
- **TipoMuestra** - Tipos de muestra (frasco original/muestra)

### Rutas y Middleware por Rol
```php
// Visitadores - Registro inicial
Route::resource('muestras', MuestrasController::class)
    ->middleware(['checkRole:visitador,admin']);

// Coordinadora - Aprobación nivel 1
Route::middleware(['checkRole:coordinador-lineas,admin'])->group(function () {
    Route::get('/Coordinadora', [coordinadoraController::class, 'aprobacionCoordinadora']);
    Route::post('/Coordinadora/agregar', [coordinadoraController::class, 'storeCO']);
});

// Jefe Comercial - Aprobación nivel 2
Route::middleware(['checkRole:jefe-comercial,admin'])->group(function () {
    Route::get('/JComercial', [JcomercialController::class, 'confirmar']);
});

// Laboratorio - Control de calidad
Route::middleware(['checkRole:laboratorio,admin'])->group(function () {
    Route::get('/laboratorio', [laboratorioController::class, 'estado']);
    Route::put('/laboratorio/{id}/actualizar-estado', [laboratorioController::class, 'actualizarEstado']);
});

// Jefe de Proyectos - Gestión de precios
Route::middleware(['checkRole:jefe-operaciones,admin'])->group(function () {
    Route::get('/jefe-operaciones', [jefe_proyectosController::class, 'precio']);
    Route::put('/muestras/{id}/actualizar-precio', [jefe_proyectosController::class, 'actualizarPrecio']);
});

// Gerencia General - Reportes ejecutivos
Route::middleware(['checkRole:gerencia-general,admin'])->group(function () {
    Route::get('/reporte', [gerenciaController::class, 'mostrarReporte']);
    Route::get('/reporte/frasco-original', [gerenciaController::class, 'mostrarReporteFrascoOriginal']);
});
```

## 🎯 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| `visitador` | ✅ Registro de muestras |
| `coordinador-lineas` | ✅ Aprobación nivel 1, CRUD completo |
| `jefe-comercial` | ✅ Aprobación nivel 2 |
| `laboratorio` | ✅ Control de calidad y estados |
| `jefe-operaciones` | ✅ Gestión de precios |
| `gerencia-general` | ✅ Reportes ejecutivos |
| `admin` | ✅ Acceso completo a todos los módulos |

---

## 🔄 Diagrama de Flujo del Módulo Muestras

```mermaid
flowchart TD
    %% Inicio del proceso
    A[🏠 Inicio Sistema Muestras] --> B{🔐 Verificar Rol Usuario}
    
    %% Rutas por rol
    B -->|visitador| C[👩‍⚕️ Dashboard Visitador]
    B -->|coordinador-lineas| D[👩‍💼 Dashboard Coordinadora]
    B -->|jefe-comercial| E[👨‍💼 Dashboard Jefe Comercial]
    B -->|laboratorio| F[🧪 Dashboard Laboratorio]
    B -->|jefe-operaciones| G[📊 Dashboard Jefe Proyectos]
    B -->|gerencia-general| H[📈 Dashboard Gerencia]
    B -->|admin| I[🔧 Dashboard Admin]
    B -->|No autorizado| X[❌ Acceso Denegado]
    
    %% VISITADOR - Registro inicial
    C --> C1[📋 Lista Muestras Registradas]
    C1 --> C2[➕ Agregar Nueva Muestra]
    C2 --> C3[📝 Formulario Registro]
    C3 --> C3A[📝 Nombre Muestra]
    C3 --> C3B[🏷️ Clasificación]
    C3 --> C3C[📊 Cantidad]
    C3 --> C3D[📋 Observaciones]
    C3 --> C3E[🧪 Tipo Muestra]
    C3 --> C3F[👨‍⚕️ Doctor]
    C3 --> C3G[📸 Foto Evidencia]
    C3G --> C4[💾 Guardar Muestra]
    C4 --> C5[📡 Trigger Evento Creación]
    C5 --> C6[📊 Estado: Pendiente]
    
    %% COORDINADORA - Aprobación nivel 1
    D --> D1[📋 Lista Todas las Muestras]
    D1 --> D2[🔍 Filtros y Búsqueda]
    D1 --> D3[➕ Crear Nueva Muestra]
    D1 --> D4[✏️ Editar Muestra]
    D1 --> D5[👁️ Ver Detalles]
    D1 --> D6[📅 Actualizar Fecha Entrega]
    
    %% Creación por coordinadora
    D3 --> D3A[📝 Formulario Completo]
    D3A --> D3B[💾 Guardar con Estado Pendiente]
    D3B --> D3C[📡 Evento Muestra Creada]
    
    %% Edición por coordinadora
    D4 --> D4A[📝 Modificar Datos]
    D4A --> D4B[📸 Actualizar Foto]
    D4B --> D4C[💾 Guardar Cambios]
    D4C --> D4D[📡 Evento Muestra Actualizada]
    
    %% Gestión fecha entrega
    D6 --> D6A[📅 Selector Fecha/Hora]
    D6A --> D6B[💾 Actualizar Fecha]
    D6B --> D6C[📧 Notificar Cambios]
    
    %% Exportación coordinadora
    D1 --> D7[📊 Exportar Excel]
    D7 --> D7A[📋 Seleccionar Registros]
    D7A --> D7B[📁 Generar Archivo]
    D7B --> D7C[💾 Descargar Excel]
    
    %% JEFE COMERCIAL - Aprobación nivel 2
    E --> E1[📋 Lista Muestras Pendientes]
    E1 --> E2[👁️ Ver Detalles Muestra]
    E2 --> E3[✅ Aprobar Muestra]
    E2 --> E4[❌ Rechazar Muestra]
    E3 --> E5[📊 Actualizar Campo: aprobado_jefe_comercial = true]
    E4 --> E6[📊 Mantener Campo: aprobado_jefe_comercial = false]
    E5 --> E7[📡 Notificar Aprobación]
    E6 --> E8[📡 Notificar Rechazo]
    
    %% Exportación jefe comercial
    E1 --> E9[📊 Exportar Excel JC]
    E9 --> E9A[📁 Reporte Jefe Comercial]
    
    %% LABORATORIO - Control de calidad
    F --> F1[📋 Lista Muestras por Estado]
    F1 --> F2[🔍 Filtrar por Estado]
    F2 --> F2A[⏳ Pendiente]
    F2 --> F2B[🔄 En Proceso]
    F2 --> F2C[✅ Completado]
    F2 --> F2D[❌ Rechazado]
    
    F1 --> F3[👁️ Ver Detalle Muestra]
    F3 --> F4[📊 Actualizar Estado]
    F4 --> F4A[⏳ → 🔄 En Proceso]
    F4 --> F4B[🔄 → ✅ Completado]
    F4 --> F4C[🔄 → ❌ Rechazado]
    F4 --> F4D[📝 Agregar Comentarios]
    
    F4D --> F5[💾 Guardar Cambios Estado]
    F5 --> F6[📡 Notificar Actualización]
    F6 --> F7[📧 Email a Supervisores]
    
    %% Exportación laboratorio
    F1 --> F8[📊 Exportar Excel LAB]
    F8 --> F8A[📁 Reporte Laboratorio]
    F8A --> F8B[📋 Estados, Fechas, Comentarios]
    
    %% JEFE DE PROYECTOS - Gestión precios
    G --> G1[💰 Lista Muestras con Precios]
    G1 --> G2[👁️ Ver Detalle Precio]
    G2 --> G3[✏️ Actualizar Precio]
    G3 --> G3A[💵 Nuevo Precio]
    G3A --> G3B[💾 Guardar Precio]
    G3B --> G3C[📊 Actualizar Campo Precio]
    G3C --> G3D[📡 Notificar Cambio Precio]
    
    %% GERENCIA GENERAL - Reportes ejecutivos
    H --> H1[📈 Reportes Ejecutivos]
    H1 --> H2[📊 Reporte General]
    H1 --> H3[🧪 Reporte Frasco Original]
    H1 --> H4[🧪 Reporte Frasco Muestra]
    H1 --> H5[📋 Clasificaciones]
    
    H2 --> H2A[📊 Estadísticas Globales]
    H3 --> H3A[📋 Filtro: tipo_muestra = "frasco original"]
    H4 --> H4A[📋 Filtro: tipo_muestra = "frasco muestra"]
    H5 --> H5A[📊 Análisis por Clasificación]
    
    %% Exportación gerencia
    H1 --> H6[📄 Exportar PDF]
    H6 --> H6A[📁 Reporte Gerencial PDF]
    H6A --> H6B[📊 Gráficos y Métricas]
    
    %% ADMIN - Gestión completa
    I --> I1[🔧 Acceso Total Sistema]
    I1 --> I2[👥 Gestión Usuarios]
    I1 --> I3[🏷️ Gestión Clasificaciones]
    I1 --> I4[📏 Gestión Unidades Medida]
    I1 --> I5[🔄 Gestión Estados]
    I1 --> I6[📊 Todos los Reportes]
    
    %% Flujo de aprobaciones
    C6 --> J[🔄 Flujo Aprobaciones]
    J --> J1{¿Aprobado Coordinadora?}
    J1 -->|No| J2[⏳ Pendiente Coordinadora]
    J1 -->|Sí| J3{¿Aprobado Jefe Comercial?}
    J3 -->|No| J4[⏳ Pendiente Jefe Comercial]
    J3 -->|Sí| J5[✅ Aprobado Completamente]
    
    J5 --> J6[🧪 Envío a Laboratorio]
    J6 --> J7[📊 Control de Calidad]
    J7 --> J8[💰 Asignación Precio]
    J8 --> J9[📈 Reporte Gerencial]
    
    %% Sistema de notificaciones
    C5 --> K[📢 Sistema Notificaciones]
    D4D --> K
    E7 --> K
    F6 --> K
    G3D --> K
    
    K --> K1[📱 Notificación Web]
    K --> K2[📧 Email Automático]
    K --> K3[📊 Actualización Dashboard]
    K --> K4[🔔 Alertas en Tiempo Real]
    
    %% Gestión de archivos
    C3G --> L[📁 Gestión Archivos]
    D4B --> L
    L --> L1[📸 Validación Imagen]
    L1 --> L2[📏 Redimensionar si Necesario]
    L2 --> L3[🏷️ Nombre Único]
    L3 --> L4[💾 Guardar en Storage]
    L4 --> L5[🔗 URL en Base Datos]
    
    %% Validaciones de datos
    C4 --> M[✅ Validaciones]
    D3B --> M
    D4C --> M
    M --> M1[📝 Validar Campos Requeridos]
    M1 --> M2[🔢 Validar Rangos Numéricos]
    M2 --> M3[📸 Validar Formato Imagen]
    M3 --> M4[🏷️ Validar Clasificación Existe]
    M4 --> M5[💾 Guardar si Todo OK]
    
    %% Estilos y colores
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef visitador fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef coordinadora fill:#fff3e0,stroke:#f57f17,stroke-width:2px,color:#000
    classDef jefeComercial fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef laboratorio fill:#e0f2f1,stroke:#00695c,stroke-width:2px,color:#000
    classDef jefeProyectos fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef gerencia fill:#e8eaf6,stroke:#3f51b5,stroke-width:2px,color:#000
    classDef admin fill:#fff8e1,stroke:#f9a825,stroke-width:2px,color:#000
    classDef decision fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    classDef notification fill:#f1f8e9,stroke:#689f38,stroke-width:2px,color:#000
    classDef database fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef error fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    
    class A,I startEnd
    class C,C1,C2,C3,C4,C5,C6 visitador
    class D,D1,D2,D3,D4,D5,D6,D7 coordinadora
    class E,E1,E2,E3,E4,E5,E9 jefeComercial
    class F,F1,F2,F3,F4,F5,F8 laboratorio
    class G,G1,G2,G3 jefeProyectos
    class H,H1,H2,H3,H4,H5,H6 gerencia
    class I1,I2,I3,I4,I5,I6 admin
    class B,J1,J3,M1,M2,M3,M4 decision
    class K,K1,K2,K3,K4 notification
    class M5,L4,L5 database
    class X error
```

---

## 📋 Funcionalidades Principales por Rol

### 1. 👩‍⚕️ **Visitador Médico**
- **Registro de muestras** con información completa
- **Upload de fotografías** como evidencia
- **Información del doctor** solicitante
- **Visualización** de muestras propias registradas

### 2. 👩‍💼 **Coordinadora de Líneas**
- **CRUD completo** de muestras
- **Aprobación nivel 1** de solicitudes
- **Gestión de fechas** de entrega
- **Exportación Excel** de reportes
- **Creación directa** de muestras

### 3. 👨‍💼 **Jefe Comercial**
- **Aprobación nivel 2** de muestras
- **Revisión detallada** antes de aprobación
- **Exportación de reportes** comerciales
- **Dashboard de pendientes** por aprobar

### 4. 🧪 **Laboratorio**
- **Control de calidad** y estados
- **Gestión de proceso** de muestras
- **Comentarios técnicos** y observaciones
- **Actualización de estados** del proceso
- **Exportación reportes** técnicos

### 5. 📊 **Jefe de Proyectos**
- **Gestión de precios** de muestras
- **Asignación de costos** por muestra
- **Dashboard de precios** pendientes
- **Reportes financieros** de muestras

### 6. 📈 **Gerencia General**
- **Reportes ejecutivos** completos
- **Análisis por tipo** de muestra
- **Estadísticas globales** del sistema
- **Exportación PDF** de reportes
- **Dashboards gerenciales**

---

## 🎛️ **Campos de la Base de Datos**

### Modelo Muestras:
```php
- nombre_muestra: string (Nombre de la muestra)
- clasificacion_id: foreign (Tipo de clasificación)
- cantidad_de_muestra: decimal (Cantidad solicitada)
- observacion: text (Observaciones generales)
- tipo_muestra: enum (frasco original, frasco muestra)
- name_doctor: string (Doctor solicitante)
- foto: string (URL de imagen evidencia)
- estado: enum (Pendiente, En Proceso, Completado, Rechazado)
- aprobado_jefe_comercial: boolean (Aprobación comercial)
- aprobado_coordinadora: boolean (Aprobación coordinadora)
- precio: decimal (Precio asignado)
- fecha_entrega: datetime (Fecha programada entrega)
- comentarios_laboratorio: text (Observaciones técnicas)
- created_by: foreign (Usuario creador)
```

### Modelo Clasificacion:
```php
- name: string (Nombre clasificación)
- descripcion: text (Descripción detallada)
- unidad_medida_id: foreign (Unidad de medida)
- activo: boolean (Estado activo)
```

---

## 🔧 **Tecnologías Utilizadas**

- **Laravel Framework** - Backend y lógica de negocio
- **Laravel Events** - Sistema de notificaciones automáticas
- **Maatwebsite Excel** - Exportación de reportes Excel
- **DomPDF** - Generación de reportes PDF
- **Intervention Image** - Procesamiento de imágenes
- **DataTables** - Tablas interactivas con filtros
- **Select2** - Selectores avanzados
- **Bootstrap** - Interface responsive

---

## 📊 **Estados y Flujos**

### Estados de Muestra:
- **Pendiente** ⏳ - Recién registrada, esperando procesamiento
- **En Proceso** 🔄 - En revisión o producción en laboratorio
- **Completado** ✅ - Muestra lista y entregada
- **Rechazado** ❌ - Muestra rechazada por no cumplir criterios

### Flujo de Aprobaciones:
1. **Registro** por Visitador → Estado: Pendiente
2. **Aprobación Coordinadora** → aprobado_coordinadora = true
3. **Aprobación Jefe Comercial** → aprobado_jefe_comercial = true
4. **Procesamiento Laboratorio** → Estados técnicos
5. **Asignación Precio** → Campo precio actualizado
6. **Reporte Gerencial** → Análisis ejecutivo

---

## 📈 **Métricas y KPIs**

- **Muestras por estado** y progreso
- **Tiempo promedio** de aprobación
- **Porcentaje de aprobación** por nivel
- **Productividad por visitador**
- **Análisis de precios** por clasificación
- **Reportes gerenciales** por período

---

## 🔒 **Seguridad y Validación**

- **Middleware de roles** específicos por funcionalidad
- **Validación de imágenes** (formatos y tamaños)
- **Validación de rangos** numéricos (cantidad 1-10,000)
- **Sanitización de archivos** y nombres únicos
- **Control de acceso** granular por rol
- **Trazabilidad completa** de cambios

---

## 📝 **Notas Técnicas**

- El **sistema de eventos** notifica automáticamente cambios
- Las **imágenes se redimensionan** automáticamente para optimizar storage
- Los **reportes se generan** en tiempo real con filtros avanzados
- El **flujo de aprobaciones** es secuencial y trazable
- La **exportación Excel/PDF** incluye todos los datos relevantes por rol
- El **sistema mantiene historial** completo de cambios y aprobaciones
