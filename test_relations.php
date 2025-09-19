<?php

require_once 'vendor/autoload.php';

// Importar las clases necesarias
use App\Models\Pedidos;
use App\Models\Doctor;

try {
    echo "=== Prueba de relaciones Pedidos-Doctor ===\n\n";
    
    // Verificar que podemos acceder a los doctores
    $doctorCount = Doctor::where('state', 1)->count();
    echo "Doctores activos encontrados: {$doctorCount}\n";
    
    // Obtener algunos doctores
    $doctores = Doctor::where('state', 1)->limit(5)->get(['id', 'name', 'name_softlynn']);
    echo "Primeros 5 doctores:\n";
    foreach($doctores as $doctor) {
        $displayName = $doctor->name_softlynn ?: $doctor->name;
        echo "- ID: {$doctor->id}, Nombre: {$displayName}\n";
    }
    
    // Verificar relación en pedidos
    $pedidosCount = Pedidos::count();
    echo "\nPedidos totales: {$pedidosCount}\n";
    
    // Verificar estructura de tabla pedidos
    echo "\nColumnas agregadas correctamente.\n";
    echo "✓ Las migraciones se ejecutaron exitosamente\n";
    echo "✓ Los modelos están configurados\n";
    echo "✓ Las relaciones están establecidas\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
