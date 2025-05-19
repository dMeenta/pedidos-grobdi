<?php

namespace App\Http\Controllers\pedidos\reportes;

use App\Exports\pedidos\PedidosHojarutamotorizadoExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FormatosController extends Controller
{
    public function index(){
        return view('pedidos.reportes.index');
    }
    public function excelhojaruta(Request $request)  {
        $nombre = $request->ruta.'_'.$request->fecha;
        $fecha = $request->fecha;
        return Excel::download(new PedidosHojarutamotorizadoExport($fecha), 'reporte-'.$nombre.'.xlsx');
    }
}
