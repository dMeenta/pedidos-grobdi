# Diagrama de Flujo - Módulo Laboratorio 🧪

## Descripción General

El módulo **Laboratorio** es el responsable de la producción y elaboración de medicamentos personalizados. Gestiona la recepción de pedidos, asignación a técnicos de producción, control de calidad y preparación final de productos farmacéuticos.

## Diagrama de Flujo

```mermaid
---
title: Flujo del Módulo Laboratorio - Sistema de Producción Farmacéutica
---
flowchart TD
    %% Estilos
    classDef startEnd fill:#e1f5fe,stroke:#0277bd,stroke-width:3px,color:#000
    classDef process fill:#f3e5f5,stroke:#7b1fa2,stroke-width:2px,color:#000
    classDef decision fill:#fff3e0,stroke:#f57c00,stroke-width:2px,color:#000
    classDef input fill:#e8f5e8,stroke:#388e3c,stroke-width:2px,color:#000
    classDef output fill:#fff8e1,stroke:#fbc02d,stroke-width:2px,color:#000
    classDef storage fill:#fce4ec,stroke:#c2185b,stroke-width:2px,color:#000
    classDef production fill:#e8f5e8,stroke:#4caf50,stroke-width:3px,color:#000
    classDef quality fill:#fff3e0,stroke:#ff9800,stroke-width:2px,color:#000

    %% Inicio
    START([🔬 Laboratorio inicia sesión]):::startEnd
    
    %% Dashboard inicial
    DASHBOARD[🧪 Dashboard Laboratorio<br/>- Pedidos del día<br/>- Estado producción<br/>- Muestras pendientes]:::process
    
    %% Menú principal
    MAIN_CHOICE{🎯 ¿Qué área gestionar?}:::decision
    
    %% === RAMA 1: GESTIÓN DE PEDIDOS ===
    PEDIDOS_SECTION[📋 Gestión de Pedidos]:::process
    SEARCH_PEDIDOS[🔍 Buscar pedidos<br/>- Por fecha<br/>- Por turno<br/>- Filtros específicos]:::input
    VIEW_PEDIDOS[📊 Lista de pedidos<br/>del laboratorio]:::output
    
    PEDIDO_STATUS{📈 ¿Estado del pedido?}:::decision
    
    %% Pedidos pendientes
    PENDING_PRODUCTION[⏳ Pendiente de<br/>producción]:::process
    UPDATE_STATUS[✅ Actualizar estado<br/>a "Elaborado"]:::process
    
    %% Ver detalles del pedido
    VIEW_DETAILS[👁️ Ver detalles<br/>del pedido]:::output
    ANALYZE_FORMULA[🔍 Analizar fórmula<br/>y componentes]:::process
    
    %% === RAMA 2: ÓRDENES DE PRODUCCIÓN ===
    PRODUCTION_SECTION[🏭 Órdenes de Producción]:::production
    PRODUCTION_SEARCH[🔍 Filtrar órdenes<br/>- Por fecha<br/>- Por presentación<br/>- Por técnico]:::input
    PRODUCTION_LIST[📋 Lista de productos<br/>a elaborar]:::output
    
    ASSIGN_CHOICE{👥 ¿Cómo asignar?}:::decision
    
    %% Asignación individual
    ASSIGN_INDIVIDUAL[👤 Asignar técnico<br/>individual]:::process
    SELECT_TECH_IND[🔧 Seleccionar técnico<br/>de producción]:::input
    ASSIGN_TECH_IND[✅ Asignar orden<br/>al técnico]:::process
    
    %% Asignación múltiple
    ASSIGN_MULTIPLE[👥 Asignación múltiple]:::process
    SELECT_ORDERS[☑️ Seleccionar múltiples<br/>órdenes]:::input
    SELECT_TECH_MULT[🔧 Seleccionar técnico<br/>para todas]:::input
    ASSIGN_BATCH[✅ Asignar lote<br/>al técnico]:::process
    
    %% === RAMA 3: PRESENTACIONES FARMACÉUTICAS ===
    PRESENTATIONS_SECTION[💊 Presentaciones<br/>Farmacéuticas]:::process
    PRESENTATIONS_MENU{🧬 ¿Qué gestionar?}:::decision
    
    %% Gestión de bases
    BASES_SECTION[🧪 Gestión de Bases]:::process
    CREATE_BASE[➕ Crear nueva base]:::input
    EDIT_BASE[✏️ Editar base existente]:::process
    VIEW_BASES[📋 Ver lista de bases]:::output
    
    %% Gestión de ingredientes
    INGREDIENTS_SECTION[🥽 Gestión de<br/>Ingredientes]:::process
    SELECT_BASE[🎯 Seleccionar base<br/>para ingredientes]:::input
    CREATE_INGREDIENT[➕ Crear ingrediente]:::input
    EDIT_INGREDIENT[✏️ Editar ingrediente]:::process
    VIEW_INGREDIENTS[📋 Ver ingredientes<br/>por base]:::output
    
    %% Gestión de excipientes
    EXCIPIENTS_SECTION[⚗️ Gestión de<br/>Excipientes]:::process
    CREATE_EXCIPIENT[➕ Crear excipiente]:::input
    EDIT_EXCIPIENT[✏️ Editar excipiente]:::process
    DELETE_EXCIPIENT[🗑️ Eliminar excipiente]:::process
    
    %% === RAMA 4: GESTIÓN DE MUESTRAS ===
    SAMPLES_SECTION[🔬 Gestión de Muestras]:::quality
    SAMPLES_FILTER[🔍 Filtrar muestras<br/>- Por estado<br/>- Por fecha<br/>- Por tipo]:::input
    SAMPLES_LIST[📋 Lista de muestras<br/>pendientes]:::output
    
    SAMPLE_ACTIONS{🎯 ¿Acción en muestra?}:::decision
    
    %% Ver detalles de muestra
    VIEW_SAMPLE[👁️ Ver detalles<br/>de la muestra]:::output
    
    %% Actualizar estado
    UPDATE_SAMPLE_STATUS[📈 Actualizar estado<br/>de la muestra]:::process
    SELECT_SAMPLE_STATUS[📊 Seleccionar nuevo<br/>estado]:::input
    
    %% Actualizar fecha de entrega
    UPDATE_DELIVERY[📅 Actualizar fecha<br/>de entrega]:::process
    
    %% Añadir comentarios
    ADD_COMMENTS[💬 Añadir comentarios<br/>de laboratorio]:::process
    
    %% === RAMA 5: REPORTES Y DOCUMENTOS ===
    REPORTS_SECTION[📊 Reportes y<br/>Documentos]:::output
    
    %% Generar reporte Word
    GENERATE_WORD[📄 Generar documento<br/>Word de producción]:::output
    SELECT_DATE_TURN[📅 Seleccionar fecha<br/>y turno]:::input
    CREATE_WORD_DOC[📝 Crear documento<br/>por zonas]:::process
    DOWNLOAD_WORD[⬇️ Descargar reporte<br/>laboratorio-fecha.docx]:::output
    
    %% Exportar Excel muestras
    EXPORT_SAMPLES[📊 Exportar muestras<br/>a Excel]:::output
    GENERATE_EXCEL[📈 Generar archivo<br/>Excel con datos]:::process
    DOWNLOAD_EXCEL[⬇️ Descargar<br/>muestras_laboratorio.xlsx]:::output
    
    %% === RAMA 6: CONTROL DE CALIDAD ===
    QUALITY_SECTION[🏆 Control de Calidad]:::quality
    QC_CHECKLIST[☑️ Lista de verificación<br/>de calidad]:::input
    
    FORMULA_CHECK[🧮 Verificar fórmula<br/>y dosificación]:::process
    INGREDIENT_CHECK[🔍 Verificar<br/>ingredientes]:::process
    PRESENTATION_CHECK[💊 Verificar<br/>presentación final]:::process
    
    QC_APPROVE{✅ ¿Aprobado por QC?}:::decision
    QC_APPROVED[✅ Producto aprobado<br/>para entrega]:::process
    QC_REJECTED[❌ Producto rechazado<br/>- Revisar proceso]:::process
    
    %% === MENSAJES Y FINALIZACIONES ===
    SUCCESS_MSG[✅ Operación exitosa]:::output
    ERROR_MSG[❌ Error en proceso]:::output
    WARNING_MSG[⚠️ Advertencia]:::output
    
    %% Fin
    END([🏁 Proceso completado]):::startEnd
    
    %% === CONEXIONES PRINCIPALES ===
    START --> DASHBOARD
    DASHBOARD --> MAIN_CHOICE
    
    %% Flujo Gestión de Pedidos
    MAIN_CHOICE -->|Gestionar Pedidos| PEDIDOS_SECTION
    PEDIDOS_SECTION --> SEARCH_PEDIDOS
    SEARCH_PEDIDOS --> VIEW_PEDIDOS
    VIEW_PEDIDOS --> PEDIDO_STATUS
    
    PEDIDO_STATUS -->|Pendiente| PENDING_PRODUCTION
    PENDING_PRODUCTION --> UPDATE_STATUS
    UPDATE_STATUS --> SUCCESS_MSG
    
    PEDIDO_STATUS -->|Ver Detalles| VIEW_DETAILS
    VIEW_DETAILS --> ANALYZE_FORMULA
    ANALYZE_FORMULA --> SUCCESS_MSG
    
    %% Flujo Órdenes de Producción
    MAIN_CHOICE -->|Órdenes Producción| PRODUCTION_SECTION
    PRODUCTION_SECTION --> PRODUCTION_SEARCH
    PRODUCTION_SEARCH --> PRODUCTION_LIST
    PRODUCTION_LIST --> ASSIGN_CHOICE
    
    ASSIGN_CHOICE -->|Individual| ASSIGN_INDIVIDUAL
    ASSIGN_INDIVIDUAL --> SELECT_TECH_IND
    SELECT_TECH_IND --> ASSIGN_TECH_IND
    ASSIGN_TECH_IND --> SUCCESS_MSG
    
    ASSIGN_CHOICE -->|Múltiple| ASSIGN_MULTIPLE
    ASSIGN_MULTIPLE --> SELECT_ORDERS
    SELECT_ORDERS --> SELECT_TECH_MULT
    SELECT_TECH_MULT --> ASSIGN_BATCH
    ASSIGN_BATCH --> SUCCESS_MSG
    
    %% Flujo Presentaciones Farmacéuticas
    MAIN_CHOICE -->|Presentaciones| PRESENTATIONS_SECTION
    PRESENTATIONS_SECTION --> PRESENTATIONS_MENU
    
    PRESENTATIONS_MENU -->|Bases| BASES_SECTION
    BASES_SECTION --> CREATE_BASE
    CREATE_BASE --> SUCCESS_MSG
    BASES_SECTION --> EDIT_BASE
    EDIT_BASE --> SUCCESS_MSG
    BASES_SECTION --> VIEW_BASES
    VIEW_BASES --> END
    
    PRESENTATIONS_MENU -->|Ingredientes| INGREDIENTS_SECTION
    INGREDIENTS_SECTION --> SELECT_BASE
    SELECT_BASE --> CREATE_INGREDIENT
    CREATE_INGREDIENT --> SUCCESS_MSG
    INGREDIENTS_SECTION --> EDIT_INGREDIENT
    EDIT_INGREDIENT --> SUCCESS_MSG
    INGREDIENTS_SECTION --> VIEW_INGREDIENTS
    VIEW_INGREDIENTS --> END
    
    PRESENTATIONS_MENU -->|Excipientes| EXCIPIENTS_SECTION
    EXCIPIENTS_SECTION --> CREATE_EXCIPIENT
    CREATE_EXCIPIENT --> SUCCESS_MSG
    EXCIPIENTS_SECTION --> EDIT_EXCIPIENT
    EDIT_EXCIPIENT --> SUCCESS_MSG
    EXCIPIENTS_SECTION --> DELETE_EXCIPIENT
    DELETE_EXCIPIENT --> SUCCESS_MSG
    
    %% Flujo Gestión de Muestras
    MAIN_CHOICE -->|Muestras| SAMPLES_SECTION
    SAMPLES_SECTION --> SAMPLES_FILTER
    SAMPLES_FILTER --> SAMPLES_LIST
    SAMPLES_LIST --> SAMPLE_ACTIONS
    
    SAMPLE_ACTIONS -->|Ver Detalles| VIEW_SAMPLE
    VIEW_SAMPLE --> END
    
    SAMPLE_ACTIONS -->|Actualizar Estado| UPDATE_SAMPLE_STATUS
    UPDATE_SAMPLE_STATUS --> SELECT_SAMPLE_STATUS
    SELECT_SAMPLE_STATUS --> SUCCESS_MSG
    
    SAMPLE_ACTIONS -->|Fecha Entrega| UPDATE_DELIVERY
    UPDATE_DELIVERY --> SUCCESS_MSG
    
    SAMPLE_ACTIONS -->|Comentarios| ADD_COMMENTS
    ADD_COMMENTS --> SUCCESS_MSG
    
    %% Flujo Reportes
    MAIN_CHOICE -->|Reportes| REPORTS_SECTION
    REPORTS_SECTION --> GENERATE_WORD
    GENERATE_WORD --> SELECT_DATE_TURN
    SELECT_DATE_TURN --> CREATE_WORD_DOC
    CREATE_WORD_DOC --> DOWNLOAD_WORD
    DOWNLOAD_WORD --> SUCCESS_MSG
    
    REPORTS_SECTION --> EXPORT_SAMPLES
    EXPORT_SAMPLES --> GENERATE_EXCEL
    GENERATE_EXCEL --> DOWNLOAD_EXCEL
    DOWNLOAD_EXCEL --> SUCCESS_MSG
    
    %% Flujo Control de Calidad
    MAIN_CHOICE -->|Control Calidad| QUALITY_SECTION
    QUALITY_SECTION --> QC_CHECKLIST
    QC_CHECKLIST --> FORMULA_CHECK
    FORMULA_CHECK --> INGREDIENT_CHECK
    INGREDIENT_CHECK --> PRESENTATION_CHECK
    PRESENTATION_CHECK --> QC_APPROVE
    
    QC_APPROVE -->|Sí| QC_APPROVED
    QC_APPROVED --> SUCCESS_MSG
    
    QC_APPROVE -->|No| QC_REJECTED
    QC_REJECTED --> WARNING_MSG
    
    %% Retornos
    SUCCESS_MSG --> END
    ERROR_MSG --> DASHBOARD
    WARNING_MSG --> DASHBOARD
```

## Explicación Detallada del Flujo

### 🔬 Inicio del Proceso
1. **Login Laboratorio**: Usuario con rol `laboratorio` accede al sistema
2. **Dashboard**: Visualiza estado general de producción, pedidos pendientes y muestras

### 📋 Gestión de Pedidos
El laboratorio recibe pedidos del módulo Counter y gestiona su producción:

#### 🔍 Búsqueda y Filtrado
- **Por fecha**: Pedidos programados para fecha específica
- **Por turno**: Mañana (antes 15:00) o Tarde (después 15:00)
- **Estados**: Pendiente, En Producción, Elaborado

#### 📈 Control de Estados
- **Pendiente**: Recién recibido del Counter
- **En Producción**: Asignado a técnico
- **Elaborado**: Completado y listo para entrega

#### 🔍 Análisis de Fórmulas
- **Componentes**: Identificación automática de ingredientes
- **Dosificación**: Cálculo de cantidades según presentación
- **Bases farmacéuticas**: Asignación de base correspondiente

### 🏭 Órdenes de Producción
Gestión detallada de la producción diaria:

#### 📋 Lista de Productos
- **Filtrado**: Por fecha, presentación farmacéutica, técnico
- **Exclusiones**: Elimina bolsas delivery y productos no farmacéuticos
- **Detalles**: Información completa de cada orden

#### 👥 Asignación de Técnicos
**Asignación Individual:**
- Selección de técnico específico para una orden
- Modal de asignación con lista de técnicos disponibles
- Confirmación y notificación

**Asignación Múltiple:**
- Selección de múltiples órdenes via checkboxes
- Asignación masiva a un solo técnico
- Optimización del flujo de trabajo

### 💊 Presentaciones Farmacéuticas
Sistema de gestión de fórmulas y componentes:

#### 🧪 Gestión de Bases
- **Crear**: Nuevas bases farmacéuticas
- **Editar**: Modificar bases existentes
- **Listar**: Visualizar todas las bases disponibles

#### 🥽 Gestión de Ingredientes
- **Por base**: Ingredientes específicos para cada base
- **Componentes**: Nombre, cantidad, unidad de medida
- **Análisis automático**: Parsing de nombres de productos

#### ⚗️ Gestión de Excipientes
- **Añadir**: Nuevos excipientes a ingredientes
- **Modificar**: Actualizar propiedades
- **Eliminar**: Remover excipientes obsoletos

### 🔬 Gestión de Muestras
Control de muestras médicas y productos especiales:

#### 📊 Estados de Muestras
- **Pendiente**: Esperando procesamiento
- **En Proceso**: Siendo elaborada
- **Completada**: Lista para entrega
- **Rechazada**: No cumple estándares

#### 🔄 Actualizaciones
- **Estado**: Cambio de fase en el proceso
- **Fecha de entrega**: Reprogramación si necesario
- **Comentarios**: Notas técnicas del laboratorio

### 📊 Reportes y Documentos
Generación de documentación para otros módulos:

#### 📄 Documentos Word
- **Por zonas**: Organización geográfica
- **Por turno**: Separación mañana/tarde
- **Formato estándar**: Integración con motorizados

#### 📈 Exportación Excel
- **Muestras**: Reporte completo de muestras
- **Filtros**: Por estado, fecha, tipo
- **Headers personalizados**: Información relevante

### 🏆 Control de Calidad
Verificación antes de envío a motorizados:

#### ☑️ Lista de Verificación
- **Fórmula**: Correcta dosificación y componentes
- **Ingredientes**: Disponibilidad y calidad
- **Presentación**: Empaque y etiquetado correcto

#### ✅ Aprobación/Rechazo
- **Aprobado**: Envío a motorizado
- **Rechazado**: Retorno a producción para corrección

## Características Técnicas

### 🔒 Seguridad y Permisos
- **Roles autorizados**: `laboratorio`, `admin`
- **Técnicos de producción**: Rol específico `tecnico_produccion`
- **Validaciones**: Control de acceso por función

### 💾 Integración de Datos
- **Análisis automático**: Parsing de nombres de productos
- **Bases de datos**: Sincronización con presentaciones farmacéuticas
- **Relaciones**: Pedidos → Detalles → Ingredientes → Excipientes

### 🔄 Flujo de Estados
```
Counter → Laboratorio → Técnico Producción → Control Calidad → Motorizado
```

### ⚡ Optimizaciones
- **Asignación masiva**: Procesamiento eficiente de múltiples órdenes
- **Filtrado inteligente**: Exclusión automática de productos no farmacéuticos
- **Caché de fórmulas**: Optimización de análisis de componentes

## Indicadores de Rendimiento

### 📊 Métricas Clave
- **Órdenes por día**: Capacidad de producción
- **Tiempo promedio**: Desde asignación hasta completado
- **Tasa de aprobación**: Control de calidad efectivo
- **Distribución por técnico**: Balance de carga de trabajo

### 🎯 KPIs Importantes
- **Eficiencia de asignación**: Tiempo de asignación vs producción
- **Calidad del producto**: Tasa de aprobación en control de calidad
- **Cumplimiento de fechas**: Entrega en tiempo programado

---

*Este diagrama representa el flujo completo del módulo Laboratorio, desde la recepción de pedidos hasta la entrega de productos farmacéuticos elaborados y verificados.*
