<?php
namespace App\Exports\muestras;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaboratorioExport implements FromView, WithStyles
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
        return view('exports.laboratorio', [
            'muestras' => $this->muestras,
            'headers' => $this->headers
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $colCount = count($this->headers);
        $lastCol = chr(64 + $colCount);
        // Encabezados
        $sheet->getStyle("A1:{$lastCol}1")->applyFromArray([
            'font' => [ 'bold' => true, 'color' => ['rgb' => 'FFFFFF'] ],
            'fill' => [ 'fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FF7182'] ],
            'borders' => [ 'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FF7182'] ] ]
        ]);
        // Datos
        $sheet->getStyle("A2:{$lastCol}" . $sheet->getHighestRow())->applyFromArray([
            'borders' => [ 'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E0E0E0'] ] ]
        ]);
        // Ancho de columnas
        foreach(range('A',$lastCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        return [];
    }
}
