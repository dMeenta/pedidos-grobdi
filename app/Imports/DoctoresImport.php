<?php

namespace App\Imports;

use App\Imports\BaseImport;
use App\Models\Doctor;
use App\Services\Import\DoctorImportService;

class DoctoresImport extends BaseImport
{
    protected DoctorImportService $doctorService;
    
    /**
     * Constructor de la clase DoctoresImport
     * 
     * Inicializa la instancia del servicio DoctorImportService
     * que se utilizará para manejar la lógica de negocio de los doctores.
     */
    public function __construct()
    {
        $this->doctorService = new DoctorImportService();
    }
    
    /**
     * Obtiene el mapeo de columnas por defecto para importación de doctores
     * 
     * Este método define el mapeo estándar de columnas para archivos Excel
     * que contienen información de doctores, incluyendo campos como nombre,
     * CMP, teléfonos, especialidad, centro de salud, distrito, etc.
     * 
     * @return array Mapeo de columnas con índices y nombres de campos
     */
    protected function getDefaultColumnMapping(): array
    {
        return [
            0 => 'estado',
            1 => 'name_prefix',
            2 => 'name',
            3 => 'CMP',
            4 => 'phone',
            5 => 'telefono2',
            6 => 'telefono3',
            7 => 'name_secretariat',
            8 => 'observations',
            9 => 'especialidad',
            10 => 'asignado_visitadora',
            11 => 'distrito_direccion',
            12 => 'centrosalud',
            13 => 'numero_consultorio',
            14 => 'horario_atencion',
            15 => 'categoria_medico',
            16 => 'tipo_medico',
            17 => 'precio_consulta',
            18 => 'campo18',
            19 => 'campo19',
            20 => 'campo20',
            21 => 'dia_lunes',
            22 => 'dia_martes',
            23 => 'dia_miercoles',
            24 => 'dia_jueves',
            25 => 'dia_viernes',
        ];
    }
    
    /**
     * Procesa una fila individual de datos de doctor
     * 
     * Este método procesa cada fila del archivo Excel, valida los datos esenciales,
     * busca o crea las entidades relacionadas (centro de salud, especialidad, distrito),
     * crea el registro del doctor y opcionalmente asocia los días de atención.
     * 
     * @param array $row La fila de datos a procesar
     * @param int $index El índice de la fila en el archivo
     * @param array $colMap El mapeo de columnas detectado
     * @return void
     */
    protected function processRow(array $row, int $index, array $colMap): void
    {
        // Skip if no centro de salud
        if (empty($row[$colMap['centrosalud']] ?? '')) {
            $this->incrementStat('errors');
            return;
        }
        
        $cmp = trim($row[$colMap['CMP']] ?? '');
        
        // Skip if no CMP
        if (empty($cmp)) {
            $this->incrementStat('errors');
            return;
        }
        
        // Check if doctor already exists
        if (Doctor::where('CMP', $cmp)->exists()) {
            $this->incrementStat('skipped');
            return;
        }
        
        try {
            // Find or create centro salud and especialidad
            $centroSalud = $this->doctorService->findOrCreateCentroSalud(
                trim($row[$colMap['centrosalud']])
            );
            
            $especialidad = $this->doctorService->findOrCreateEspecialidad(
                trim($row[$colMap['especialidad']] ?? 'General')
            );
            
            // Extract distrito from distrito_direccion field
            $distrito = null;
            $distritoField = $row[$colMap['distrito_direccion']] ?? '';
            if (!empty($distritoField)) {
                $distritoParts = explode('-', $distritoField);
                $distritoName = trim($distritoParts[0]);
                $distrito = $this->doctorService->findDistrito($distritoName);
            }
            
            // Prepare doctor data
            $doctorData = [
                'name' => trim($row[$colMap['name']] ?? ''),
                'CMP' => $cmp,
                'phone' => trim($row[$colMap['phone']] ?? '') ?: null,
                'name_secretariat' => trim($row[$colMap['name_secretariat']] ?? '') ?: null,
                'observations' => trim($row[$colMap['observations']] ?? '') ?: null,
                'categoria_medico' => trim($row[$colMap['categoria_medico']] ?? '') ?: 'Visitador',
                'tipo_medico' => trim($row[$colMap['tipo_medico']] ?? '') ?: 'En Proceso',
                'centrosalud_id' => $centroSalud->id,
                'especialidad_id' => $especialidad->id,
                'distrito_id' => $distrito?->id,
            ];
            
            // Create doctor
            $doctor = $this->doctorService->createDoctor($doctorData);
            
            // Attach days if provided
            $days = [];
            $dayColumns = ['dia_lunes', 'dia_martes', 'dia_miercoles', 'dia_jueves', 'dia_viernes'];
            
            foreach ($dayColumns as $dayIndex => $dayColumn) {
                $dayValue = $row[$colMap[$dayColumn]] ?? '';
                if (!empty(trim($dayValue))) {
                    $days[21 + $dayIndex] = trim($dayValue);
                }
            }
            
            if (!empty($days)) {
                $this->doctorService->attachDaysToDoctor($doctor, $days);
            }
            
            $this->incrementStat('created');
            
        } catch (\Exception $e) {
            $this->incrementStat('errors');
            // Error logged automatically by framework
        }
    }
}
