<?php

namespace App\Http\Controllers\pedidos\laboratorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Zone;
use Carbon\Carbon;
class PedidoslabController extends Controller
{
    public function index(Request $request)
    {
        if($request->query("fecha")){
            $request->validate([
                'fecha' => 'required|date'
            ]);
            $fecha = Carbon::parse($request->fecha)->startOfDay();
        }else{
            $fecha = date('Y-m-d');
        }
        $pedidos = Pedidos::where('deliveryDate', $fecha)->orderBy('nroOrder','asc')
        ->latest()->get();
        return view('pedidos.laboratorio.index', compact('pedidos'));
    }
    public function show($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.laboratorio.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pedido){
        $pedido = Pedidos::find($pedido);
        return view('pedidos.laboratorio.edit',compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pedidos = Pedidos::find($id);
        $pedidos->update(attributes: request()->all());
          
        return redirect()->route('pedidoslaboratorio.index')
                        ->with('success','Pedido modificado exitosamente');
    }
    public function DownloadWord($fecha){
        // dd($fecha);
        $pedidos = Pedidos::where('deliveryDate',$fecha)->orderBy('nroOrder','asc')->get();
        $zonas = Zone::get();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        foreach($zonas as $zona){
            $arrayWord = [];
            $numero_ordenes = "";
            $manana = 0;
            $tarde = 0;
            array_push($arrayWord,$zona->name);
            foreach($pedidos as $pedido){
                if($pedido->zone_id === $zona->id){
                    if($manana == 0 && $pedido->turno == 0){
                        $manana = 1;
                        array_push($arrayWord,'');
                        array_push($arrayWord,'TURNO MAÑANA');
                    }else if ($tarde == 0 && $pedido->turno == 1){
                        array_push($arrayWord,'');
                        array_push($arrayWord,'TURNO TARDE');
                        $tarde = 1;
                    }
                    $numero_ordenes =$numero_ordenes.$pedido->nroOrder.", ";
                    array_push($arrayWord,$pedido->nroOrder." PED ".$pedido->orderId);
                    array_push($arrayWord,$pedido->customerName." - ".$pedido->customerNumber);
                    array_push($arrayWord,$pedido->doctorName);
                    foreach($pedido->detailpedidos as $orden){
                        array_push($arrayWord,$orden->articulo.' - '.$orden->cantidad.' unid.');
                    }
                    array_push($arrayWord,"S/ ".$pedido->prize);
                    array_push($arrayWord,$pedido->district);
                }
            }
            $arrayWord[0] = $arrayWord[0].": ".$numero_ordenes;
            
            foreach ($arrayWord as $id => $text) {
                if ($id == 0) {
                    $text = $section->addText($text,array('name'=>'Arial','size' => 16,'bold' => true));
                }elseif (strpos($text,' PED ')) {
                    $text = $section->addText($text,array('name'=>'Arial','size' => 11,'bold' => true));
                }else{
                    $text = $section->addText($text);
                }
            }
            $section->addPageBreak();
        }
        


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        if (file_exists('docs\pedidos-'.$fecha.'.docx')){
            unlink('docs\pedidos-'.$fecha.'.docx');
            $objWriter->save('docs\pedidos-'.$fecha.'.docx');
            
        }else{
            $objWriter->save('docs\pedidos-'.$fecha.'.docx');
        }
        return response()->download(public_path('docs\pedidos-'.$fecha.'.docx'));
    }
}
