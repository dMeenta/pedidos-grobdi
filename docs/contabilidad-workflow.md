# 💰 Módulo Contabilidad - Workflow del Sistema

## 📊 Descripción General

El módulo de **Contabilidad** es el sistema de gestión financiera y revisión de pagos del sistema GROBDI. Se encarga de la verificación, conciliación y arqueo de todos los pedidos realizados, gestionando estados contables, bancos destino y generación de reportes financieros.

## 🔧 Componentes Técnicos

### Controlador Principal
- **PedidosContaController** - Gestión completa del módulo contabilidad

### Modelos Utilizados
- **Pedidos** - Entidad principal con campos contables
- **Exports/PedidoscontabilidadExport** - Exportación de reportes Excel

### Rutas y Middleware
```php
Route::resource('pedidoscontabilidad', PedidosContaController::class)
    ->middleware(['checkRole:contabilidad,admin']);
Route::get('/pedidoscontabilidad/downloadExcel/{fechainicio}/{fechafin}', 
    PedidosContaController::class .'@downloadExcel')
    ->name('pedidoscontabilidad.downloadExcel')
    ->middleware(['checkRole:contabilidad,admin']);
```

### Vista Principal
- **resources/views/pedidos/contabilidad/index.blade.php** - Dashboard principal

## 🎯 Roles y Permisos

| Rol | Permisos |
|-----|----------|
| `contabilidad` | ✅ Acceso completo al módulo |
| `admin` | ✅ Acceso completo al módulo |

---

## 🔄 Diagrama de Flujo del Módulo Contabilidad

```mermaid
flowchart TD
    %% Inicio del proceso
    A[🏠 Inicio Sesión Contabilidad] --> B{🔐 Verificar Rol}
    B -->|contabilidad/admin| C[📊 Dashboard Contabilidad]
    B -->|No autorizado| X[❌ Acceso Denegado]
    
    %% Dashboard principal
    C --> D[📅 Filtros de Búsqueda]
    D --> E[📋 Lista de Pedidos]
    
    %% Filtros y búsqueda
    D --> D1[📅 Fecha Inicio]
    D --> D2[📅 Fecha Fin]
    D1 --> D3[🔍 Buscar Pedidos]
    D2 --> D3
    D3 --> E
    
    %% Lista de pedidos con estados
    E --> E1[👤 Cliente]
    E --> E2[💳 Estado Pago]
    E --> E3[📊 Estado Contabilidad]
    E --> E4[🧾 Voucher]
    E --> E5[⚙️ Acciones]
    
    %% Estados contables
    E3 --> E3A{Estado Actual}
    E3A -->|0| E3B[❌ Sin Revisar]
    E3A -->|1| E3C[✅ Revisado]
    
    %% Estados voucher
    E4 --> E4A{Voucher Status}
    E4A -->|Sin imagen| E4B[🔴 Sin Imagen]
    E4A -->|Con imagen| E4C[🟢 Con Imagen]
    
    %% Acciones disponibles
    E5 --> F[👁️ Ver Detalles]
    E5 --> G[✏️ Editar Estado]
    
    %% Modal de detalles del pedido
    F --> F1[📋 Modal Pedido]
    F1 --> F2[📝 Información Básica]
    F1 --> F3[💳 Datos de Pago]
    F1 --> F4[🧾 Vouchers y Operaciones]
    F1 --> F5[📊 Estado Contable]
    
    %% Información básica
    F2 --> F2A[🆔 Order ID]
    F2 --> F2B[👤 Nombre Cliente]
    F2 --> F2C[📅 Fecha Entrega]
    F2 --> F2D[📞 Teléfono]
    F2 --> F2E[📍 Dirección]
    
    %% Datos de pago
    F3 --> F3A[💰 Estado de Pago]
    F3 --> F3B[💳 Método de Pago]
    F3 --> F3C[💵 Monto Total]
    
    %% Vouchers y operaciones
    F4 --> F4A{¿Tiene Voucher?}
    F4A -->|Sí| F4B[🖼️ Mostrar Imágenes]
    F4A -->|No| F4C[⚠️ Sin Voucher]
    F4B --> F4D[🔢 Nro Operación]
    F4B --> F4E[🏦 Imagen Voucher]
    
    %% Edición de estado contable
    G --> G1[📝 Modal Edición]
    G1 --> G2[📊 Selector Estado]
    G1 --> G3[🏦 Banco Destino]
    G1 --> G4[💾 Guardar Cambios]
    
    %% Estados disponibles
    G2 --> G2A[❌ Sin Revisar]
    G2 --> G2B[✅ Revisado]
    
    %% Actualización AJAX
    G4 --> H[🔄 Actualización AJAX]
    H --> H1[📤 Enviar Datos]
    H1 --> H2[🔍 Validar en Servidor]
    H2 --> H3[💾 Actualizar BD]
    H3 --> H4[📥 Respuesta JSON]
    H4 --> H5[🔄 Actualizar Vista]
    H5 --> H6[✅ Mensaje Éxito]
    
    %% Exportación de reportes
    C --> I[📊 Exportar Reportes]
    I --> I1[📅 Seleccionar Rango]
    I1 --> I2[📋 Generar Excel]
    I2 --> I3[📁 Descarga Archivo]
    
    %% Contenido del reporte
    I2 --> I2A[🆔 ID Orden]
    I2 --> I2B[👤 Cliente]
    I2 --> I2C[📅 Fecha Registro]
    I2 --> I2D[💳 Método Pago]
    I2 --> I2E[🔢 Nro Operación]
    I2 --> I2F[🏦 Banco Destino]
    I2 --> I2G[🧾 Estado Voucher]
    I2 --> I2H[💰 Total]
    I2 --> I2I[📊 Estado Contabilidad]
    
    %% Conciliación bancaria
    C --> J[🏦 Conciliación Bancaria]
    J --> J1[📊 Revisar Estados]
    J1 --> J2[🔄 Actualizar Masivo]
    J2 --> J3[📋 Generar Arqueo]
    
    %% Flujo de validación
    H2 --> H2A{¿Datos Válidos?}
    H2A -->|Sí| H3
    H2A -->|No| H2B[❌ Error Validación]
    H2B --> H2C[📝 Mostrar Errores]
    
    %% Notificaciones y alertas
    H6 --> K[📢 Sistema Notificaciones]
    K --> K1[✅ Éxito]
    K --> K2[⚠️ Advertencia]
    K --> K3[❌ Error]
    
    %% Estilos y colores
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:2px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57f17,stroke-width:2px,color:#000
    classDef action fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef database fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef export fill:#e0f2f1,stroke:#00695c,stroke-width:2px,color:#000
    classDef ajax fill:#fff8e1,stroke:#f9a825,stroke-width:2px,color:#000
    classDef error fill:#ffebee,stroke:#d32f2f,stroke-width:2px,color:#000
    
    class A,C startEnd
    class D,E,F,G,I,J process
    class B,E3A,E4A,F4A,G2,H2A decision
    class F1,G1,G4,H,I2,J3 action
    class H3,H4 database
    class I3,I2A,I2B,I2C,I2D,I2E,I2F,I2G,I2H,I2I export
    class H1,H5 ajax
    class X,H2B,K3 error
```

---

## 📋 Funcionalidades Principales

### 1. 🔍 **Filtrado y Búsqueda**
- **Filtros por rango de fechas** para búsquedas específicas
- **Validación de fechas** con fecha fin posterior a fecha inicio
- **Búsqueda automática** por período seleccionado

### 2. 📊 **Gestión de Estados Contables**
- **Estado Sin Revisar (0)** - Pedidos pendientes de verificación
- **Estado Revisado (1)** - Pedidos verificados y validados
- **Actualización AJAX** en tiempo real sin recarga de página

### 3. 🏦 **Gestión Bancaria**
- **Banco Destino** configurable por pedido
- **Número de Operación** asociado a vouchers
- **Conciliación bancaria** automática

### 4. 🧾 **Gestión de Vouchers**
- **Visualización de vouchers** cargados
- **Estado de voucher** (Con imagen/Sin imagen)
- **Múltiples vouchers** por pedido con números de operación

### 5. 📊 **Reportes y Exportación**
- **Exportación Excel** con todos los datos contables
- **Arqueos por período** específico
- **Reportes personalizables** por rango de fechas

### 6. 🔄 **Actualización en Tiempo Real**
- **AJAX Integration** para actualizaciones sin recarga
- **Validación en tiempo real** de cambios
- **Notificaciones instantáneas** de éxito/error

---

## 🎛️ **Campos de la Base de Datos**

### Campos Contables en Modelo Pedidos:
```php
- accountingStatus: integer (0=Sin revisar, 1=Revisado)
- bancoDestino: string (Banco destino del pago)
- voucher: string (URLs de imágenes separadas por comas)
- operationNumber: string (Números de operación separados por comas)
- paymentStatus: string (Estado del pago)
- paymentMethod: string (Método de pago utilizado)
- prize: decimal (Monto total del pedido)
```

---

## 🔧 **Tecnologías Utilizadas**

- **Laravel Framework** - Backend y lógica de negocio
- **AJAX/jQuery** - Actualizaciones en tiempo real
- **Bootstrap** - Interfacing y componentes UI
- **Maatwebsite Excel** - Exportación de reportes
- **Carbon** - Manejo de fechas
- **Blade Templates** - Vistas y componentes

---

## 📈 **Métricas y KPIs**

- **Pedidos Revisados vs Pendientes**
- **Tiempo promedio de revisión contable**
- **Porcentaje de vouchers cargados**
- **Conciliación bancaria por período**
- **Arqueos diarios/mensuales**

---

## 🔒 **Seguridad y Validación**

- **Middleware de roles** (contabilidad, admin)
- **Validación CSRF** en formularios
- **Validación de fechas** en filtros
- **Sanitización de datos** en actualizaciones AJAX
- **Control de acceso** por rutas protegidas

---

## 📝 **Notas Técnicas**

- Las actualizaciones de estado se realizan via **AJAX** para mejor UX
- Los **vouchers múltiples** se manejan mediante arrays separados por comas
- La **exportación Excel** incluye formateo automático de fechas
- El sistema mantiene **trazabilidad completa** de cambios contables
