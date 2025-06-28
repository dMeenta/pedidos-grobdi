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
        public function showLab($id)
    { 
       // Cargar la muestra con sus relaciones
       $muestra = Muestras::with(['clasificacion.unidadMedida'])->findOrFail($id);
        
       // Pasar la variable correctamente nombrada (en singular)
       return view('muestras.laboratorio.showlab', ['muestra' => $muestra]);
    }

            public function estado()
    {
        // Obtén la fecha actual
        $fechaActual = Carbon::now();

        // Calcula la fecha de hace 7 días
        $fechaInicio = $fechaActual->copy()->startOfDay();
        
        // Calcula la fecha de 7 días a partir de la fecha actual
        $fechaFin = $fechaActual->copy()->addDays(7)->endOfDay();

        // Obtén todas las muestras cuyo 'fecha_hora_entrega' esté dentro de los próximos 7 días
        $muestras = Muestras::whereBetween('fecha_hora_entrega', [$fechaInicio, $fechaFin])
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

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
