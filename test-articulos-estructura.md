# Prueba de Nueva Estructura de Artículos

## Estructura Actualizada

El sistema ahora maneja la nueva estructura de columnas para artículos:

### Columnas Excel:
- **Columna 0**: Numero (pedido_id)
- **Columna 1**: Articulo 
- **Columna 2**: Cantidad
- **Columna 3**: PrecioUnitario (con 3 decimales)
- **Columna 4**: SubTotal (con 3 decimales)

### Cambios Implementados:

**PROBLEMA RESUELTO**: El sistema no detectaba cambios en artículos correctamente.

**SOLUCIÓN**: Mejorada la lógica de comparación para detectar cambios con mayor precisión.

1. **CargarPedidosController.php**:
   - `analyzeArticulosChanges()`: Actualizado para usar la nueva estructura de columnas
   - `formatArticleRowData()`: Acepta parámetros adicionales para manejar ambas estructuras
   - `compareArticleData()`: **MEJORADO** - Comparaciones más robustas:
     * Usa comparación epsilon para decimales: `abs($existing - $new) >= 0.001`
     * Normaliza cantidad usando `floatval()` para evitar problemas de tipo
     * Maneja 3 decimales de precisión correctamente
     * Elimina comparaciones estrictas que causaban falsos negativos

2. **DetailPedidosPreviewImport.php**:
   - Detección automática de estructura nueva vs. antigua
   - Manejo de 3 decimales de precisión
   - Compatibilidad hacia atrás con estructura anterior

**CORRECCIONES CRÍTICAS**:
- ✅ Reemplazado `===` con comparación epsilon para decimales
- ✅ Uso de `floatval()` en comparación de cantidades
- ✅ Normalización de precisión decimal antes de comparar
- ✅ Corrección de variable `$existingSubTotal` en comparaciones

### Ejemplo de datos Excel nuevos:
```
1001 | PRODUCTO A | 5 | 12.345 | 61.725
1002 | PRODUCTO B | 3 | 8.999 | 26.997
```

### Precisión Decimal:
- Todos los precios se manejan con `round(floatval($value), 3)`
- Comparaciones usan `round()` para evitar diferencias de punto flotante
- Formato de salida: `number_format($value, 3, '.', '')`

## Próximas Pruebas:
1. Subir archivo Excel con nueva estructura
2. Verificar preview con cambios detectados
3. Confirmar importación con 3 decimales
4. Validar timestamp `last_data_update`
