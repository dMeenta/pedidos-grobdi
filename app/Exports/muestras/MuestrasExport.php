<?php
namespace App\Exports\muestras;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class MuestrasExport implements FromView, WithStyles
{
    protected $muestras;
    protected $headers;

    public function __construct($muestras, $headers)
    {
        $this->muestras = $muestras;
        $this->headers = $headers;
    }

    public function view(): View
    {
        return view('exports.muestras', [
            'muestras' => $this->muestras,
            'headers' => $this->headers
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo para los encabezados
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FF7182'] // rgb(255, 113, 130)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'E0E0E0']
                ]
            ]
        ]);

        // Estilo para las celdas de datos
        $sheet->getStyle('A2:E'.($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'E0E0E0']
                ]
            ]
        ]);

        // Ajustar el ancho de las columnas (300px ≈ 36 unidades en Excel)
        $sheet->getColumnDimension('A')->setWidth(36);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(36);
        $sheet->getColumnDimension('D')->setWidth(36);
        $sheet->getColumnDimension('E')->setWidth(36);

        return [];
    }
}