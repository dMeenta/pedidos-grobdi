<?php

use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use App\Models\Pedidos;

Route::get('/test-doctores', function () {
    $doctores = Doctor::where('state', 1)->with(['especialidad', 'centrosalud'])->limit(10)->get();
    
    $html = '<h2>Doctores de Prueba</h2>';
    $html .= '<p>Total doctores activos: ' . Doctor::where('state', 1)->count() . '</p>';
    $html .= '<table border="1" style="border-collapse: collapse; width: 100%;">';
    $html .= '<tr style="background-color: #f0f0f0;">';
    $html .= '<th>ID</th><th>Nombre</th><th>Name Softlynn</th><th>CMP</th><th>Especialidad</th><th>Centro Salud</th>';
    $html .= '</tr>';
    
    foreach ($doctores as $doctor) {
        $html .= '<tr>';
        $html .= '<td>' . $doctor->id . '</td>';
        $html .= '<td>' . $doctor->name . ' ' . $doctor->first_lastname . '</td>';
        $html .= '<td>' . ($doctor->name_softlynn ?: 'N/A') . '</td>';
        $html .= '<td>' . $doctor->CMP . '</td>';
        $html .= '<td>' . ($doctor->especialidad->name ?? 'N/A') . '</td>';
        $html .= '<td>' . ($doctor->centrosalud->name ?? 'N/A') . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    // Probar la API de búsqueda
    $html .= '<br><h3>Test API Búsqueda (buscando "Carlos"):</h3>';
    $searchResult = Doctor::where('state', 1)
        ->where(function($query) {
            $query->where('name', 'LIKE', '%Carlos%')
                  ->orWhere('name_softlynn', 'LIKE', '%Carlos%');
        })
        ->orderBy('name')
        ->limit(5)
        ->get(['id', 'name', 'name_softlynn']);
        
    $html .= '<ul>';
    foreach ($searchResult as $doctor) {
        $displayName = $doctor->name_softlynn ?: $doctor->name;
        $html .= '<li>ID: ' . $doctor->id . ' - ' . $displayName . '</li>';
    }
    $html .= '</ul>';
    
    return $html;
});
