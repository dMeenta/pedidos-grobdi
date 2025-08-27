<?php

namespace App\Exports\muestras;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class MuestrasExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, WithStyles, WithColumnWidths, WithEvents
{
    protected $userId;
    protected $userRole;
    protected $allowedRolesToSeePrices;

    public function __construct($userId, $userRole, $allowedRolesToSeePrices)
    {
        $this->userId = $userId;
        $this->userRole = $userRole;
        $this->allowedRolesToSeePrices = $allowedRolesToSeePrices;
    }

    public function query()
    {
        $columns = [
            'muestras.id',
            'muestras.nombre_muestra',
            'muestras.observacion',
            'muestras.lab_state',
            'muestras.comentarios',
            'muestras.tipo_frasco',
            'tipo_muestras.name as tipo_muestra',
            'clasificaciones.nombre_clasificacion as clasificacion',
            'clasificacion_presentaciones.quantity as presentacion',
            'unidad_de_medida.nombre_unidad_de_medida as unidad_de_medida',
            'doctor.name as doctor',
            'muestras.name_doctor',
            'muestras.cantidad_de_muestra as cantidad',
            'muestras.datetime_scheduled',
            'users.name as creator',
            'muestras.aprobado_coordinadora',
            'muestras.aprobado_jefe_comercial'
        ];

        if (in_array($this->userRole, $this->allowedRolesToSeePrices)) {
            $columns[] = 'muestras.precio';
        }

        $query = DB::table('muestras')
            ->leftJoin(
                'tipo_muestras',
                'muestras.id_tipo_muestra',
                '=',
                'tipo_muestras.id'
            )
            ->leftJoin('clasificacion_presentaciones', 'muestras.clasificacion_presentacion_id', '=', 'clasificacion_presentaciones.id')
            ->leftJoin('clasificaciones', 'muestras.clasificacion_id', '=', 'clasificaciones.id')
            ->leftJoin('doctor', 'muestras.id_doctor', '=', 'doctor.id')
            ->leftJoin('users', 'muestras.created_by', '=', 'users.id')
            ->leftJoin('unidad_de_medida', 'clasificaciones.unidad_de_medida_id', '=', 'unidad_de_medida.id')
            ->select($columns)
            ->where('muestras.state', true)
            ->orderBy('muestras.created_at', 'desc');

        if (in_array($this->userRole, ['admin', 'coordinador-lineas'])) {
        } elseif ($this->userRole === 'visitador') {
            $query->where('created_by', $this->userId);
        } elseif ($this->userRole === 'jefe-comercial') {
            $query->where('aprobado_coordinadora', true);
        } else if ($this->userRole === 'laboratorio') {
            $query->where('aprobado_coordinadora', true)
                ->where('aprobado_jefe_comercial', true)
                ->where('aprobado_jefe_operaciones', true);
        } else {
            $query->where([
                'aprobado_coordinadora' => true,
                'aprobado_jefe_comercial' => true
            ]);
        }

        return $query;
    }

    public function map($muestra): array
    {
        $row = [
            $muestra->id,
            $muestra->nombre_muestra,
            $muestra->observacion,
            $muestra->lab_state ? 'ELABORADA' : 'PENDIENTE',
            $muestra->comentarios,
            $muestra->tipo_frasco,
            $muestra->tipo_muestra ?? '',
            $muestra->clasificacion,
            $muestra->presentacion ?? '',
            $muestra->unidad_de_medida,
            $muestra->doctor ?? ($muestra->name_doctor ? $muestra->name_doctor : ''),
            $muestra->cantidad,
        ];

        if (in_array($this->userRole, $this->allowedRolesToSeePrices)) {
            $row[] = $muestra->precio;
            $row[] = $muestra->precio * $muestra->cantidad;
        }

        $row[] = \Carbon\Carbon::parse($muestra->datetime_scheduled)->format('d/m/Y H:i');
        $row[] = $muestra->creator ?? 'Desconocido';

        return $row;
    }

    public function headings(): array
    {
        $headers = [
            'ID',
            'Nombre de la Muestra',
            'Observación',
            'Estado de laboratorio',
            'Comentarios de laboratorio',
            'Tipo de Frasco',
            'Tipo de Muestra',
            'Clasificación',
            'Presentación del Frasco',
            'Unidad de medida',
            'Doctor',
            'Cantidad',
        ];

        if (in_array($this->userRole, $this->allowedRolesToSeePrices)) {
            $headers[] = 'Precio Unitario';
            $headers[] = 'Precio Total';
        }

        $headers[] = 'Día de Entrega (Programado)';
        $headers[] = 'Creado por';

        return $headers;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        // Estilo general para celdas de datos
        $sheet->getStyle("A2:{$highestColumn}{$highestRow}")->applyFromArray([
            'alignment' => [
                'wrapText' => true,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                ]
            ]
        ]);

        // Encabezado en negrita
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FC0000']
            ]
        ]);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $lastColumn = in_array($this->userRole, $this->allowedRolesToSeePrices) ? 'P' : 'L';

                $highestRow = $sheet->getHighestRow();

                // Poner los datos en una tabla de Excel
                $sheet->setAutoFilter("A1:{$lastColumn}{$highestRow}");
            },
        ];
    }

    public function columnWidths(): array
    {
        $widths = [
            'A' => 10,  // ID
            'B' => 25,  // Nombre
            'C' => 25,  // Observación
            'D' => 20,  // Estado
            'E' => 25,  // Comentarios
            'F' => 20,  // Frasco
            'G' => 25,  // Tipo muestra
            'H' => 20,  // Clasificación
            'I' => 25,  // Unidad medida
            'J' => 25,  // Presentación del Frasco
            'K' => 20,  // Doctor
            'L' => 10,  // Cantidad
        ];
        if (in_array($this->userRole, $this->allowedRolesToSeePrices)) {
            $widths['M'] = 15; // Precio Unitario
            $widths['N'] = 15; // Precio Total
            $widths['O'] = 25; // Día programado
            $widths['P'] = 25; // Creador
        } else {
            $widths['M'] = 25; // Día programado
            $widths['N'] = 25; // Creador
        }

        return $widths;
    }
}
