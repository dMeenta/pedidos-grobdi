# 👩‍⚕️ Módulo Visitadoras - Workflow del Sistema

## 📊 Descripción General

El módulo de **Visitadoras** es el sistema de gestión de rutas médicas y visitas a doctores del sistema GROBDI. Se encarga de la planificación, asignación y seguimiento de visitas médicas, gestión de calendarios, mantenimiento de información de doctores y centros de salud.

## 🔧 Componentes Técnicos

### Controladores Principales
- **RutasVisitadoraController** - Gestión de rutas y listas de visitas
- **EnrutamientoController** - Enrutamiento y asignación de visitas
- **DoctorController** - Mantenimiento de doctores
- **CentroSaludController** - Gestión de centros de salud
- **VisitaDoctorController** - Gestión de visitas individuales

### Modelos Utilizados
- **VisitaDoctor** - Entidad principal de visitas
- **Doctor** - Información de doctores
- **CentroSalud** - Centros médicos
- **EnrutamientoLista** - Listas de enrutamiento por semana
- **EstadoVisita** - Estados de las visitas

### Rutas y Middleware
```php
Route::middleware(['checkRole:visitador,admin'])->group(function () {
    Route::resource('visitadoctor', VisitaDoctorController::class);
    Route::get('calendariovisitadora',[EnrutamientoController::class,'calendariovisitadora']);
    Route::get('rutasvisitadora',[RutasVisitadoraController::class,'index']);
    Route::get('rutasvisitadora/{id}',[RutasVisitadoraController::class,'listadoctores']);
    Route::post('/rutasvisitadora/asignar', [RutasVisitadoraController::class, 'asignar']);
    Route::post('/rutasvisitadora/doctores', [DoctorController::class, 'guardarDoctorVisitador']);
});
```

### Vistas Principales
- **resources/views/rutas/visita/misrutas.blade.php** - Dashboard principal
- **resources/views/rutas/visita/doctoresrutas.blade.php** - Lista de doctores
- **resources/views/rutas/visita/calendario.blade.php** - Calendario de visitas

## 🎯 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| `visitador` | ✅ Acceso completo al módulo de su zona |
| `admin` | ✅ Acceso completo a todas las zonas |
| `supervisor` | ✅ Mantenimiento de doctores y centros |

---

## 🔄 Diagrama de Flujo del Módulo Visitadoras

```mermaid
flowchart TD
    %% Inicio del proceso
    A[🏠 Inicio Sesión Visitadora] --> B{🔐 Verificar Rol}
    B -->|visitador/admin| C[🗺️ Verificar Zona Asignada]
    B -->|No autorizado| X[❌ Acceso Denegado]
    
    %% Dashboard principal
    C --> D[📋 Dashboard Visitadoras]
    D --> E[📅 Mes Actual]
    E --> F[📊 Lista de Semanas]
    
    %% Información de semanas
    F --> F1[📝 Nombre Lista]
    F --> F2[📅 Fecha Inicio]
    F --> F3[📅 Fecha Fin]
    F --> F4[👩‍⚕️ Ver Doctores]
    
    %% Gestión de doctores por lista
    F4 --> G[👨‍⚕️ Lista Doctores]
    G --> G1[👤 Información Doctor]
    G --> G2[📊 Estado Visita]
    G --> G3[📅 Fecha Programada]
    G --> G4[⏰ Turno Asignado]
    G --> G5[⚙️ Acciones]
    
    %% Estados de visita disponibles
    G2 --> G2A{Estado Actual}
    G2A -->|1| G2B[⚪ Sin Turno]
    G2A -->|2| G2C[🟡 Programado]
    G2A -->|3| G2D[🔴 Rechazado]
    G2A -->|4| G2E[🟢 Visitado]
    G2A -->|5| G2F[🟠 Reprogramado]
    G2A -->|6| G2G[⚫ Eliminado]
    
    %% Acciones disponibles
    G5 --> H[📝 Asignar Visita]
    G5 --> I[✏️ Editar Información]
    G5 --> J[👁️ Ver Detalles]
    
    %% Modal de asignación de visita
    H --> H1[📝 Modal Asignar Visita]
    H1 --> H2[📅 Seleccionar Fecha]
    H1 --> H3[⏰ Seleccionar Turno]
    H1 --> H4[📝 Observaciones]
    H1 --> H5[💾 Guardar Asignación]
    
    %% Turnos disponibles
    H3 --> H3A[🌅 Mañana (0)]
    H3 --> H3B[🌆 Tarde (1)]
    
    %% Procesamiento de asignación
    H5 --> K[🔄 Procesar Asignación]
    K --> K1[✅ Validar Datos]
    K1 --> K2[📊 Actualizar Estado]
    K2 --> K3[💾 Guardar en BD]
    K3 --> K4[📡 Notificar Cambios]
    K4 --> K5[✅ Mensaje Éxito]
    
    %% Agregar nuevo doctor
    G --> L[➕ Agregar Doctor]
    L --> L1[📝 Modal Crear Doctor]
    L1 --> L2[👤 Datos Básicos]
    L1 --> L3[🏥 Centro de Salud]
    L1 --> L4[📞 Información Contacto]
    L1 --> L5[📅 Días Disponibles]
    L1 --> L6[💾 Guardar Doctor]
    
    %% Datos básicos del doctor
    L2 --> L2A[👤 Nombre Completo]
    L2 --> L2B[📧 CMP (Colegio Médico)]
    L2 --> L2C[🎂 Fecha Nacimiento]
    L2 --> L2D[📱 Teléfono]
    L2 --> L2E[🏥 Especialidad]
    
    %% Centro de salud
    L3 --> L3A[🔍 Buscar Centro]
    L3A --> L3B[📋 Seleccionar Existente]
    L3A --> L3C[➕ Crear Nuevo]
    
    %% Información contacto
    L4 --> L4A[👩‍💼 Nombre Secretaria]
    L4A --> L4B[📞 Teléfono Secretaria]
    L4B --> L4C[📍 Dirección]
    L4C --> L4D[📝 Referencias]
    
    %% Días y horarios
    L5 --> L5A[📅 Seleccionar Días]
    L5A --> L5B[⏰ Turnos por Día]
    L5B --> L5C[📊 Horarios Disponibles]
    
    %% Calendario de visitas
    D --> M[📅 Calendario Visitadora]
    M --> M1[🗓️ Vista Calendario]
    M1 --> M2[📊 Eventos Visitas]
    M2 --> M3[🎨 Códigos de Color]
    M3 --> M4[📝 Detalles Evento]
    
    %% Códigos de color del calendario
    M3 --> M3A[🟢 Visitado]
    M3 --> M3B[🟡 Programado]
    M3 --> M3C[🔴 Rechazado]
    M3 --> M3D[🟠 Reprogramado]
    M3 --> M3E[⚪ Sin Turno]
    
    %% Detalle de visita en calendario
    M4 --> N[📋 Detalle Visita]
    N --> N1[👨‍⚕️ Información Doctor]
    N --> N2[🏥 Centro de Salud]
    N --> N3[📅 Fecha y Hora]
    N --> N4[📊 Estado Actual]
    N --> N5[📝 Observaciones]
    N --> N6[⚙️ Acciones]
    
    %% Acciones en detalle
    N6 --> O[✅ Marcar Visitado]
    N6 --> P[❌ Rechazar Visita]
    N6 --> Q[🔄 Reprogramar]
    N6 --> R[📝 Agregar Observaciones]
    
    %% Marcar como visitado
    O --> O1[📍 Obtener Geolocalización]
    O1 --> O2[📸 Capturar Evidencia]
    O2 --> O3[📝 Agregar Notas]
    O3 --> O4[💾 Guardar Visita]
    O4 --> O5[📡 Notificar Sistema]
    
    %% Gestión de ubicación
    O1 --> O1A[🌍 GPS Automático]
    O1A --> O1B[📍 Coordenadas]
    O1B --> O1C[🗺️ Validar Ubicación]
    
    %% Mantenimiento de doctores (Supervisor)
    D --> S[🔧 Mantenimiento]
    S --> S1[👨‍⚕️ Gestión Doctores]
    S --> S2[🏥 Centros de Salud]
    S --> S3[🩺 Especialidades]
    S --> S4[📊 Categorías]
    
    %% CRUD Doctores
    S1 --> S1A[📋 Lista Doctores]
    S1A --> S1B[➕ Crear Doctor]
    S1A --> S1C[✏️ Editar Doctor]
    S1A --> S1D[🗑️ Eliminar Doctor]
    S1A --> S1E[📤 Importar Excel]
    
    %% CRUD Centros de Salud
    S2 --> S2A[📋 Lista Centros]
    S2A --> S2B[➕ Crear Centro]
    S2A --> S2C[✏️ Editar Centro]
    S2A --> S2D[🗑️ Eliminar Centro]
    S2A --> S2E[🔍 Búsqueda AJAX]
    
    %% Filtrado y búsqueda
    G --> T[🔍 Filtros Avanzados]
    T --> T1[📊 Por Estado]
    T --> T2[📅 Por Fecha]
    T --> T3[👨‍⚕️ Por Doctor]
    T --> T4[🏥 Por Centro]
    T1 --> T5[📋 Resultados Filtrados]
    T2 --> T5
    T3 --> T5
    T4 --> T5
    
    %% Validaciones y errores
    K1 --> K1A{¿Datos Válidos?}
    K1A -->|Sí| K2
    K1A -->|No| K1B[❌ Errores Validación]
    K1B --> K1C[📝 Mostrar Errores]
    K1C --> H1
    
    %% Reportes y estadísticas
    D --> U[📊 Reportes]
    U --> U1[📈 Estadísticas Mes]
    U --> U2[📊 Visitas por Estado]
    U --> U3[👨‍⚕️ Rendimiento Visitadora]
    U --> U4[📅 Planificación Semanal]
    
    %% Notificaciones sistema
    K4 --> V[📢 Sistema Notificaciones]
    V --> V1[📱 Notificación Móvil]
    V --> V2[📧 Email Supervisor]
    V --> V3[📊 Actualizar Dashboard]
    V --> V4[🔔 Alertas Tiempo Real]
    
    %% Estilos y colores
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57f17,stroke-width:2px,color:#000
    classDef action fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef database fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef calendar fill:#e0f2f1,stroke:#00695c,stroke-width:2px,color:#000
    classDef notification fill:#fff8e1,stroke:#f9a825,stroke-width:2px,color:#000
    classDef error fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    classDef maintenance fill:#f1f8e9,stroke:#689f38,stroke-width:2px,color:#000
    classDef gps fill:#e8eaf6,stroke:#3f51b5,stroke-width:2px,color:#000
    
    class A,D startEnd
    class E,F,G,L,M,S,T,U process
    class B,G2A,K1A,H3 decision
    class H1,K,L1,N,O4 action
    class K3,O4,O5 database
    class M1,M2,M3,M4 calendar
    class K4,V,V1,V2,V3,V4 notification
    class X,K1B error
    class S1,S2,S3,S4 maintenance
    class O1,O1A,O1B,O1C gps
```

---

## 📋 Funcionalidades Principales

### 1. 🗺️ **Gestión de Rutas por Zona**
- **Asignación automática** de listas por zona de visitadora
- **Filtrado por mes** actual y visualización de semanas
- **Información completa** de períodos de visita
- **Gestión de múltiples zonas** por visitadora

### 2. 👨‍⚕️ **Gestión de Doctores**
- **Lista completa** de doctores asignados por semana
- **Información detallada** (nombre, centro de salud, especialidad)
- **Estados de visita** con códigos de color
- **Asignación de fechas** y turnos de visita

### 3. 📅 **Sistema de Calendario**
- **Vista calendario** con eventos de visitas
- **Códigos de color** por estado de visita
- **Información detallada** al hacer clic en eventos
- **Navegación mensual** y visualización por semanas

### 4. 📊 **Estados de Visita**
- **Sin Turno (1)** ⚪ - Doctor sin horario asignado
- **Programado (2)** 🟡 - Visita programada
- **Rechazado (3)** 🔴 - Visita rechazada
- **Visitado (4)** 🟢 - Visita realizada exitosamente
- **Reprogramado (5)** 🟠 - Visita reprogramada
- **Eliminado (6)** ⚫ - Doctor eliminado de la lista

### 5. 🏥 **Mantenimiento de Centros de Salud**
- **CRUD completo** de centros médicos
- **Búsqueda AJAX** para selección rápida
- **Creación rápida** desde modales
- **Validación de datos** y estados activos

### 6. 📍 **Geolocalización y Evidencia**
- **GPS automático** para verificar ubicación de visitas
- **Captura de coordenadas** y validación de proximidad
- **Sistema de evidencias** fotográficas
- **Trazabilidad completa** de visitas realizadas

---

## 🎛️ **Campos de la Base de Datos**

### Campos VisitaDoctor:
```php
- doctor_id: foreign (Doctor visitado)
- enrutamientolista_id: foreign (Lista/semana asignada)
- estado_visita_id: foreign (Estado actual)
- fecha: date (Fecha programada)
- turno: integer (0=Mañana, 1=Tarde)
- observaciones_visita: text (Notas de la visita)
- latitude: decimal (Coordenada GPS)
- longitude: decimal (Coordenada GPS)
- created_by: foreign (Usuario que creó)
```

### Campos Doctor:
```php
- name: string (Nombre)
- first_lastname: string (Apellido paterno)
- second_lastname: string (Apellido materno)
- cmp: string (Colegio Médico del Perú)
- phone: string (Teléfono)
- distrito_id: foreign (Distrito)
- centrosalud_id: foreign (Centro de salud)
- especialidad_id: foreign (Especialidad)
- state: boolean (Activo/Inactivo)
```

---

## 🔧 **Tecnologías Utilizadas**

- **Laravel Framework** - Backend y lógica de negocio
- **FullCalendar JS** - Calendario interactivo de visitas
- **AJAX/jQuery** - Actualizaciones en tiempo real
- **Bootstrap** - Interface responsive y componentes UI
- **Select2** - Selectores avanzados con búsqueda
- **Carbon** - Manejo avanzado de fechas
- **Geolocation API** - GPS y coordenadas

---

## 📈 **Métricas y KPIs**

- **Visitas programadas vs realizadas**
- **Porcentaje de cumplimiento** por visitadora
- **Tiempo promedio** entre programación y visita
- **Doctores activos** por zona
- **Cobertura geográfica** de centros de salud

---

## 🔒 **Seguridad y Validación**

- **Middleware de roles** (visitador, admin, supervisor)
- **Validación de zona** asignada por usuario
- **Validación de fechas** y rangos permitidos
- **Validación GPS** para confirmar ubicación de visitas
- **Control de estados** y transiciones válidas

---

## 📱 **Optimización Móvil**

- **Interface responsive** para tablets y smartphones
- **GPS automático** desde dispositivos móviles
- **Formularios optimizados** para pantallas táctiles
- **Calendario táctil** con navegación intuitiva

---

## 🎨 **Códigos de Color del Sistema**

### Estados de Visita:
- **⚪ Sin Turno** - Color gris claro (#cccccc)
- **🟡 Programado** - Color amarillo (#ffc107)
- **🔴 Rechazado** - Color rojo (#dc3545)
- **🟢 Visitado** - Color verde (#28a745)
- **🟠 Reprogramado** - Color naranja (#fd7e14)
- **⚫ Eliminado** - Color gris oscuro (#6c757d)

### Turnos:
- **🌅 Mañana** - Turnos matutinos
- **🌆 Tarde** - Turnos vespertinos

---

## 📝 **Notas Técnicas**

- El **sistema de enrutamiento** se basa en zonas geográficas asignadas
- Las **listas semanales** se generan automáticamente por mes
- La **geolocalización** valida que la visita se realice en el lugar correcto
- Los **estados de visita** tienen transiciones controladas
- El **calendario** se actualiza en tiempo real con cambios de estado
