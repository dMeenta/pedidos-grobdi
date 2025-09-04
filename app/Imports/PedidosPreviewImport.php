<?php

namespace App\Imports;

use App\Models\Distritos_zonas;
use App\Models\Pedidos;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class PedidosPreviewImport implements ToCollection
{
    public $data;
    public $key;

    public function collection(Collection $rows)
    {
        $rows_existentes = 0;
        $rows_nuevos = 0;
        $rows_modificados = 0;
        $mensaje = "";
        
        foreach($rows as $row){
            if($row[16] === "Articulo"){
                $mensaje = "Formato Incorrecto";
                $key = "danger";
                break;
            }
            
            if($row[2] == "PEDIDO"){
                $pedido_exist = Pedidos::where('orderId', $row[3])->first();
                
                if(empty($pedido_exist)){
                    // Crear nuevo pedido
                    $pedidos = new Pedidos();
                    $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]))->format('Y-m-d');
                    $contador_registro = Pedidos::where('deliveryDate', $fecha)->orderBy('nroOrder', 'desc')->first();
                    $ultimo_nro = 1;
                    if($contador_registro){
                        $ultimo_nro = $contador_registro->nroOrder + 1;
                    }
                    
                    $pedidos->nroOrder = $ultimo_nro;
                    $pedidos->orderId = $row[3];
                    $pedidos->customerName = $row[4];
                    $pedidos->customerNumber = $row[5];
                    $pedidos->doctorName = $row[15];
                    $pedidos->address = $row[17];
                    $pedidos->reference = $row[18];
                    $pedidos->district = $row[16];
                    $pedidos->prize = $row[8];
                    $pedidos->paymentStatus = 'PENDIENTE';
                    $pedidos->paymentMethod = $row[10];
                    $pedidos->deliveryDate = $fecha;
                    $pedidos->productionStatus = $row[12] !== 'PENDIENTE' ? 1 : 0;
                    $pedidos->deliveryStatus = "Pendiente";
                    $pedidos->accountingStatus = 0;
                    
                    $hora_fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20]))->format('Y-m-d H:i:s');
                    $pedidos->zone_id = Distritos_zonas::zonificar($pedidos->district);
                    $pedidos->created_at = $hora_fecha;
                    $pedidos->turno = 0;
                    $pedidos->last_data_update = now(); // Registrar fecha de actualización
                    
                    $usuario = User::where('name', $row[19])->first();
                    if(empty($usuario)){
                        $pedidos->user_id = Auth::user()->id;
                    } else {
                        $pedidos->user_id = $usuario->id;
                    }
                    
                    $pedidos->save();
                    ++$rows_nuevos;
                    
                } else {
                    // Actualizar pedido existente si hay cambios
                    $hasChanges = false;
                    
                    $new_fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]))->format('Y-m-d');
                    
                    // Comparar y actualizar campos
                    if($pedido_exist->customerName != $row[4]) {
                        $pedido_exist->customerName = $row[4];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->customerNumber != $row[5]) {
                        $pedido_exist->customerNumber = $row[5];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->doctorName != $row[15]) {
                        $pedido_exist->doctorName = $row[15];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->address != $row[17]) {
                        $pedido_exist->address = $row[17];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->reference != $row[18]) {
                        $pedido_exist->reference = $row[18];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->district != $row[16]) {
                        $pedido_exist->district = $row[16];
                        $pedido_exist->zone_id = Distritos_zonas::zonificar($row[16]);
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->prize != $row[8]) {
                        $pedido_exist->prize = $row[8];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->paymentMethod != $row[10]) {
                        $pedido_exist->paymentMethod = $row[10];
                        $hasChanges = true;
                    }
                    
                    if($pedido_exist->deliveryDate != $new_fecha) {
                        $pedido_exist->deliveryDate = $new_fecha;
                        // Recalcular nroOrder para la nueva fecha
                        $contador_registro = Pedidos::where('deliveryDate', $new_fecha)->orderBy('nroOrder', 'desc')->first();
                        $ultimo_nro = 1;
                        if($contador_registro){
                            $ultimo_nro = $contador_registro->nroOrder + 1;
                        }
                        $pedido_exist->nroOrder = $ultimo_nro;
                        $hasChanges = true;
                    }
                    
                    $new_productionStatus = $row[12] !== 'PENDIENTE' ? 1 : 0;
                    if($pedido_exist->productionStatus != $new_productionStatus) {
                        $pedido_exist->productionStatus = $new_productionStatus;
                        $hasChanges = true;
                    }
                    
                    if($hasChanges) {
                        $pedido_exist->last_data_update = now(); // Registrar fecha de actualización
                        $pedido_exist->save();
                        ++$rows_modificados;
                    } else {
                        ++$rows_existentes;
                    }
                }
                
                $mensaje = "Pedidos procesados";
                $key = "success";
            }
        }
        
        if($mensaje == "Formato Incorrecto"){
            $rpta = $mensaje;
        } else {
            $rpta = $mensaje . ": " . $rows_nuevos . " nuevos, " . $rows_modificados . " modificados, " . $rows_existentes . " sin cambios";
        }
        
        $this->data = $rpta;
        $this->key = $key;
    }
}
