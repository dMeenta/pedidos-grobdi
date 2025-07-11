<?php
namespace App\Http\Controllers\muestras; // Namespace correcto para la carpeta "muestras"

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Muestras;
use App\Models\UnidadMedida;
use App\Models\Clasificacion;
//formatear
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//eventos
use App\Events\muestras\MuestraCreada;
use App\Events\muestras\MuestraActualizada;

class laboratorioController extends Controller
{
    public function exportarExcel(Request $request)
    {
        $fechaActual = Carbon::now();
        $muestras = Muestras::with(['clasificacion', 'creator'])
        ->whereRaw('? between fecha_hora_entrega and DATE_ADD(fecha_hora_entrega, INTERVAL 7 DAY)', [$fechaActual])
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
        $fechaActual = Carbon::now();
        
        // Obtener el estado de la solicitud (Pendiente o Elaborado)
        $estado = request()->estado;

        // Filtrar las muestras según el estado (Pendiente o Elaborado)
        $query = Muestras::whereRaw('? between fecha_hora_entrega and DATE_ADD(fecha_hora_entrega, INTERVAL 7 DAY)', [$fechaActual]);

        if ($estado) {
            $query->where('estado', $estado);  // Filtra según el estado seleccionado
        }

        // Obtener las muestras paginadas
        $muestras = $query->orderBy('created_at', 'desc')->paginate(10);

        // Devolver la vista con las muestras
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

    public function actualizarComentario(Request $request, $id)
{
    $request->validate([
        'comentarios' => 'nullable|string',
    ]);

    $muestra = Muestras::findOrFail($id);
    $muestra->comentarios = $request->comentarios;
    $muestra->save();

    return redirect()->route('muestras.estado')->with('success', 'Comentario guardado correctamente.');
}

    
}
