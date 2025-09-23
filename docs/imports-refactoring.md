# Refactorización de Imports - Documentación

## Estructura Mejorada

### 1. **Arquitectura por Capas**
```
app/
├── Imports/              # Clases de import refactorizadas
│   ├── BaseImport.php    # Clase base abstracta
│   └── *ImportRefactored.php # Imports específicos
├── Services/Import/      # Lógica de negocio
│   ├── DoctorImportService.php
│   ├── PedidoImportService.php
│   └── DetailPedidoImportService.php
├── Traits/Import/        # Funcionalidades reutilizables
│   ├── HasImportResponse.php
│   ├── HasColumnMapping.php
│   └── HasDataValidation.php
└── config/
    └── imports.php       # Configuración centralizada
```

### 2. **Mejoras Implementadas**

#### **Separación de Responsabilidades**
- **Imports**: Solo manejan la lectura del Excel y orquestación
- **Services**: Contienen toda la lógica de negocio
- **Traits**: Funcionalidades comunes reutilizables

#### **Legibilidad del Código**
- Métodos pequeños con una sola responsabilidad
- Nombres descriptivos y autoexplicativos
- Documentación PHPDoc completa
- Eliminación de código comentado/muerto

#### **Manejo de Errores**
- Try-catch apropiados con logging
- Validación de datos antes del procesamiento
- Mensajes de error descriptivos

#### **Configuración Centralizada**
- Mapeo de columnas en archivo de configuración
- Valores por defecto configurables
- Validaciones parametrizables

### 3. **Cómo Usar las Clases Refactorizadas**

#### **Ejemplo de uso básico:**
```php
use App\Imports\DoctoresImportRefactored;

$import = new DoctoresImportRefactored();
Excel::import($import, $file);

// Obtener resultados
$message = $import->data;
$status = $import->key; // 'success', 'warning', 'danger'
```

#### **Configuración personalizada:**
```php
// En config/imports.php puedes modificar:
'column_mappings' => [
    'doctores' => [
        'default' => [
            'name' => 2,  // Cambiar columna si es necesario
            // ...
        ]
    ]
]
```

### 4. **Traits Disponibles**

#### **HasImportResponse**
- `setSuccessResponse(string $message)`
- `setWarningResponse(string $message)`
- `setErrorResponse(string $message)`

#### **HasColumnMapping**
- `detectColumns(array $rows): array`
- `shouldSkipRow(array $row, array $colMap): bool`
- `isHeaderRow(array $row, array $colMap): bool`

#### **HasDataValidation**
- `validateRequiredFields(array $row, array $required, array $colMap): bool`
- `cleanString($value): string`
- `cleanFloat($value): float`
- `parseExcelDate($excelDate): Carbon`

### 5. **Services Disponibles**

#### **DoctorImportService**
- `findOrCreateCentroSalud(string $name): CentroSalud`
- `findOrCreateEspecialidad(string $name): Especialidad`
- `normalizeDistrictName(string $name): string`
- `createDoctor(array $data): Doctor`

#### **PedidoImportService**
- `findUserByName(?string $userName): int`
- `getNextOrderNumber(string $deliveryDate): int`
- `determineProductionStatus(string $excelStatus): int`
- `createPedido(array $data): Pedidos`
- `updatePedido(Pedidos $pedido, array $newData): bool`

#### **DetailPedidoImportService**
- `findPedido(string $pedidoId): ?Pedidos`
- `findExistingDetail(int $pedidoId, string $articulo): ?DetailPedidos`
- `createDetailPedido(array $data): DetailPedidos`
- `updateDetailPedido(DetailPedidos $detail, array $newData): array`

### 6. **Migración Gradual**

1. **Probar las nuevas clases** en paralelo con las antiguas
2. **Validar resultados** comparando outputs
3. **Reemplazar gradualmente** cada import
4. **Eliminar clases antiguas** una vez validadas

### 7. **Extensibilidad**

Para crear nuevos imports:

```php
class MiNuevoImport extends BaseImport
{
    protected function getDefaultColumnMapping(): array
    {
        return [
            'campo1' => 0,
            'campo2' => 1,
            // ...
        ];
    }
    
    protected function processRow(array $row, int $index, array $colMap): void
    {
        // Tu lógica específica aquí
        $this->incrementStat('processed');
        
        try {
            // Procesar row
            $this->incrementStat('created');
        } catch (\Exception $e) {
            $this->incrementStat('errors');
        }
    }
}
```

### 8. **Beneficios Obtenidos**

- ✅ **Código más limpio** y mantenible
- ✅ **Reutilización** de componentes
- ✅ **Testeable** (separación de lógica)
- ✅ **Configuración** centralizada
- ✅ **Logging** apropiado de errores
- ✅ **Validaciones** consistentes
- ✅ **Extensibilidad** para futuras funcionalidades
