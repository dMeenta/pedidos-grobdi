<?php

namespace App\Exports\pedidos;

use App\Models\Pedidos;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidoscontabilidadExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $fechaInicio;
    protected $fechaFin;

    function __construct($fechaInicio,$fechaFin) {
            $this->fechaInicio = $fechaInicio;
            $this->fechaFin = $fechaFin;
    }
    public function array(): array
    {
        $pedidos = Pedidos::select('orderId','created_at','voucher','customerName','prize','paymentMethod','accountingStatus')->whereBetween('created_at', [$this->fechaInicio, $this->fechaFin])->get();
        $array_acum = [];
        foreach($pedidos as $pedido){
            if($pedido->voucher){
                $voucher = 'Si';
            }
            else{
                $voucher = 'No';
            }
            $array_pedido = [
                'idOrden' => $pedido->orderId,
                'cliente' => $pedido->customerName,
                'fecha_creado' => date('d-m-Y',strtotime($pedido->created_at)),
                'metodo de pago' => $pedido->paymentMethod,
                'voucher' => $voucher,
                'total' => $pedido->prize,
                'Estado de Contabilidad' => $pedido->accountingStatus == 0 ? 'Sin revisar':'Revisado',
            ];
            array_push($array_acum,$array_pedido);
        }
        // dd( $array_acum);
        return $array_acum;
    }
    public function headings(): array
    {
        return [
            "ID Orden", 
            "Cliente",
            "Fecha registro", 
            "Metodo de pago",
            "Voucher cargado",
            "Total"
        ];
    }
}
