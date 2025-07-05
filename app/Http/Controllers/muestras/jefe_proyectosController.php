<?php
namespace App\Http\Controllers\muestras;

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
//imprimir reportes
use PDF;
class jefe_proyectosController extends Controller
{
    
         public function precio()
    {
        // Obtén todas las muestras
        $muestras = Muestras::orderBy('created_at', 'desc')->get();
        return view('muestras.jefe_proyectos.precio', compact('muestras'));
    }


        public function actualizarPrecio(Request $request, $id)
    {
        // Validar que el precio es un número
        $request->validate([
            'precio' => 'required|numeric|min:0',
        ]);

        // Buscar la muestra en la base de datos
        $muestra = DB::table('muestras')->where('id', $id)->first();

        // Verificar si la muestra existe
        if (!$muestra) {
            return response()->json(['success' => false, 'message' => 'Muestra no encontrada.']);
        }

        // Actualizar el precio en la base de datos
        DB::table('muestras')
            ->where('id', $id)
            ->update(['precio' => $request->precio]);

        // Devolver respuesta JSON
        return response()->json([
            'success' => true,
            'message' => 'Precio actualizado exitosamente.',
            'precio' => $request->precio
        ]);
    }

    public function showJO($id)
    {
        // Cargar la muestra con su clasificación y la unidad de medida asociada
        $muestra = Muestras::with(['clasificacion.unidadMedida'])->findOrFail($id);
        
        // Retornar la vista de "Detalles de Muestra" con los datos
        return view('muestras.jefe_proyectos.showJO', compact('muestra'));
    }
}
