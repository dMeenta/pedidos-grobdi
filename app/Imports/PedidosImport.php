<?php

namespace App\Imports;

use App\Models\Distritos_zonas;
use App\Models\Pedidos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class PedidosImport implements ToCollection
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
        $rows_existentes = 0;
        $rows_nuevos = 0;
        $mensaje= "";
        foreach($rows as $row){
            if($row[16] ==="Articulo"){
                $mensaje = "Formato Incorrecto";
                $key = "danger";
                break;
            }
            if($row[2] == "PEDIDO"){
                $pedido_exist = Pedidos::where('orderId',$row[3])->first();
                if(empty($pedido_exist)){
                    $pedidos = new Pedidos();
                    $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]))->format('Y-m-d');
                    $contador_registro = Pedidos::where('deliveryDate',$fecha)->orderBy('nroOrder','desc')->first();
                    $ultimo_nro = 1;
                    if($contador_registro){
                        $ultimo_nro = $contador_registro->nroOrder+1;
                    }
                    $pedidos->nroOrder = $ultimo_nro;
                    $pedidos->orderId = $row[3];
                    $pedidos->customerName = $row[4];
                    $pedidos->customerNumber = $row[5];
                    $pedidos->doctorName = $row[15];
                    //falta el detallado de la orden
                    $pedidos->address = $row[17];
                    $pedidos->reference = $row[18];
                    $pedidos->district = $row[16];
                    $pedidos->prize = $row[8];
                    $pedidos->paymentStatus = 'PENDIENTE';
                    $pedidos->paymentMethod = $row[10];
                    $pedidos->deliveryDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]))->format('Y-m-d');
                    $pedidos->productionStatus = $row[12] !== 'PENDIENTE' ? 1 : 0;
                    $pedidos->deliveryStatus = "Pendiente";
                    $pedidos->accountingStatus = 0;
                    // dd($row[19]);
                    $hora_fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20]))->format('Y-m-d H:i:s');
                    $pedidos->zone_id = Distritos_zonas::zonificar($pedidos->district);
                    $pedidos->created_at = $hora_fecha;
                    $hora_pedido = Carbon::parse($hora_fecha)->format('H:i:s');
                    if($hora_pedido<"15:30:00"){
                        $pedidos->turno = 0;
                    }
                    else{
                        $pedidos->turno = 1;
                    }
                    $usuario = User::where('name',$row[19])->first();
                    // dd($usuario);
                    if(empty($usuario)){
                        $pedidos->user_id = Auth::user()->id;
                    }else{
                        $pedidos->user_id = $usuario->id;
                    }
                    $pedidos->save();
                    ++$rows_nuevos;
                }
                else{
                    ++$rows_existentes;
                }
                $mensaje = "Pedidos registrados";
                $key = "success";
            }
        }
        if($mensaje =="Formato Incorrecto"){
            $rpta = $mensaje;
        }else{
            $rpta = $mensaje.": ".$rows_nuevos."\n Pedidos Existentes: ".$rows_existentes;
        }
        $this->data = $rpta;
        $this->key = $key;
        // return new Pedidos([
            
        // ]);
    }
}
