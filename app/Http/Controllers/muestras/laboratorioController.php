<?php

namespace App\Http\Controllers\muestras; // Namespace correcto para la carpeta "muestras"

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Muestras;
//formatear
use Illuminate\Support\Facades\DB;
//eventos
use App\Events\muestras\MuestraActualizada;

class laboratorioController extends Controller
{
    public function exportarExcel(Request $request)
    {
        $muestras = Muestras::with(['clasificacion', 'creator'])
            ->orderBy('created_at', 'desc')
            ->get();
        $headers = [
            '#',
            'Nombre de la Muestra',
            'Clasificación',
            'Tipo',
            'J. Comercial',
            'Coordinadora',
            'Cantidad',
            'Estado',
            'Creado por',
            'Doctor',
            'Fecha Entrega'
        ];
        return \Excel::download(
            new \App\Exports\muestras\LaboratorioExport($muestras, $headers),
            'muestras_laboratorio.xlsx'
        );
    }
    public function showLab($id)
    {
        // Cargar la muestra con sus relaciones
        $muestra = Muestras::with(['clasificacion.unidadMedida'])->findOrFail($id);

        // Pasar la variable correctamente nombrada (en singular)
        return view('muestras.laboratorio.showlab', ['muestra' => $muestra]);
    }
    public function estado()
    {
        $estado = request()->estado;

        $query = Muestras::query();

        if ($estado) {
            $query->where('estado', $estado);
        }

        $muestras = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('muestras.laboratorio.estado', compact('muestras'));
    }

    // Método para actualizar el estado
    public function actualizarEstado(Request $request, $id)
    {
        $validated = $request->validate([
            'estado' => 'required|string|in:Pendiente,Elaborado',
        ]);

        // Actualización directa sin afectar timestamps
        DB::table('muestras')
            ->where('id', $id)
            ->update(['estado' => $request->estado]);

        // Recuperar la muestra para el broadcast
        $muestra = Muestras::findOrFail($id);
        broadcast(new MuestraActualizada($muestra))->toOthers();

        return response()->json(['success' => true]);
    }
}
