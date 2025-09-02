# 🏍️ Módulo Motorizado - Workflow del Sistema

## 📊 Descripción General

El módulo de **Motorizado** es el sistema de gestión de entregas y logística del sistema GROBDI. Se encarga de la entrega final de pedidos a los clientes, gestión de rutas por zonas, actualización de estados de entrega y documentación fotográfica del proceso de delivery.

## 🔧 Componentes Técnicos

### Controlador Principal
- **PedidosMotoController** - Gestión completa del módulo motorizado

### Modelos Utilizados
- **Pedidos** - Entidad principal con estados de entrega
- **User** - Usuario motorizado con zonas asignadas
- **Zone** - Zonas de entrega asignadas a motorizados

### Rutas y Middleware
```php
Route::resource('pedidosmotorizado', PedidosMotoController::class)
    ->middleware(['checkRole:motorizado,admin']);
Route::put('/pedidosmotorizado/fotos/{id}', [PedidosMotoController::class, 'cargarFotos'])
    ->name('pedidosmotorizado.cargarfotos')
    ->middleware(['checkRole:motorizado,admin']);
```

### Vista Principal
- **resources/views/pedidos/motorizado/pedidos/index.blade.php** - Lista de pedidos por zona
- **resources/views/pedidos/motorizado/pedidos/edit.blade.php** - Actualización de entrega

## 🎯 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| `motorizado` | ✅ Acceso completo al módulo de su zona |
| `admin` | ✅ Acceso completo a todas las zonas |

---

## 🔄 Diagrama de Flujo del Módulo Motorizado

```mermaid
flowchart TD
    %% Inicio del proceso
    A[🏠 Inicio Sesión Motorizado] --> B{🔐 Verificar Rol}
    B -->|motorizado/admin| C[🗺️ Verificar Zona Asignada]
    B -->|No autorizado| X[❌ Acceso Denegado]
    
    %% Verificación de zona
    C --> C1{¿Tiene Zona Asignada?}
    C1 -->|Sí| D[📋 Dashboard Motorizado]
    C1 -->|No| C2[⚠️ Sin Zona Asignada]
    C2 --> C3[📞 Contactar Administrador]
    
    %% Dashboard principal
    D --> E[📅 Filtros de Fecha]
    E --> F[📦 Lista Pedidos de Zona]
    
    %% Filtros y búsqueda
    E --> E1[📅 Seleccionar Fecha]
    E1 --> E2[🔍 Buscar Pedidos]
    E2 --> F
    
    %% Lista de pedidos con información
    F --> F1[🏠 Información Cliente]
    F --> F2[📍 Dirección y Referencia]
    F --> F3[⏰ Turno (Mañana/Tarde)]
    F --> F4[📊 Estado Entrega]
    F --> F5[⚙️ Acciones]
    
    %% Estados de entrega
    F4 --> F4A{Estado Actual}
    F4A -->|Pendiente| F4B[⏳ Pendiente]
    F4A -->|Reprogramado| F4C[🔄 Reprogramado]
    F4A -->|Entregado| F4D[✅ Entregado]
    
    %% Turnos y colores
    F3 --> F3A{Turno}
    F3A -->|0 (Mañana)| F3B[🌅 Mañana - Amarillo]
    F3A -->|1 (Tarde)| F3C[🌆 Tarde - Verde]
    
    %% Acciones disponibles
    F5 --> G[✏️ Actualizar Entrega]
    
    %% Formulario de actualización
    G --> G1[📝 Formulario Actualización]
    G1 --> G2[📊 Cambiar Estado Entrega]
    G1 --> G3[📝 Agregar Observaciones]
    G1 --> G4[📷 Subir Fotos]
    G1 --> G5[💾 Guardar Cambios]
    
    %% Estados disponibles
    G2 --> G2A[⏳ Pendiente]
    G2 --> G2B[🔄 Reprogramado]
    G2 --> G2C[✅ Entregado]
    
    %% Sistema de fotos
    G4 --> H[📸 Gestión Fotos]
    H --> H1[🏠 Foto Domicilio]
    H --> H2[📦 Foto Entrega]
    
    %% Foto domicilio
    H1 --> H1A[📱 Capturar con Cámara]
    H1A --> H1B[🖼️ Procesar Imagen]
    H1B --> H1C[📏 Redimensionar 800x700]
    H1C --> H1D[💾 Guardar en Storage]
    H1D --> H1E[⏰ Registrar Timestamp]
    H1E --> H1F[📸 Mostrar Imagen Guardada]
    
    %% Foto entrega
    H2 --> H2A[📱 Capturar con Cámara]
    H2A --> H2B[🖼️ Procesar Imagen]
    H2B --> H2C[📏 Redimensionar 800x700]
    H2C --> H2D[💾 Guardar en Storage]
    H2D --> H2E[⏰ Registrar Timestamp]
    H2E --> H2F[📸 Mostrar Imagen Guardada]
    
    %% Observaciones detalladas
    G3 --> G3A[📝 Campo Textarea]
    G3A --> G3B[📋 Detalles del Proceso]
    G3B --> G3C[⚠️ Incidencias]
    G3C --> G3D[📍 Observaciones de Entrega]
    
    %% Procesamiento del formulario
    G5 --> I[🔄 Procesar Actualización]
    I --> I1[✅ Validar Datos]
    I1 --> I2[💾 Actualizar Base Datos]
    I2 --> I3[📡 Disparar Evento]
    I3 --> I4[📢 Notificación Sistema]
    I4 --> I5[✅ Mensaje Éxito]
    I5 --> I6[🔙 Retornar a Lista]
    
    %% Sistema de notificaciones
    I3 --> J[📡 PedidosNotification Event]
    J --> J1[📊 Datos Evento]
    J1 --> J1A[🆔 Order ID]
    J1 --> J1B[📊 Estado Entrega]
    J1 --> J1C[📝 Detalles Motorizado]
    J1 --> J1D[👤 Nombre Usuario]
    
    %% Propagación de eventos
    J --> J2[📢 Broadcast Notification]
    J2 --> J3[👥 Notificar Counter]
    J3 --> J4[👥 Notificar Supervisores]
    J4 --> J5[📊 Actualizar Dashboard]
    
    %% Filtrado avanzado
    F --> K[🔍 Filtrado Avanzado]
    K --> K1[📊 Por Estado Entrega]
    K --> K2[⏰ Por Turno]
    K --> K3[📅 Por Fecha]
    K1 --> K4[📋 Resultados Filtrados]
    K2 --> K4
    K3 --> K4
    
    %% Gestión de errores
    I1 --> I1A{¿Datos Válidos?}
    I1A -->|Sí| I2
    I1A -->|No| I1B[❌ Errores Validación]
    I1B --> I1C[📝 Mostrar Errores]
    I1C --> G1
    
    %% Gestión de archivos
    H1D --> H1G[📁 Directorio fotoDomicilio]
    H2D --> H2G[📁 Directorio fotos_entrega]
    H1G --> H1H[🏷️ Nombre: orderID_timestamp.ext]
    H2G --> H2H[🏷️ Nombre: orderID_timestamp.ext]
    
    %% Zonas y rutas
    C --> L[🗺️ Gestión Zonas]
    L --> L1[📍 Zona Asignada]
    L1 --> L2[🔍 Filtrar Pedidos por Zona]
    L2 --> L3[📋 Solo Pedidos de Mi Zona]
    
    %% Dashboard información
    D --> M[📊 Información Dashboard]
    M --> M1[🗺️ Mostrar Zona Actual]
    M --> M2[📈 Estadísticas Entregas]
    M --> M3[⏰ Horarios Trabajo]
    
    %% Estados críticos
    F4C --> N[🚨 Pedidos Reprogramados]
    N --> N1[⚠️ Alerta Visual]
    N1 --> N2[🔴 Fondo Rojo en Tabla]
    N2 --> N3[📞 Requiere Atención]
    
    %% Estilos y colores
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57f17,stroke-width:2px,color:#000
    classDef action fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef database fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef photo fill:#e0f2f1,stroke:#00695c,stroke-width:2px,color:#000
    classDef notification fill:#fff8e1,stroke:#f9a825,stroke-width:2px,color:#000
    classDef error fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    classDef zone fill:#f1f8e9,stroke:#689f38,stroke-width:2px,color:#000
    
    class A,D startEnd
    class E,F,G,H,K,L,M process
    class B,C1,F4A,F3A,G2,I1A decision
    class G1,G5,I,J2 action
    class I2,I4 database
    class H1,H2,H1A,H1B,H1C,H1D,H2A,H2B,H2C,H2D photo
    class I3,J,J2,J3,J4,J5 notification
    class X,I1B,N error
    class C,L1,L2,L3 zone
```

---

## 📋 Funcionalidades Principales

### 1. 🗺️ **Gestión por Zonas**
- **Asignación automática** de pedidos por zona del motorizado
- **Filtrado automático** solo pedidos de la zona asignada
- **Validación de zona** al iniciar sesión
- **Múltiples zonas** por usuario motorizado

### 2. 📦 **Gestión de Entregas**
- **Estados de entrega** (Pendiente, Reprogramado, Entregado)
- **Información completa** del cliente y dirección
- **Turnos diferenciados** (Mañana/Tarde) con códigos de color
- **Números de orden** secuenciales por día

### 3. 📸 **Documentación Fotográfica**
- **Foto del domicilio** antes de la entrega
- **Foto del pedido entregado** como comprobante
- **Redimensionamiento automático** a 800x700 píxeles
- **Timestamp automático** en cada foto
- **Nombres únicos** con OrderID y timestamp

### 4. 📝 **Observaciones y Detalles**
- **Campo de observaciones** para detalles de entrega
- **Registro de incidencias** durante el proceso
- **Notas del motorizado** sobre la entrega
- **Historial completo** de cambios

### 5. 📡 **Sistema de Notificaciones**
- **Eventos automáticos** en tiempo real
- **Notificaciones a Counter** y supervisores
- **Broadcast de cambios** de estado
- **Trazabilidad completa** del proceso

### 6. 🎨 **Interfaz Optimizada**
- **Códigos de color** por turno y estado
- **Alertas visuales** para reprogramaciones
- **Interface móvil** optimizada para dispositivos
- **Filtros por fecha** y estado

---

## 🎛️ **Campos de la Base de Datos**

### Campos Motorizado en Modelo Pedidos:
```php
- deliveryStatus: string (Pendiente, Reprogramado, Entregado)
- detailMotorizado: text (Observaciones del motorizado)
- fotoDomicilio: string (URL foto del domicilio)
- fotoEntrega: string (URL foto del pedido entregado)
- fechaFotoDomicilio: timestamp (Fecha y hora foto domicilio)
- fechaFotoEntrega: timestamp (Fecha y hora foto entrega)
- turno: integer (0=Mañana, 1=Tarde)
- zone_id: foreign (Zona asignada)
- user_id: foreign (Usuario motorizado)
```

---

## 🔧 **Tecnologías Utilizadas**

- **Laravel Framework** - Backend y lógica de negocio
- **Intervention Image** - Procesamiento y redimensionamiento de imágenes
- **Laravel Events** - Sistema de notificaciones en tiempo real
- **Bootstrap** - Interface responsive y componentes UI
- **Carbon** - Manejo avanzado de fechas
- **Blade Templates** - Vistas optimizadas para móviles

---

## 📊 **Estados del Sistema**

### Estados de Entrega:
- **Pendiente** ⏳ - Pedido asignado, pendiente de entrega
- **Reprogramado** 🔄 - Entrega reprogramada por incidencia
- **Entregado** ✅ - Pedido entregado exitosamente

### Códigos de Color por Turno:
- **Mañana (0)** 🌅 - Fondo amarillo (`table-warning`)
- **Tarde (1)** 🌆 - Fondo verde (`table-success`)

### Alertas Críticas:
- **Reprogramados** 🚨 - Fondo rojo (`table-danger`)

---

## 📈 **Métricas y KPIs**

- **Entregas por día/turno**
- **Porcentaje de entregas exitosas**
- **Tiempo promedio de entrega**
- **Reprogramaciones por motorizado**
- **Cobertura fotográfica** (domicilio + entrega)

---

## 🔒 **Seguridad y Validación**

- **Middleware de roles** (motorizado, admin)
- **Validación de zona** asignada al usuario
- **Validación de imágenes** (formatos jpeg, png, jpg, gif)
- **Sanitización de archivos** y nombres únicos
- **Control de acceso** por zona geográfica

---

## 📱 **Optimización Móvil**

- **Captura directa** desde cámara del dispositivo (`capture="camera"`)
- **Interface responsive** para tablets y smartphones
- **Formularios optimizados** para pantallas táctiles
- **Carga progresiva** de imágenes

---

## 📝 **Notas Técnicas**

- Las **fotos se redimensionan automáticamente** para optimizar storage
- El **sistema de eventos** notifica cambios en tiempo real
- Los **pedidos se filtran automáticamente** por zona del usuario
- La **trazabilidad completa** incluye timestamps de todas las acciones
- **Nombres de archivos únicos** evitan conflictos en storage
