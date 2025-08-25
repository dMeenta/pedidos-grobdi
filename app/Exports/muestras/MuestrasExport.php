<?php

namespace App\Exports\muestras;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Muestras;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

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
        $query = Muestras::query()
            ->with([
                'tipoMuestra:id,name',
                'clasificacion:id,nombre_clasificacion,unidad_de_medida_id',
                'clasificacion.unidadMedida:id,nombre_unidad_de_medida',
                'doctor:id,name',
                'creator:id,name',
                'clasificacionPresentacion:id,quantity',
            ])
            ->select([
                'id',
                'nombre_muestra',
                'observacion',
                'lab_state',
                'comentarios',
                'tipo_frasco',
                'id_tipo_muestra',
                'clasificacion_id',
                'clasificacion_presentacion_id',
                'id_doctor',
                'name_doctor',
                'cantidad_de_muestra',
                'precio',
                'datetime_scheduled',
                'created_by',
                'aprobado_coordinadora',
                'aprobado_jefe_comercial'
            ])
            ->where('state', true)
            ->orderBy('created_at', 'desc');

        if (in_array($this->userRole, ['admin', 'coordinador-lineas'])) {
        } elseif ($this->userRole === 'visitador') {
            $query->where('created_by', $this->userId);
        } elseif ($this->userRole === 'jefe-comercial') {
            $query->where('aprobado_coordinadora', true);
        } else {
            $query->where('aprobado_coordinadora', true)
                ->where('aprobado_jefe_comercial', true);
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
            optional($muestra->tipoMuestra)->name,
            $muestra->clasificacion->nombre_clasificacion,
            $muestra->clasificacion->unidadMedida->nombre_unidad_de_medida,
            optional($muestra->clasificacionPresentacion)->quantity,
            $muestra->doctor->name ?? ($muestra->name_doctor ? $muestra->name_doctor : ''),
            $muestra->cantidad_de_muestra,
        ];

        if (in_array($this->userRole, $this->allowedRolesToSeePrices)) {
            $row[] = $muestra->precio;
            $row[] = $muestra->precio * $muestra->cantidad_de_muestra;
        }

        $row[] = \Carbon\Carbon::parse($muestra->datetime_scheduled)->format('d/m/Y H:i');
        $row[] = $muestra->creator ? $muestra->creator->name : 'Desconocido';

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
            'Unidad de medida',
            'Presentación del Frasco',
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
