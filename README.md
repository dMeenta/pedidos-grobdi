# 🏥 GROBDI - Sistema de Gestión de Pedidos Magistrales

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-11.31-red?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)](https://php.net)
[![AdminLTE](https://img.shields.io/badge/AdminLTE-3.14-green?style=flat-square)](https://adminlte.io)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=flat-square)](LICENSE)

*Plataforma integral para la gestión de pedidos magistrales con módulos especializados para cada etapa del proceso*

</div>

---

## 📋 Tabla de Contenidos

- [🎯 Descripción General](#-descripción-general)
- [⚡ Características Principales](#-características-principales)
- [🏗️ Arquitectura del Sistema](#️-arquitectura-del-sistema)
- [🚀 Instalación y Configuración](#-instalación-y-configuración)
- [📦 Módulos del Sistema](#-módulos-del-sistema)
- [🗄️ Base de Datos](#️-base-de-datos)
- [🛣️ Rutas Principales](#️-rutas-principales)
- [🔧 Tecnologías y Dependencias](#-tecnologías-y-dependencias)
- [📊 Formatos de Importación](#-formatos-de-importación)
- [🔒 Seguridad y Roles](#-seguridad-y-roles)
- [⚙️ Comandos de Desarrollo](#️-comandos-de-desarrollo)

---

## 🎯 Descripción General

**GROBDI** es una plataforma robusta desarrollada en Laravel que gestiona de manera integral el ciclo completo de pedidos magistrales, desde la captura inicial hasta la entrega final. El sistema incluye módulos especializados para laboratorio, producción, despacho motorizado, contabilidad, gestión de rutas, muestras médicas y un completo ERP con funcionalidades de compras, inventario y control de stock.

### 🌟 Beneficios Clave
- ✅ **Trazabilidad completa** del pedido desde origen hasta entrega
- ✅ **Automatización** de procesos operativos críticos
- ✅ **Control de inventario** en tiempo real
- ✅ **Gestión de rutas** optimizada para visitadoras médicas
- ✅ **Reportería avanzada** para toma de decisiones
- ✅ **Interfaz responsive** y amigable para diferentes dispositivos

---

## ⚡ Características Principales

<div align="center">

| 🎯 **Captura de Pedidos** | 🧪 **Laboratorio** | 🏭 **Producción** | 🏍️ **Motorizado** |
|:------------------------:|:------------------:|:-----------------:|:------------------:|
| Importación Excel masiva | Control de turnos | Asignación técnicos | Gestión de entregas |
| Validación automática | Hojas de ruta | Firmas digitales | Fotos de evidencia |
| Gestión de vouchers | Estados de producción | Control de calidad | Geolocalización |

| 💰 **Contabilidad** | 🗺️ **Rutas/Visitadoras** | 🧪 **Muestras** | 📊 **ERP/Softlyn** |
|:------------------:|:-------------------------:|:----------------:|:-------------------:|
| Conciliación bancaria | Enrutamiento inteligente | Flujo de aprobación | Control de compras |
| Exportación Excel | Calendario de visitas | Estados de elaboración | Gestión de stock |
| Control de pagos | Gestión de doctores | Reportes gerenciales | Tipo de cambio |

</div>

---

## 🏗️ Arquitectura del Sistema

```
📁 pedidos-grobdi/
├── 📁 app/
│   ├── 📁 Http/Controllers/
│   │   ├── 📁 pedidos/          # Controladores de pedidos
│   │   ├── 📁 rutas/           # Gestión de rutas y visitadoras
│   │   ├── 📁 muestras/        # Módulo de muestras médicas
│   │   ├── 📁 softlyn/         # ERP y gestión de inventario
│   │   └── 📁 ajustes/         # Configuraciones del sistema
│   ├── 📁 Models/              # Modelos Eloquent
│   ├── 📁 Imports/             # Importadores Excel
│   └── 📁 Events/              # Eventos del sistema
├── 📁 resources/views/         # Vistas Blade por módulo
├── 📁 routes/                  # Definición de rutas
├── 📁 database/migrations/     # Esquemas de base de datos
└── 📁 public/                  # Assets públicos y uploads
```

### 🎨 Stack Tecnológico
- **Backend**: Laravel 11.31 + PHP 8.2+
- **Frontend**: AdminLTE 3.14 + Bootstrap 5 + Tailwind CSS
- **Base de Datos**: MySQL/MariaDB
- **Tiempo Real**: Laravel Echo + Pusher
- **Procesamiento**: Excel (Maatwebsite), Word (PhpOffice), PDF (DomPDF)

---

## 🚀 Instalación y Configuración

### 📋 Requisitos Previos
- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL/MariaDB
- Extensiones PHP: GD, BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

### ⚙️ Pasos de Instalación

```bash
# 1️⃣ Clonar el repositorio
git clone https://github.com/tu-usuario/pedidos-grobdi.git
cd pedidos-grobdi

# 2️⃣ Instalar dependencias PHP
composer install

# 3️⃣ Instalar dependencias Node.js
npm install

# 4️⃣ Configurar entorno
cp .env.example .env
php artisan key:generate

# 5️⃣ Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=grobdi
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# 6️⃣ Ejecutar migraciones
php artisan migrate

# 7️⃣ Crear enlace simbólico para storage
php artisan storage:link

# 8️⃣ Compilar assets
npm run build

# 9️⃣ Iniciar servidor de desarrollo
php artisan serve
```

### 🔧 Configuración Adicional

<details>
<summary><strong>📡 Broadcasting (Pusher)</strong></summary>

```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=tu_app_id
PUSHER_APP_KEY=tu_app_key
PUSHER_APP_SECRET=tu_app_secret
PUSHER_APP_CLUSTER=mt1
```
</details>

<details>
<summary><strong>📧 Configuración de Email</strong></summary>

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu_email
MAIL_PASSWORD=tu_contraseña
MAIL_ENCRYPTION=tls
```
</details>

---

## 📦 Módulos del Sistema

### 🎯 Counter (Captura/Asignación)
> **Rol**: `counter`, `admin`, `Administracion`

<details>
<summary><strong>📋 Funcionalidades</strong></summary>

- ✅ **Importación masiva Excel** de pedidos y detalles
- ✅ **Gestión de vouchers** con validación de imágenes
- ✅ **Sincronización automática** de doctores
- ✅ **Asignación de zonas** por distrito
- ✅ **Control de numeración** secuencial por fecha
- ✅ **Reprogramación** con recálculo automático
- ✅ **Exportación Word** para laboratorio

**Estados manejados**:
- `paymentStatus`: PENDIENTE → PAGADO
- `productionStatus`: 0 → 1
- `deliveryStatus`: Pendiente → Reprogramado → Entregado

</details>

### 🧪 Laboratorio
> **Rol**: `laboratorio`, `admin`

<details>
<summary><strong>🔬 Funcionalidades</strong></summary>

- ✅ **Vista por fecha y turno** con filtros avanzados
- ✅ **Control de estados de producción** por pedido
- ✅ **Asignación de técnicos** individual y masiva
- ✅ **Parsing inteligente** de presentaciones e ingredientes
- ✅ **Hojas de ruta** exportables a Word
- ✅ **Seguimiento detallado** por artículo

</details>

### 🏭 Producción (Técnico)
> **Rol**: `tecnico_produccion`, `admin`

<details>
<summary><strong>⚡ Funcionalidades</strong></summary>

- ✅ **Vista personalizada** por técnico asignado
- ✅ **Firma digital** para confirmación de elaboración
- ✅ **Estados de producción** en tiempo real
- ✅ **Filtros por fecha** de entrega
- ✅ **Exclusión automática** de productos no elaborables

</details>

### 🏍️ Motorizado
> **Rol**: `motorizado`, `admin`

<details>
<summary><strong>🚚 Funcionalidades</strong></summary>

- ✅ **Gestión por zonas** asignadas al motorizado
- ✅ **Estados de entrega** con seguimiento completo
- ✅ **Fotografías de evidencia** (domicilio y entrega)
- ✅ **Procesamiento automático** de imágenes
- ✅ **Notificaciones en tiempo real** via Pusher
- ✅ **Geolocalización** y timestamps automáticos

</details>

### 💰 Contabilidad
> **Rol**: `contabilidad`, `admin`

<details>
<summary><strong>📊 Funcionalidades</strong></summary>

- ✅ **Filtros por rango de fechas** y estados
- ✅ **Actualización AJAX** de estados contables
- ✅ **Gestión de bancos destino** por pedido
- ✅ **Exportación Excel** de arqueos
- ✅ **Conciliación bancaria** automática

</details>

### 🗺️ Rutas/Visitadoras
> **Rol**: `supervisor`, `visitador`, `admin`

<details>
<summary><strong>🎯 Funcionalidades</strong></summary>

**Mantenimiento**:
- ✅ Centros de Salud
- ✅ Especialidades médicas
- ✅ Base de datos de doctores
- ✅ Categorización profesional

**Enrutamiento**:
- ✅ **Creación de rutas** optimizadas
- ✅ **Asignación por distritos** automática
- ✅ **Aprobación de nuevos doctores** en el sistema
- ✅ **Calendario de visitadoras** con estados completos

</details>

### 🧪 Muestras Médicas
> **Rol**: `visitador`, `jefe-comercial`, `coordinador-lineas`, `laboratorio`, `gerencia-general`, `admin`

<details>
<summary><strong>🔄 Flujo de Trabajo</strong></summary>

1. **Visitadora** → Crea solicitud con evidencia
2. **Jefe Comercial** → Confirma la solicitud
3. **Coordinadora** → Aprueba/Rechaza, ajusta fecha/comentarios
4. **Laboratorio** → Cambia estado a Elaborado, añade comentarios
5. **Gerencia** → Accede a reportes PDF completos

**Estados**: `Pendiente` → `Confirmado` → `Aprobado` → `Elaborado`

</details>

### 📊 ERP/Softlyn
> **Rol**: `Administracion`, `admin`

<details>
<summary><strong>💼 Funcionalidades Empresariales</strong></summary>

**Gestión de Compras**:
- ✅ **Registro con proveedores** y validación de duplicados
- ✅ **Manejo multi-moneda** con tipo de cambio automático
- ✅ **Cálculo de IGV** y totales

**Guías de Ingreso**:
- ✅ **Selección de compras** via AJAX
- ✅ **Validación anti sobre-ingreso**
- ✅ **Gestión de lotes** con trazabilidad
- ✅ **Actualización automática** de stock

**Control de Inventario**:
- ✅ **Stock en tiempo real** por artículo
- ✅ **Transacciones reversibles** con integridad
- ✅ **Histórico completo** de movimientos

</details>

---

## 🗄️ Base de Datos

### 📊 Modelos Principales

<details>
<summary><strong>🎯 Pedidos</strong></summary>

```sql
-- Campos principales
- orderId (único)
- nroOrder (secuencial por fecha)
- deliveryDate, turno (0/1)
- zone_id, user_id

-- Cliente/Doctor
- customerName, customerNumber
- doctorName

-- Dirección
- address, reference, district

-- Estados
- paymentStatus (PENDIENTE/PAGADO)
- productionStatus (0/1)
- deliveryStatus (Pendiente/Reprogramado/Entregado)
- accountingStatus (0/1)

-- Evidencias
- voucher, receta
- fotoDomicilio, fotoEntrega
- fechaFoto* (timestamps)

-- Pago
- paymentMethod, operationNumber
- bancoDestino
```

**Relaciones**: `detailpedidos` (hasMany), `user` (belongsTo), `zone` (belongsTo)

</details>

<details>
<summary><strong>🧪 DetailPedidos</strong></summary>

```sql
- pedidos_id (FK)
- articulo, cantidad
- precios parciales
- estado_produccion (0/1)
- usuario_produccion_id (FK)
```

</details>

<details>
<summary><strong>💰 Sistema ERP</strong></summary>

```sql
-- Compras
Compra -> DetalleCompra (artículo, cantidad, precio, moneda/TC)

-- Inventario  
GuiaIngreso -> DetalleGuiaIngreso -> Lote -> Articulo.stock

-- Finanzas
TipoCambio (valores compra/venta, fecha) -> TipoMoneda
```

</details>

---

## 🛣️ Rutas Principales

<div align="center">

| 🎯 **Módulo** | 🔗 **Ruta Base** | 📋 **Rutas Específicas** |
|:-------------:|:----------------:|:------------------------:|
| **Counter** | `cargarpedidos.*` | `downloadWord`, `sincronizar` |
| **Laboratorio** | `pedidoslaboratorio.*` | `detalles`, `asignarTecnicoProd` |
| **Producción** | `produccion.index` | `actualizarEstado` |
| **Motorizado** | `pedidosmotorizado.*` | `cargarfotos` |
| **Contabilidad** | `pedidoscontabilidad.*` | `downloadExcel` |
| **Rutas** | `enrutamiento.*` | `rutasvisitadora.*` |
| **Muestras** | `muestras.*` | Por rol específico |
| **ERP** | `compras.*`, `guia_ingreso.*` | `tipo_cambio.*` |

</div>

---

## 🔧 Tecnologías y Dependencias

### 🐘 Backend (PHP/Composer)

<details>
<summary><strong>📦 Dependencias Principales</strong></summary>

```json
{
  "laravel/framework": "^11.31",
  "php": "^8.2",
  "jeroennoten/laravel-adminlte": "^3.14",
  "maatwebsite/excel": "^3.1",
  "phpoffice/phpword": "^1.3",
  "barryvdh/laravel-dompdf": "^3.1",
  "intervention/image-laravel": "^1.5",
  "pusher/pusher-php-server": "^7.2"
}
```

**Características**:
- 🔒 **Laravel Sanctum** para autenticación API
- 📊 **AdminLTE** como tema principal
- 📈 **Excel Import/Export** con validaciones
- 📝 **Generación Word/PDF** automática
- 🖼️ **Procesamiento de imágenes** optimizado
- ⚡ **Broadcasting en tiempo real**

</details>

### 🎨 Frontend (JavaScript/CSS)

<details>
<summary><strong>🎯 Stack Frontend</strong></summary>

```json
{
  "vite": "^6.0.11",
  "laravel-vite-plugin": "^1.2.0",
  "tailwindcss": "^3.4.13",
  "bootstrap": "^5.2.3",
  "laravel-echo": "^2.2.0",
  "pusher-js": "^8.4.0",
  "axios": "^1.7.4"
}
```

**Funcionalidades**:
- ⚡ **Vite** para compilación rápida
- 🎨 **Tailwind CSS** + **Bootstrap** hybrid
- 📡 **Laravel Echo** para tiempo real
- 📊 **Axios** para peticiones AJAX
- 📱 **Responsive Design** completo

</details>

---

## 📊 Formatos de Importación

### 📋 Pedidos Excel

<details>
<summary><strong>🎯 Estructura de Importación</strong></summary>

**Validación**: `row[2] == "PEDIDO"` y `row[16] !== "Articulo"`

| **Campo** | **Columna** | **Descripción** |
|:----------|:------------|:----------------|
| `orderId` | row[3] | Identificador único del pedido |
| `customerName` | row[4] | Nombre del cliente |
| `customerNumber` | row[5] | Número de cliente |
| `prize` | row[8] | Precio total |
| `paymentMethod` | row[10] | Método de pago |
| `deliveryDate` | row[13] | Fecha de entrega (Excel date) |
| `doctorName` | row[15] | Nombre del doctor |
| `district` | row[16] | Distrito de entrega |
| `address` | row[17] | Dirección completa |

**Estados automáticos**:
- `paymentStatus` = 'PENDIENTE'
- `deliveryStatus` = 'Pendiente'  
- `turno` = 0
- `nroOrder` = secuencial por fecha

</details>

### 📦 Detalle Pedidos Excel

<details>
<summary><strong>🧪 Estructura de Detalles</strong></summary>

| **Campo** | **Columna** | **Descripción** |
|:----------|:------------|:----------------|
| `orderId` | row[3] | Vinculación con pedido principal |
| `articulo` | row[16] | Nombre del artículo/medicamento |
| `cantidad` | row[17] | Cantidad solicitada |
| `unit_prize` | row[18] | Precio unitario |
| `sub_total` | row[19] | Subtotal calculado |

</details>

---

## 🔒 Seguridad y Roles

### 👥 Sistema de Roles

<div align="center">

| 🎭 **Rol** | 📋 **Módulos de Acceso** | 🔐 **Permisos** |
|:-----------|:-------------------------|:-----------------|
| `counter` | Captura de Pedidos | Crear, editar, sincronizar |
| `laboratorio` | Laboratorio | Ver, asignar técnicos, exportar |
| `tecnico_produccion` | Producción | Ver asignados, firmar |
| `motorizado` | Entregas | Ver zona, actualizar estado |
| `contabilidad` | Contabilidad | Conciliar, exportar |
| `supervisor` | Rutas/Mantenimiento | CRUD maestros |
| `visitador` | Rutas/Muestras | Ejecutar visitas |
| `jefe-comercial` | Muestras | Confirmar solicitudes |
| `coordinador-lineas` | Muestras | Aprobar/rechazar |
| `gerencia-general` | Reportes | Acceso completo |
| `Administracion` | ERP/Softlyn | Compras, inventario |
| `admin` | **TODOS** | Acceso total |

</div>

### 🛡️ Medidas de Seguridad

- ✅ **Middleware checkRole** por módulo
- ✅ **Validación de inputs** con Form Requests
- ✅ **Sanitización de archivos** subidos
- ✅ **Límites de tamaño** para imágenes
- ✅ **Transacciones** para integridad de datos
- ✅ **Logs de auditoría** automáticos

### 📁 Validaciones de Archivos

<details>
<summary><strong>📸 Límites por Módulo</strong></summary>

**Counter**:
- Voucher: `jpeg,png,jpg,gif|max:3048KB`
- Receta: `jpeg,png,jpg,gif,webp|max:2048KB` (múltiple)

**Motorizado**:
- Fotos: Procesadas automáticamente a 800x700px
- Formatos: JPEG optimizado con calidad 85%

**Muestras**:
- Evidencia: `jpeg,png,jpg,gif|max:2048KB`

</details>

---

## ⚙️ Comandos de Desarrollo

### 🚀 Comandos Rápidos

```bash
# 🔥 Desarrollo completo (servidor + cola + assets)
composer run dev

# 🌐 Solo servidor web
php artisan serve

# 📡 Cola de trabajos
php artisan queue:listen --tries=1

# 🎨 Assets en desarrollo (watch)
npm run dev

# 📦 Build para producción
npm run build

# 🔍 Linter de código
./vendor/bin/pint

# 🧪 Ejecutar tests
php artisan test
```

### 🛠️ Comandos de Mantenimiento

<details>
<summary><strong>⚡ Comandos Útiles</strong></summary>

```bash
# 🗄️ Base de datos
php artisan migrate --force
php artisan db:seed

# 🔗 Storage link
php artisan storage:link

# 🧹 Limpiar cache
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 📊 Generar caches de producción
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

</details>

---
