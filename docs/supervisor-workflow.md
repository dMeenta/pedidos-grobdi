# 👨‍💼 Módulo Supervisor - Workflow del Sistema

## 📊 Descripción General

El módulo de **Supervisor** es el sistema de gestión y mantenimiento de datos maestros del sistema GROBDI. Se encarga del mantenimiento de doctores, centros de salud, especialidades, categorías médicas, listas de enrutamiento y toda la infraestructura de datos que soporta el sistema de visitadoras médicas.

## 🔧 Componentes Técnicos

### Controladores Principales
- **DoctorController** - CRUD completo de doctores
- **CentroSaludController** - Gestión de centros de salud
- **EspecialidadController** - Mantenimiento de especialidades médicas
- **CategoriaDoctorController** - Gestión de categorías de doctores
- **ListaController** - Gestión de listas de enrutamiento
- **EnrutamientoController** - Sistema de enrutamiento mensual
- **VisitaDoctorController** - Aprobación/rechazo de visitas

### Modelos Utilizados
- **Doctor** - Información completa de doctores
- **CentroSalud** - Centros médicos y clínicas
- **Especialidad** - Especialidades médicas
- **CategoriaDoctor** - Categorías con prioridades y montos
- **Lista** - Listas semanales de enrutamiento
- **Enrutamiento** - Enrutamiento mensual por zonas
- **VisitaDoctor** - Visitas programadas
- **EstadoVisita** - Estados de las visitas

### Rutas y Middleware
```php
Route::middleware(['checkRole:supervisor,admin'])->group(function () {
    // Mantenimiento de datos maestros
    Route::resource('centrosalud', CentroSaludController::class);
    Route::resource('especialidad', EspecialidadController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('lista', ListaController::class);
    
    // Sistema de enrutamiento
    Route::get('/enrutamiento', [EnrutamientoController::class, 'index']);
    Route::post('/enrutamiento/store', [EnrutamientoController::class, 'store']);
    Route::post('/enrutamientolista/store', [EnrutamientoController::class, 'Enrutamientolistastore']);
    
    // Gestión de visitas
    Route::get('/enrutamientolista/{id}', [EnrutamientoController::class, 'DoctoresLista']);
    Route::put('/enrutamientolista/doctor/{id}', [EnrutamientoController::class, 'DoctoresListaUpdate']);
    Route::post('/visitadoctornuevo/{id}/aprobar', [VisitaDoctorController::class, 'aprobar']);
    Route::post('/visitadoctornuevo/{id}/rechazar', [VisitaDoctorController::class, 'rechazar']);
    
    // Funciones auxiliares
    Route::post('/doctor/cargadata', [DoctorController::class, 'cargadata']);
    Route::get('centrosaludbuscar', CentroSaludController::class.'@buscar');
});
```

### Vistas Principales
- **resources/views/rutas/mantenimiento/** - CRUDs de mantenimiento
- **resources/views/rutas/enrutamiento/** - Sistema de enrutamiento
- **resources/views/rutas/enrutamiento/doctoreslista.blade.php** - Lista de doctores

## 🎯 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| `supervisor` | ✅ Acceso completo al módulo |
| `admin` | ✅ Acceso completo al módulo |

---

## 🔄 Diagrama de Flujo del Módulo Supervisor

```mermaid
flowchart TD
    %% Inicio del proceso
    A[🏠 Inicio Sesión Supervisor] --> B{🔐 Verificar Rol}
    B -->|supervisor/admin| C[👨‍💼 Dashboard Supervisor]
    B -->|No autorizado| X[❌ Acceso Denegado]
    
    %% Dashboard principal
    C --> D[🔧 Mantenimiento Datos Maestros]
    C --> E[🗺️ Sistema Enrutamiento]
    C --> F[✅ Aprobación Visitas]
    
    %% MANTENIMIENTO DATOS MAESTROS
    D --> D1[👨‍⚕️ Gestión Doctores]
    D --> D2[🏥 Gestión Centros Salud]
    D --> D3[🩺 Gestión Especialidades]
    D --> D4[🏷️ Gestión Categorías]
    D --> D5[📋 Gestión Listas]
    
    %% GESTIÓN DOCTORES
    D1 --> D1A[📋 Lista Todos los Doctores]
    D1A --> D1B[🔍 Búsqueda y Filtros]
    D1A --> D1C[➕ Crear Nuevo Doctor]
    D1A --> D1D[✏️ Editar Doctor]
    D1A --> D1E[🗑️ Habilitar/Deshabilitar]
    D1A --> D1F[📤 Importar Excel]
    D1A --> D1G[🔍 Scraping CMP]
    
    %% Crear nuevo doctor
    D1C --> D1C1[📝 Formulario Completo]
    D1C1 --> D1C2[👤 Datos Personales]
    D1C1 --> D1C3[🏥 Datos Profesionales]
    D1C1 --> D1C4[📍 Datos Ubicación]
    D1C1 --> D1C5[📅 Días y Horarios]
    D1C1 --> D1C6[👩‍💼 Datos Secretaria]
    D1C6 --> D1C7[💾 Guardar Doctor]
    
    %% Datos personales
    D1C2 --> D1C2A[👤 Nombre Completo]
    D1C2 --> D1C2B[📞 Teléfono]
    D1C2 --> D1C2C[🎂 Fecha Nacimiento]
    D1C2 --> D1C2D[🆔 CMP]
    
    %% Datos profesionales
    D1C3 --> D1C3A[🩺 Especialidad]
    D1C3 --> D1C3B[🏷️ Categoría Doctor]
    D1C3 --> D1C3C[👨‍⚕️ Tipo Médico]
    D1C3 --> D1C3D[🏥 Centro de Salud]
    
    %% Datos ubicación
    D1C4 --> D1C4A[📍 Distrito]
    D1C4 --> D1C4B[🏥 Consultorio Asignado]
    D1C4 --> D1C4C[📝 Observaciones]
    
    %% Días y horarios
    D1C5 --> D1C5A[📅 Seleccionar Días]
    D1C5 --> D1C5B[⏰ Turnos por Día]
    D1C5B --> D1C5B1[🌅 Mañana]
    D1C5B --> D1C5B2[🌆 Tarde]
    
    %% Scraping CMP
    D1G --> D1G1[🔍 Consulta Web CMP]
    D1G1 --> D1G2[📊 Obtener Datos Oficiales]
    D1G2 --> D1G3[📝 Autocompletar Formulario]
    D1G3 --> D1G4[✅ Validar Información]
    
    %% Importación Excel
    D1F --> D1F1[📁 Cargar Archivo Excel]
    D1F1 --> D1F2[🔍 Validar Formato]
    D1F2 --> D1F3[📊 Procesar Datos]
    D1F3 --> D1F4[💾 Importar Registros]
    D1F4 --> D1F5[📊 Reporte Importación]
    
    %% GESTIÓN CENTROS DE SALUD
    D2 --> D2A[📋 Lista Centros Salud]
    D2A --> D2B[➕ Crear Centro]
    D2A --> D2C[✏️ Editar Centro]
    D2A --> D2D[🗑️ Habilitar/Deshabilitar]
    D2A --> D2E[🔍 Búsqueda AJAX]
    
    %% Crear centro de salud
    D2B --> D2B1[📝 Formulario Centro]
    D2B1 --> D2B2[🏥 Nombre Centro]
    D2B1 --> D2B3[📝 Descripción]
    D2B1 --> D2B4[📍 Dirección]
    D2B1 --> D2B5[🌍 Coordenadas GPS]
    D2B5 --> D2B6[💾 Guardar Centro]
    
    %% GESTIÓN ESPECIALIDADES
    D3 --> D3A[📋 Lista Especialidades]
    D3A --> D3B[➕ Crear Especialidad]
    D3A --> D3C[✏️ Editar Especialidad]
    D3A --> D3D[🗑️ Eliminar Especialidad]
    
    %% GESTIÓN CATEGORÍAS
    D4 --> D4A[📋 Lista Categorías]
    D4A --> D4B[➕ Crear Categoría]
    D4A --> D4C[✏️ Editar Categoría]
    D4A --> D4D[🗑️ Eliminar Categoría]
    
    %% Crear categoría
    D4B --> D4B1[📝 Formulario Categoría]
    D4B1 --> D4B2[🏷️ Nombre Categoría]
    D4B1 --> D4B3[🔢 Prioridad]
    D4B1 --> D4B4[💰 Monto Asignado]
    D4B4 --> D4B5[💾 Guardar Categoría]
    
    %% GESTIÓN LISTAS
    D5 --> D5A[📋 Lista de Listas]
    D5A --> D5B[➕ Crear Lista]
    D5A --> D5C[✏️ Editar Lista]
    D5A --> D5D[🗑️ Eliminar Lista]
    D5A --> D5E[🗺️ Asignar Distritos]
    
    %% SISTEMA ENRUTAMIENTO
    E --> E1[📅 Enrutamiento Mensual]
    E1 --> E2[📊 Lista Enrutamientos]
    E2 --> E3[➕ Crear Enrutamiento]
    E2 --> E4[👁️ Ver Enrutamiento]
    
    %% Crear enrutamiento
    E3 --> E3A[📅 Seleccionar Mes/Año]
    E3A --> E3B[🗺️ Seleccionar Zona]
    E3B --> E3C[👩‍⚕️ Asignar Visitadora]
    E3C --> E3D[💾 Crear Enrutamiento]
    
    %% Ver enrutamiento
    E4 --> E4A[📋 Listas del Mes]
    E4A --> E4B[➕ Agregar Lista]
    E4A --> E4C[👁️ Ver Doctores Lista]
    
    %% Agregar lista a enrutamiento
    E4B --> E4B1[📋 Seleccionar Lista]
    E4B1 --> E4B2[📅 Fecha Inicio]
    E4B1 --> E4B3[📅 Fecha Fin]
    E4B3 --> E4B4[💾 Asignar Lista]
    E4B4 --> E4B5[👨‍⚕️ Auto-crear VisitaDoctor]
    
    %% Auto-creación de visitas
    E4B5 --> E4B5A[🔍 Obtener Doctores por Distrito]
    E4B5A --> E4B5B[📅 Asignar Días/Turnos]
    E4B5B --> E4B5C[📊 Estado: Sin Turno]
    E4B5C --> E4B5D[💾 Crear Registros VisitaDoctor]
    
    %% Ver doctores de lista
    E4C --> E4C1[📋 Lista Doctores Asignados]
    E4C1 --> E4C2[👁️ Ver Detalles Doctor]
    E4C1 --> E4C3[📅 Asignar Fecha]
    E4C1 --> E4C4[✅ Aprobar Visita]
    E4C1 --> E4C5[❌ Rechazar Visita]
    
    %% Asignar fecha a visita
    E4C3 --> E4C3A[📅 Selector Fecha]
    E4C3A --> E4C3B[⏰ Selector Turno]
    E4C3B --> E4C3C[📝 Observaciones]
    E4C3C --> E4C3D[💾 Actualizar Visita]
    E4C3D --> E4C3E[📊 Estado: Programado]
    
    %% APROBACIÓN VISITAS
    F --> F1[📋 Lista Visitas Pendientes]
    F1 --> F2[👁️ Ver Detalle Visita]
    F2 --> F3[✅ Aprobar Visita]
    F2 --> F4[❌ Rechazar Visita]
    F2 --> F5[🔄 Reprogramar Visita]
    
    %% Aprobar visita
    F3 --> F3A[📊 Estado: Visitado]
    F3A --> F3B[👨‍⚕️ Activar Doctor]
    F3B --> F3C[📡 Notificar Aprobación]
    
    %% Rechazar visita
    F4 --> F4A[📊 Estado: Rechazado]
    F4A --> F4B[📝 Agregar Motivo]
    F4B --> F4C[📡 Notificar Rechazo]
    
    %% Estados del sistema
    E4B5C --> G[📊 Estados VisitaDoctor]
    G --> G1[⚪ Sin Turno (1)]
    G --> G2[🟡 Programado (2)]
    G --> G3[🔴 Rechazado (3)]
    G --> G4[🟢 Visitado (4)]
    G --> G5[🟠 Reprogramado (5)]
    G --> G6[⚫ Eliminado (6)]
    
    %% Transiciones de estado
    G1 --> G2[📅 Asignar Fecha/Turno]
    G2 --> G4[✅ Aprobar Supervisor]
    G2 --> G3[❌ Rechazar Supervisor]
    G3 --> G5[🔄 Reprogramar]
    G5 --> G2[📅 Nueva Fecha]
    
    %% Sistema de validaciones
    D1C7 --> H[✅ Validaciones Sistema]
    D2B6 --> H
    E3D --> H
    E4B4 --> H
    H --> H1[📝 Validar Campos Requeridos]
    H1 --> H2[🔍 Validar Duplicados]
    H2 --> H3[📞 Validar Formatos]
    H3 --> H4[🗺️ Validar Relaciones]
    H4 --> H5[💾 Guardar si Todo OK]
    
    %% Búsquedas y filtros
    D1B --> I[🔍 Sistema Búsquedas]
    D2E --> I
    I --> I1[📝 Búsqueda por Texto]
    I --> I2[📊 Filtros por Estado]
    I --> I3[🏷️ Filtros por Categoría]
    I --> I4[🗺️ Filtros por Ubicación]
    I1 --> I5[📋 Resultados Filtrados]
    I2 --> I5
    I3 --> I5
    I4 --> I5
    
    %% Reportes y estadísticas
    C --> J[📊 Reportes Supervisor]
    J --> J1[👨‍⚕️ Reporte Doctores]
    J --> J2[🏥 Reporte Centros]
    J --> J3[📅 Reporte Visitas]
    J --> J4[📈 Estadísticas Generales]
    
    %% Notificaciones
    F3C --> K[📢 Sistema Notificaciones]
    F4C --> K
    E4B5D --> K
    K --> K1[📱 Notificación Web]
    K --> K2[📧 Email Automático]
    K --> K3[📊 Dashboard Updates]
    K --> K4[🔔 Alertas Tiempo Real]
    
    %% Gestión de errores
    H5 --> H5A{¿Errores?}
    H5A -->|Sí| H5B[❌ Mostrar Errores]
    H5A -->|No| H5C[✅ Operación Exitosa]
    H5B --> H5D[🔙 Retornar a Formulario]
    H5C --> H5E[📊 Actualizar Vista]
    
    %% Estilos y colores
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57f17,stroke-width:2px,color:#000
    classDef action fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef database fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef maintenance fill:#f1f8e9,stroke:#689f38,stroke-width:2px,color:#000
    classDef routing fill:#e0f2f1,stroke:#00695c,stroke-width:2px,color:#000
    classDef approval fill:#fff8e1,stroke:#f9a825,stroke-width:2px,color:#000
    classDef notification fill:#e8eaf6,stroke:#3f51b5,stroke-width:2px,color:#000
    classDef error fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    classDef states fill:#f9fbe7,stroke:#827717,stroke-width:2px,color:#000
    
    class A,C startEnd
    class D,E,F,D1,D2,D3,D4,D5,E1,F1 process
    class B,H5A,G decision
    class D1C,D2B,D4B,E3,E4B,F3,F4 action
    class H5,D1C7,D2B6,E3D,E4B4 database
    class D1A,D1B,D1C,D1D,D1E,D1F,D1G,D2A,D2B,D2C,D2D,D3A,D4A,D5A maintenance
    class E2,E3,E4,E4A,E4B,E4C routing
    class F2,F3,F4,F5,G1,G2,G3,G4,G5,G6 approval
    class K,K1,K2,K3,K4 notification
    class X,H5B,H5D error
    class G,G1,G2,G3,G4,G5,G6 states
```

---

## 📋 Funcionalidades Principales

### 1. 👨‍⚕️ **Gestión Completa de Doctores**
- **CRUD completo** con validaciones avanzadas
- **Scraping automático** del CMP para datos oficiales
- **Importación Excel** masiva de doctores
- **Gestión de horarios** y disponibilidad
- **Estados activo/inactivo** para control

### 2. 🏥 **Mantenimiento Centros de Salud**
- **Registro completo** con ubicación GPS
- **Búsqueda AJAX** para selección rápida
- **Estados habilitado/deshabilitado**
- **Creación rápida** desde modales

### 3. 🩺 **Gestión de Especialidades**
- **CRUD básico** de especialidades médicas
- **Validación de unicidad** de nombres
- **Asociación con doctores**

### 4. 🏷️ **Categorías de Doctores**
- **Gestión de categorías** con prioridades
- **Asignación de montos** por categoría
- **Sistema de priorización** automático

### 5. 📋 **Sistema de Listas**
- **Creación de listas** semanales
- **Asignación de distritos** por lista
- **Gestión de períodos** de cobertura

### 6. 🗺️ **Enrutamiento Mensual**
- **Planificación mensual** por zonas
- **Asignación de visitadoras** por zona
- **Auto-generación** de visitas programadas
- **Gestión de listas** por semana

### 7. ✅ **Aprobación de Visitas**
- **Revisión de visitas** programadas
- **Aprobación/rechazo** con observaciones
- **Control de estados** de visita
- **Activación automática** de doctores

---

## 🎛️ **Campos de la Base de Datos**

### Modelo Doctor:
```php
- name: string (Nombre)
- first_lastname: string (Apellido paterno)
- second_lastname: string (Apellido materno)
- CMP: string (Colegio Médico del Perú)
- phone: string (Teléfono)
- birthdate: date (Fecha nacimiento)
- distrito_id: foreign (Distrito)
- centrosalud_id: foreign (Centro de salud)
- especialidad_id: foreign (Especialidad)
- categoria_medico: string (Categoría médica)
- tipo_medico: string (Tipo de médico)
- asignado_consultorio: string (Consultorio)
- songs: boolean (Tiene hijos)
- name_secretariat: string (Nombre secretaria)
- phone_secretariat: string (Teléfono secretaria)
- observations: text (Observaciones)
- recuperacion: string (Estado recuperación)
- state: boolean (Activo/Inactivo)
- user_id: foreign (Usuario creador)
```

### Modelo CentroSalud:
```php
- name: string (Nombre centro)
- description: text (Descripción)
- adress: string (Dirección)
- latitude: decimal (Latitud GPS)
- longitude: decimal (Longitud GPS)
- state: boolean (Activo/Inactivo)
```

### Modelo Enrutamiento:
```php
- fecha: date (Mes de enrutamiento)
- zone_id: foreign (Zona asignada)
- user_id: foreign (Usuario supervisor)
```

### Modelo VisitaDoctor:
```php
- doctor_id: foreign (Doctor)
- enrutamientolista_id: foreign (Lista semana)
- estado_visita_id: foreign (Estado visita)
- fecha: date (Fecha programada)
- turno: integer (0=Mañana, 1=Tarde)
- observaciones_visita: text (Observaciones)
- latitude: decimal (GPS visita)
- longitude: decimal (GPS visita)
- created_by: foreign (Usuario creador)
```

---

## 🔧 **Tecnologías Utilizadas**

- **Laravel Framework** - Backend y lógica de negocio
- **Web Scraping** - Consulta automática del CMP
- **Maatwebsite Excel** - Importación masiva de datos
- **AJAX/jQuery** - Búsquedas en tiempo real
- **Bootstrap** - Interface responsive y componentes UI
- **Select2** - Selectores avanzados con búsqueda
- **DataTables** - Tablas interactivas con filtros
- **Carbon** - Manejo avanzado de fechas

---

## 📊 **Estados del Sistema**

### Estados de Visita Doctor:
- **Sin Turno (1)** ⚪ - Doctor sin horario asignado
- **Programado (2)** 🟡 - Visita programada por supervisor
- **Rechazado (3)** 🔴 - Visita rechazada por supervisor
- **Visitado (4)** 🟢 - Visita realizada y aprobada
- **Reprogramado (5)** 🟠 - Visita reprogramada
- **Eliminado (6)** ⚫ - Doctor eliminado de lista

### Estados de Doctor:
- **Activo (1)** ✅ - Doctor habilitado para visitas
- **Inactivo (0)** ❌ - Doctor deshabilitado

### Estados de Centro de Salud:
- **Habilitado (1)** ✅ - Centro activo
- **Deshabilitado (0)** ❌ - Centro inactivo

---

## 📈 **Métricas y KPIs**

- **Doctores activos** por distrito/especialidad
- **Centros de salud** por zona geográfica
- **Visitas programadas** vs realizadas
- **Porcentaje de aprobación** de visitas
- **Cobertura médica** por especialidad
- **Eficiencia de enrutamiento** por visitadora

---

## 🔒 **Seguridad y Validación**

- **Middleware de roles** (supervisor, admin)
- **Validación de CMP** único por doctor
- **Validación de relaciones** entre entidades
- **Sanitización de datos** en formularios
- **Control de estados** y transiciones válidas
- **Logs de actividad** para auditoría

---

## 🔄 **Flujos de Trabajo**

### Flujo de Creación de Doctor:
1. **Búsqueda CMP** → Scraping datos oficiales
2. **Autocompletado** → Formulario con datos
3. **Validación** → Verificar unicidad y formato
4. **Asignación** → Centro, especialidad, horarios
5. **Creación** → Registro en base de datos
6. **Activación** → Estado activo para visitas

### Flujo de Enrutamiento:
1. **Creación mensual** → Enrutamiento por zona
2. **Asignación listas** → Períodos semanales
3. **Auto-generación** → VisitaDoctor por distrito
4. **Programación** → Fechas y turnos
5. **Aprobación** → Supervisor valida visitas
6. **Ejecución** → Visitadoras realizan rutas

---

## 📝 **Notas Técnicas**

- El **scraping del CMP** obtiene datos oficiales automáticamente
- La **importación Excel** permite carga masiva con validaciones
- El **sistema de enrutamiento** auto-asigna doctores por distrito
- Los **estados de visita** tienen transiciones controladas
- La **geolocalización** se integra para validar ubicaciones
- El **sistema mantiene trazabilidad** completa de cambios
