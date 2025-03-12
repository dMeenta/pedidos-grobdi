<?php

namespace App\Http\Controllers\pedidos\contabilidad;

use App\Exports\pedidos\PedidoscontabilidadExport;
use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PedidosContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->query("fecha_inicio")){
            $request->validate([
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);
            $fechaInicio = Carbon::parse($request->fecha_inicio)->startOfDay();
            $fechaFin = Carbon::parse($request->fecha_fin)->endOfDay();
        
            // Realizar la búsqueda en la base de datos
            $pedidos = Pedidos::whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->orderBy('created_at','asc')->latest()->paginate(25);

        }else{
            $pedidos = Pedidos::orderBy('created_at','asc')
            ->where('created_at',date('Y-m-d'))
            ->latest()->paginate(25);

        }
        return view('pedidos.contabilidad.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show($pedido)
    {
        $pedido = Pedidos::find($pedido);
        return view('pedidos.contabilidad.show',compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pedidos = Pedidos::find($id);
        $pedidos->update(attributes: request()->all());
          
        return redirect()->route('pedidoscontabilidad.index')
                        ->with('success','Pedido modificado exitosamente');
    }
    public function downloadExcel($fecha_inicio,$fecha_fin){
        $dia = date('d-m-Y');
        return Excel::download(new PedidoscontabilidadExport($fecha_inicio,$fecha_fin), 'reporte-'.$dia.'.xlsx');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
