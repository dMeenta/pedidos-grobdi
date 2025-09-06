# DetailPedidosImport - Mapeo de Columnas Corregido

## Problema Resuelto
El Excel no se estaba leyendo correctamente porque:

1. **Cabecera en fila 2:** La cabecera real está en la segunda fila, no en la primera
2. **Mapeo incorrecto:** Las columnas no estaban mapeadas a las posiciones correctas del Excel
3. **Validación incorrecta:** La validación no reconocía el formato real del archivo

## Estructura del Excel

### Cabecera (Fila 2):
```
N | Fecha | Documento | Numero | Cliente | Telef1 | Telef2 | Vence | Total | Saldo | Condicion de Pago | Estado Venta | Estado Produccion | Fecha de Entrega | Visitador | Doctor | Articulo | Cantidad | PrecioUnitario | SubTotal | Usuario | Fecha de Registro | CPE | Fecha CPE | Estado
```

### Mapeo de Columnas Corregido:

| Columna Excel | Índice | Campo | Descripción |
|---------------|--------|-------|-------------|
| D | 3 | `numero` | Número del pedido (orderId) |
| Q | 16 | `articulo` | Nombre del artículo |
| R | 17 | `cantidad` | Cantidad del artículo |
| S | 18 | `precio_unitario` | Precio unitario |
| T | 19 | `subtotal` | Subtotal (cantidad × precio) |

## Cambios Implementados

### 1. DetailPedidosImport.php
```php
protected function getDefaultColumnMapping(): array
{
    return [
        3 => 'numero',           // Columna D: Numero (orderId del pedido)
        16 => 'articulo',        // Columna Q: Articulo
        17 => 'cantidad',        // Columna R: Cantidad  
        18 => 'precio_unitario', // Columna S: PrecioUnitario
        19 => 'subtotal',        // Columna T: SubTotal
    ];
}

public function startRow(): int
{
    return 3; // Comenzar desde la fila 3 (después de la cabecera en fila 2)
}
```

### 2. Validación Mejorada
- Detecta correctamente las filas de cabecera
- Valida que existan tanto `numero` como `articulo`
- Omite filas vacías o incorrectas

### 3. Compatibilidad con Base de Datos
- Usa `pedidos_id` (no `pedido_id`)
- Usa `unit_prize` y `sub_total` como nombres correctos
- Busca duplicados usando `UPPER(TRIM())` para evitar problemas de mayúsculas/espacios

## Funcionamiento

1. **Lectura:** Comienza desde la fila 3, omitiendo las cabeceras
2. **Mapeo:** Usa las columnas correctas (D, Q, R, S, T)
3. **Validación:** Verifica que no sea fila de cabecera y que tenga datos esenciales
4. **Procesamiento:** Busca/crea los detalles de pedido usando el schema correcto
5. **Vista Previa:** Ahora mostrará correctamente los cambios detectados

## Resultado Esperado

Ahora cuando cargues el Excel:
- ✅ Reconocerá los artículos nuevos
- ✅ Detectará modificaciones en cantidad/precio
- ✅ Mostrará la vista previa con los cambios
- ✅ Funcionará correctamente con la confirmación

**El problema de "No se encontraron cambios" está resuelto.**
