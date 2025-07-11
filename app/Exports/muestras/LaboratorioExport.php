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
            'borders' => [ 'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FF7182'] ] ],
            'alignment' => [
            'wrapText' => true,  
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Centrado horizontal
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER  // Centrado vertical
        ]
        ]);
        // Datos
        $sheet->getStyle("A2:{$lastCol}" . $sheet->getHighestRow())->applyFromArray([
            'borders' => [ 'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FF7182'] ] ],
            'alignment' => [
            'wrapText' => true,  
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, 
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER  
        ]
        ]);
        
        // Ancho de columnas
        $sheet->getColumnDimension('A')->setWidth(5);   // #
        $sheet->getColumnDimension('B')->setWidth(35);  // Nombre de la Muestra
        $sheet->getColumnDimension('C')->setWidth(17);  // Clasificación
        $sheet->getColumnDimension('D')->setWidth(15);  // Tipo de Muestra
        $sheet->getColumnDimension('E')->setWidth(15);  // Aprobado J. Comercial
        $sheet->getColumnDimension('F')->setWidth(17);  // Aprobado Coordinadora
        $sheet->getColumnDimension('G')->setWidth(13);  // Cantidad
        $sheet->getColumnDimension('H')->setWidth(12);  // Estado
        $sheet->getColumnDimension('I')->setWidth(15);  // Creado por
        $sheet->getColumnDimension('J')->setWidth(15);  // Doctor
        $sheet->getColumnDimension('K')->setWidth(20);  // Fecha/hora Entrega
        foreach ($sheet->getRowIterator() as $row) {
            $sheet->getRowDimension($row->getRowIndex())->setRowHeight(-1); 
        }

        return [];
    }
}
