# Diagrama de Flujo - Módulo Counter 📊

## Descripción General

El módulo **Counter** es el encargado de gestionar la carga, procesamiento y asignación de pedidos en el sistema. Es el punto central donde se importan los datos de pedidos desde archivos Excel y se preparan para su distribución a otros módulos.

## Diagrama de Flujo

```mermaid
---
title: Flujo del Módulo Counter - Sistema de Pedidos
---
flowchart TD
    %% Estilos
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:3px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57c00,stroke-width:2px,color:#000
    classDef input fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef output fill:#fff8e1,stroke:#fbc02d,stroke-width:2px,color:#000
    classDef storage fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef user fill:#e3f2fd,stroke:#1976d2,stroke-width:2px,color:#000

    %% Inicio
    START([🚀 Counter inicia sesión]):::startEnd
    
    %% Dashboard inicial
    DASHBOARD[📋 Visualiza Dashboard<br/>- Pedidos del día<br/>- Opciones disponibles]:::process
    
    %% Decisiones principales
    MAIN_CHOICE{🤔 ¿Qué desea hacer?}:::decision
    
    %% Rama 1: Cargar Pedidos
    LOAD_SECTION[📤 Cargar Pedidos]:::input
    LOAD_CHOICE{📁 ¿Qué tipo de archivo?}:::decision
    
    %% Cargar pedidos con direcciones
    UPLOAD_ADDRESSES[📋 Cargar Excel con<br/>Direcciones]:::input
    PROCESS_ADDRESSES[⚙️ Procesar archivo<br/>PedidosImport]:::process
    VALIDATE_ADDRESSES{✅ ¿Datos válidos?}:::decision
    SAVE_ADDRESSES[💾 Guardar pedidos<br/>en BD]:::storage
    
    %% Cargar artículos
    UPLOAD_ARTICLES[📦 Cargar Excel con<br/>Artículos]:::input
    PROCESS_ARTICLES[⚙️ Procesar archivo<br/>DetailPedidosImport]:::process
    VALIDATE_ARTICLES{✅ ¿Datos válidos?}:::decision
    SAVE_ARTICLES[💾 Guardar detalles<br/>en BD]:::storage
    
    %% Sincronizar doctores
    SYNC_DOCTORS[👨‍⚕️ Sincronizar Doctores<br/>con Pedidos]:::process
    
    %% Rama 2: Gestionar Pedidos Existentes
    MANAGE_SECTION[📊 Gestionar Pedidos]:::process
    
    %% Buscar pedidos
    SEARCH_FORM[🔍 Formulario de búsqueda<br/>- Por fecha<br/>- Filtro entrega/registro]:::input
    SEARCH_RESULTS[📋 Lista de pedidos<br/>filtrados]:::output
    
    %% Acciones sobre pedidos
    PEDIDO_ACTIONS{🎯 ¿Qué hacer con<br/>el pedido?}:::decision
    
    %% Editar pedido
    EDIT_PEDIDO[✏️ Editar información<br/>del pedido]:::process
    UPDATE_INFO[📝 Actualizar:<br/>- Cliente<br/>- Dirección<br/>- Doctor<br/>- Precio<br/>- Zona]:::process
    
    %% Gestionar pagos
    MANAGE_PAYMENT[💳 Gestionar Pago]:::process
    UPLOAD_VOUCHER[📸 Subir imagen<br/>de voucher]:::input
    ADD_OPERATION[🔢 Añadir número<br/>de operación]:::input
    SAVE_PAYMENT[💾 Guardar información<br/>de pago]:::storage
    
    %% Gestionar recetas
    MANAGE_RECIPE[📋 Gestionar Receta]:::process
    UPLOAD_RECIPE[📸 Subir imagen<br/>de receta]:::input
    SAVE_RECIPE[💾 Guardar receta<br/>en BD]:::storage
    
    %% Actualizar turno
    UPDATE_SHIFT[🕐 Actualizar Turno<br/>Mañana/Tarde]:::process
    
    %% Rama 3: Asignar Pedidos
    ASSIGN_SECTION[🎯 Asignar Pedidos]:::process
    ASSIGN_SEARCH[🔍 Buscar pedidos<br/>por fecha]:::input
    ASSIGN_LIST[📋 Lista de pedidos<br/>sin asignar]:::output
    SELECT_ZONE[🗺️ Seleccionar zona<br/>para pedido]:::input
    ASSIGN_ZONE[✅ Asignar zona<br/>al pedido]:::process
    
    %% Rama 4: Generar Reportes
    REPORTS_SECTION[📊 Generar Reportes]:::output
    SELECT_REPORT_DATE[📅 Seleccionar fecha<br/>y turno]:::input
    GENERATE_WORD[📄 Generar documento<br/>Word por zonas]:::output
    DOWNLOAD_REPORT[⬇️ Descargar reporte<br/>pedidos-fecha.docx]:::output
    
    %% Rama 5: Historial
    HISTORY_SECTION[📚 Ver Historial]:::output
    HISTORY_SEARCH[🔍 Buscar por rango<br/>de fechas]:::input
    HISTORY_RESULTS[📋 Mostrar historial<br/>de pedidos]:::output
    HISTORY_ACTIONS{🎯 ¿Acción en<br/>historial?}:::decision
    VIEW_DETAILS[👁️ Ver detalles<br/>del pedido]:::output
    EDIT_HISTORY[✏️ Editar pedido<br/>histórico]:::process
    DELETE_HISTORY[🗑️ Eliminar pedido]:::process
    
    %% Mensajes de error/éxito
    ERROR_MSG[❌ Mostrar mensaje<br/>de error]:::output
    SUCCESS_MSG[✅ Mostrar mensaje<br/>de éxito]:::output
    
    %% Fin
    END([🏁 Operación completada]):::startEnd
    
    %% Conexiones principales
    START --> DASHBOARD
    DASHBOARD --> MAIN_CHOICE
    
    %% Flujo Cargar Pedidos
    MAIN_CHOICE -->|Cargar Pedidos| LOAD_SECTION
    LOAD_SECTION --> LOAD_CHOICE
    
    LOAD_CHOICE -->|Excel Direcciones| UPLOAD_ADDRESSES
    UPLOAD_ADDRESSES --> PROCESS_ADDRESSES
    PROCESS_ADDRESSES --> VALIDATE_ADDRESSES
    VALIDATE_ADDRESSES -->|Válido| SAVE_ADDRESSES
    VALIDATE_ADDRESSES -->|Error| ERROR_MSG
    SAVE_ADDRESSES --> SYNC_DOCTORS
    SYNC_DOCTORS --> SUCCESS_MSG
    
    LOAD_CHOICE -->|Excel Artículos| UPLOAD_ARTICLES
    UPLOAD_ARTICLES --> PROCESS_ARTICLES
    PROCESS_ARTICLES --> VALIDATE_ARTICLES
    VALIDATE_ARTICLES -->|Válido| SAVE_ARTICLES
    VALIDATE_ARTICLES -->|Error| ERROR_MSG
    SAVE_ARTICLES --> SUCCESS_MSG
    
    %% Flujo Gestionar Pedidos
    MAIN_CHOICE -->|Gestionar Pedidos| MANAGE_SECTION
    MANAGE_SECTION --> SEARCH_FORM
    SEARCH_FORM --> SEARCH_RESULTS
    SEARCH_RESULTS --> PEDIDO_ACTIONS
    
    PEDIDO_ACTIONS -->|Editar Info| EDIT_PEDIDO
    EDIT_PEDIDO --> UPDATE_INFO
    UPDATE_INFO --> SUCCESS_MSG
    
    PEDIDO_ACTIONS -->|Gestionar Pago| MANAGE_PAYMENT
    MANAGE_PAYMENT --> UPLOAD_VOUCHER
    UPLOAD_VOUCHER --> ADD_OPERATION
    ADD_OPERATION --> SAVE_PAYMENT
    SAVE_PAYMENT --> SUCCESS_MSG
    
    PEDIDO_ACTIONS -->|Añadir Receta| MANAGE_RECIPE
    MANAGE_RECIPE --> UPLOAD_RECIPE
    UPLOAD_RECIPE --> SAVE_RECIPE
    SAVE_RECIPE --> SUCCESS_MSG
    
    PEDIDO_ACTIONS -->|Cambiar Turno| UPDATE_SHIFT
    UPDATE_SHIFT --> SUCCESS_MSG
    
    %% Flujo Asignar Pedidos
    MAIN_CHOICE -->|Asignar Pedidos| ASSIGN_SECTION
    ASSIGN_SECTION --> ASSIGN_SEARCH
    ASSIGN_SEARCH --> ASSIGN_LIST
    ASSIGN_LIST --> SELECT_ZONE
    SELECT_ZONE --> ASSIGN_ZONE
    ASSIGN_ZONE --> SUCCESS_MSG
    
    %% Flujo Reportes
    MAIN_CHOICE -->|Generar Reportes| REPORTS_SECTION
    REPORTS_SECTION --> SELECT_REPORT_DATE
    SELECT_REPORT_DATE --> GENERATE_WORD
    GENERATE_WORD --> DOWNLOAD_REPORT
    DOWNLOAD_REPORT --> SUCCESS_MSG
    
    %% Flujo Historial
    MAIN_CHOICE -->|Ver Historial| HISTORY_SECTION
    HISTORY_SECTION --> HISTORY_SEARCH
    HISTORY_SEARCH --> HISTORY_RESULTS
    HISTORY_RESULTS --> HISTORY_ACTIONS
    
    HISTORY_ACTIONS -->|Ver Detalles| VIEW_DETAILS
    VIEW_DETAILS --> END
    
    HISTORY_ACTIONS -->|Editar| EDIT_HISTORY
    EDIT_HISTORY --> SUCCESS_MSG
    
    HISTORY_ACTIONS -->|Eliminar| DELETE_HISTORY
    DELETE_HISTORY --> SUCCESS_MSG
    
    %% Retornos
    SUCCESS_MSG --> END
    ERROR_MSG --> DASHBOARD
```

## Explicación Detallada del Flujo

### 🔐 Inicio del Proceso
1. **Login Counter**: El usuario con rol `counter` inicia sesión en el sistema
2. **Dashboard**: Visualiza el panel principal con las opciones disponibles

### 📤 Carga de Pedidos
El Counter puede cargar dos tipos de archivos Excel:

#### 📋 Excel con Direcciones
- **Archivo**: Contiene información básica de pedidos (cliente, dirección, doctor, etc.)
- **Procesamiento**: Utiliza `PedidosImport` para procesar el archivo
- **Validación**: Verifica que los datos sean correctos y completos
- **Almacenamiento**: Guarda los pedidos en la base de datos
- **Sincronización**: Automáticamente sincroniza con la base de datos de doctores

#### 📦 Excel con Artículos  
- **Archivo**: Contiene los detalles de productos/medicamentos de cada pedido
- **Procesamiento**: Utiliza `DetailPedidosImport` para procesar
- **Validación**: Verifica artículos y cantidades
- **Almacenamiento**: Guarda los detalles en la tabla `detail_pedidos`

### 📊 Gestión de Pedidos Existentes
Una vez cargados, el Counter puede:

#### 🔍 Búsqueda y Filtrado
- **Por fecha**: Fecha de entrega o fecha de registro
- **Filtros**: Diversos criterios de búsqueda
- **Resultados**: Lista paginada de pedidos

#### ✏️ Edición de Pedidos
- **Información básica**: Cliente, dirección, doctor, precio
- **Zona de entrega**: Asignación a zona específica
- **Fecha de entrega**: Reprogramación si es necesario

#### 💳 Gestión de Pagos
- **Vouchers**: Subida de imágenes de comprobantes
- **Números de operación**: Registro de transacciones
- **Múltiples pagos**: Soporte para varios vouchers por pedido

#### 📋 Gestión de Recetas
- **Imágenes**: Subida de fotos de recetas médicas
- **Almacenamiento**: Guardado seguro en el servidor

#### 🕐 Gestión de Turnos
- **Turnos**: Mañana (antes 15:00) o Tarde (después 15:00)
- **Cambios**: Actualización manual de turnos

### 🎯 Asignación de Zonas
- **Búsqueda**: Pedidos por fecha específica
- **Asignación**: Selección de zona de entrega para cada pedido
- **Automatización**: El sistema puede sugerir zonas basadas en distritos

### 📊 Generación de Reportes
- **Formato Word**: Documentos organizados por zona
- **Filtrado**: Por fecha y turno (mañana/tarde)
- **Contenido**: Lista completa de pedidos con detalles
- **Descarga**: Archivo `pedidos-fecha.docx`

### 📚 Historial de Pedidos
- **Consulta**: Búsqueda por rangos de fecha
- **Visualización**: Detalles completos de pedidos históricos
- **Edición**: Modificación de pedidos anteriores (según permisos)
- **Eliminación**: Borrado de pedidos (solo jefe de operaciones)

## Características Técnicas

### 🔒 Seguridad y Permisos
- **Roles autorizados**: `counter`, `admin`, `Administracion`
- **Middleware**: Verificación de roles en cada ruta
- **Validaciones**: Sanitización de datos de entrada

### 💾 Almacenamiento
- **Base de datos**: MySQL/MariaDB
- **Archivos**: Vouchers y recetas en carpetas organizadas
- **Respaldos**: Sistema de versionado de imágenes

### 🔄 Integración
- **Doctores**: Sincronización automática con base de datos médica
- **Zonas**: Asignación automática basada en distritos
- **Motorizados**: Preparación de datos para entrega

### ⚡ Optimizaciones
- **Carga masiva**: Procesamiento eficiente de archivos Excel
- **Paginación**: Manejo de grandes volúmenes de datos
- **Caché**: Optimización de consultas frecuentes

## Estados de Pedidos

### 📈 Flujo de Estados
1. **Nuevo**: Recién importado del Excel
2. **Procesado**: Información completada y validada
3. **Asignado**: Zona de entrega definida
4. **En Producción**: Enviado a laboratorio
5. **Listo**: Preparado para entrega
6. **En Ruta**: Asignado a motorizado
7. **Entregado**: Completado exitosamente

### 🔄 Transiciones Permitidas
- Counter puede mover pedidos entre estados: Nuevo → Procesado → Asignado
- Cambios posteriores requieren coordinación con otros módulos

## Reportes y Analytics

### 📊 Métricas Importantes
- **Volumen diario**: Cantidad de pedidos procesados
- **Distribución por zonas**: Análisis geográfico
- **Tiempos de procesamiento**: Eficiencia operativa
- **Errores de importación**: Control de calidad

### 📈 Indicadores de Rendimiento
- **Tiempo promedio de carga**: Medición de eficiencia
- **Tasa de errores**: Calidad de datos importados
- **Pedidos por hora**: Capacidad de procesamiento

---

*Este diagrama representa el flujo completo del módulo Counter, desde la carga inicial de datos hasta la preparación final para otros módulos del sistema.*
