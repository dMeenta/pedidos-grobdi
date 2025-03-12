<?php

namespace App\Imports;

use App\Models\DetailPedidos;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DetailPedidosImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data;
    public $key;

    public function collection(Collection $rows)
    {
        $row_nuevos = 0;
        $row_no_encontrados = 0;
        $row_existentes = 0;
        $mensaje = "";
        $msj = "";
        foreach($rows as $row){
            if($row[16]==="Distrito"){
                $mensaje = "Formato Incorrecto";
                $key = "danger";
                break;
            }
            if($row[2] == "PEDIDO"){
                $pedido = Pedidos::where('orderId',$row[3])->first();
                if($pedido){
                    $pedido_exist = DetailPedidos::select("articulo")->where('pedidos_id',$pedido->id)->where('articulo',$row[16])->where('cantidad',$row[17])->first();
                    if(empty($pedido_exist)){
                        $detallePedido = new DetailPedidos();
                        $detallePedido->pedidos_id = $pedido->id;
                        $detallePedido->articulo = $row[16];
                        $detallePedido->cantidad = $row[17];
                        $detallePedido->unit_prize = $row[18];
                        $detallePedido->sub_total = $row[19];
                        $detallePedido->created_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21]))->format('Y-m-d H:i:s');
                        $detallePedido->save();
                        ++$row_nuevos;
                    }else{
                        $msj = $msj.$row[3].$row[16];
                        ++$row_existentes;
                    }
                }else{
                    ++$row_no_encontrados;
                }
                $key = "success";
            }
        }
        if($row_no_encontrados>0){
            $key = "warning";
        }
        if($mensaje =="Formato Incorrecto"){
            $rpta = $mensaje;
            $key = "danger";
        }else{
            $rpta = "Articulos registrados: ".$row_nuevos."\n Articulos Existentes: ".$row_existentes."\n Articulos no encontrados: ".$row_no_encontrados;
        }
        $this->data= $rpta;
        $this->key = $key;
    }
}
