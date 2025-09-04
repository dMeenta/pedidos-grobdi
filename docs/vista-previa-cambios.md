# Vista Previa de Cambios - Pedidos Excel

## Descripción
Nueva funcionalidad que permite previsualizar los cambios antes de importar un archivo Excel de pedidos, similar al sistema de commits de GitHub.

## Características

### 🔍 Vista Previa Inteligente
- **Detección automática** de pedidos nuevos vs. modificaciones
- **Comparación campo por campo** para identificar cambios específicos
- **Interfaz visual** que muestra claramente qué se agregará o modificará

### 📊 Resumen de Cambios
- Contador de nuevos pedidos
- Contador de modificaciones
- Total de filas procesadas
- Registros sin cambios

### 🎨 Interfaz Tipo GitHub
- **Verde**: Nuevos registros completos
- **Amarillo/Naranja**: Modificaciones (solo campos cambiados)
- **Comparación lado a lado**: Valor actual vs. nuevo valor
- **Expandir/Contraer**: Vista completa de datos

### ✅ Confirmación Segura
- **SweetAlert2** para confirmaciones elegantes
- **Validación** antes de aplicar cambios
- **Cancelación** en cualquier momento
- **Limpieza automática** de archivos temporales

## Flujo de Trabajo

1. **Seleccionar Archivo**
   - Usuario selecciona archivo Excel
   - Se muestra botón "Vista Previa de Cambios"

2. **Análisis Automático**
   - Sistema lee y analiza el archivo
   - Compara con datos existentes en BD
   - Identifica nuevos registros y modificaciones

3. **Vista Previa**
   - Muestra resumen estadístico
   - Lista pedidos nuevos (verde)
   - Lista modificaciones campo por campo (amarillo)
   - Opción de ver datos completos

4. **Confirmación**
   - Usuario puede aprobar o cancelar
   - Confirmación con SweetAlert2
   - Aplicación segura de cambios

## Archivos Modificados/Creados

### Controlador
- `CargarPedidosController.php` - Nuevos métodos:
  - `preview()` - Muestra vista previa
  - `confirmChanges()` - Aplica cambios
  - `cancelChanges()` - Cancela importación
  - `analyzeChanges()` - Analiza diferencias
  - `formatRowData()` - Formatea datos del Excel
  - `compareOrderData()` - Compara registros

### Imports
- `PedidosPreviewImport.php` - Nueva clase para manejar actualizaciones

### Vistas
- `preview.blade.php` - Nueva vista de previsualización
- `create.blade.php` - Modificada para incluir botón de vista previa

### Rutas
- `cargarpedidos.preview` - GET para mostrar vista previa
- `cargarpedidos.confirm` - POST para confirmar cambios
- `cargarpedidos.cancel` - POST para cancelar

## Campos Comparados

- **Nombre del Cliente** (`customerName`)
- **Número del Cliente** (`customerNumber`)
- **Nombre del Doctor** (`doctorName`)
- **Dirección** (`address`)
- **Referencia** (`reference`)
- **Distrito** (`district`)
- **Precio** (`prize`)
- **Método de Pago** (`paymentMethod`)
- **Fecha de Entrega** (`deliveryDate`)

## Tecnologías Utilizadas

- **Laravel Excel** - Lectura de archivos
- **SweetAlert2** - Confirmaciones elegantes
- **Bootstrap 4** - Interfaz responsive
- **FontAwesome 6** - Iconografía
- **jQuery** - Interactividad

## Mejoras de UX/UI

### Visuales
- **Iconografía consistente** con FontAwesome
- **Colores semánticos** (verde=nuevo, amarillo=modificado)
- **Badges y etiquetas** para identificación rápida
- **Tablas responsivas** para datos extensos

### Interactividad
- **Loading states** durante procesamiento
- **Scroll automático** a secciones importantes
- **Expandir/Contraer** para vista detallada
- **Confirmaciones modales** para acciones críticas

### Responsividad
- **Adaptable** a diferentes tamaños de pantalla
- **Tablas horizontales** con scroll en móviles
- **Botones apropiados** para cada dispositivo

## Seguridad

- **Validación** de tipos de archivo
- **Archivos temporales** con limpieza automática
- **Permisos** de usuario mantenidos
- **Transacciones** para integridad de datos

## Instrucciones de Uso

1. Ir a **Counter > Cargar Pedidos**
2. Seleccionar archivo Excel con pedidos
3. Hacer clic en **"Vista Previa de Cambios"**
4. Revisar nuevos pedidos y modificaciones
5. Confirmar o cancelar según sea necesario

---

**Desarrollado con ❤️ para mejorar la experiencia de importación de pedidos**
