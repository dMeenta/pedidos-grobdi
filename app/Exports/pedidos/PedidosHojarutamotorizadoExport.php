<?php

namespace App\Exports\pedidos;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PedidosHojarutamotorizadoExport implements 
FromArray,
WithDrawings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $fecha;

    function __construct($fecha) {
            $this->fecha = $fecha;
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo del Proyecto');
        $drawing->setPath(public_path('images/logo.jpg')); // Asegúrate que la imagen exista
        $drawing->setHeight(80); // Puedes ajustar tamaño
        $drawing->setCoordinates('A1'); // Ubicación en la hoja
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);

        return $drawing;
    }

    public function array(): array
    {
        dd($this->fecha);
        return [];
    }
}
