<?php

namespace App\Http\Controllers\softlyn;
use App\Http\Controllers\Controller;

use App\Models\TipoCambio;
use App\Models\TipoMoneda;
use Illuminate\Http\Request;

class TipoCambioController extends Controller
{
        public function index(Request $request)
    {
         $tiposCambio = TipoCambio::with('tipoMoneda')
        ->orderBy('fecha', 'desc')
        ->orderBy('id', 'desc')
        ->get();

        $monedas = TipoMoneda::all();

        return view('tipo_cambio.index', compact('tiposCambio', 'monedas'));
    }

        public function resumenTipoCambio()
    {
        $moneda = TipoMoneda::with(['ultimoCambio' => function ($q) {
            $q->latest('fecha');
        }])->find(1);

        return view('tipo_cambio.resumen', compact('moneda'));
    }

    public function create()
    {
        $monedas = TipoMoneda::where('id', 1)->get();
        return view('tipo_cambio.create', compact('monedas'));
    }

        public function store(Request $request)
    {
         $request->validate([
            'valor_compra' => 'required|numeric|min:0',
            'valor_venta' => 'required|numeric|min:0',
        ]);

        // Forzamos que siempre se registre para el dólar
        $data = [
            'tipo_moneda_id' => 1,
            'valor_compra' => $request->valor_compra,
            'valor_venta' => $request->valor_venta,
            'fecha' => date('Y-m-d'),
        ];

        TipoCambio::create($data);

        return redirect()->route('tipo_cambio.resumen')->with('success', 'Tipo de cambio registrado exitosamente para el dólar.');
    }

        public function destroy($id)
    {
        $tipoCambio = TipoCambio::findOrFail($id);

        // Verifica si la fecha del tipo de cambio es hoy
        if ($tipoCambio->fecha !== date('Y-m-d')) {
            return redirect()->back()->with('error', 'Solo se puede eliminar el tipo de cambio del día actual.');
        }

        $tipoCambio->delete();

        return redirect()->route('tipo_cambio.index')->with('success', 'Tipo de cambio eliminado correctamente.');
    }

}
