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
//imprimir reportes
use PDF;


class coordinadoraController extends Controller
{   
    public function actualizarAprobacion(Request $request, $id)
    {
        // Buscar la muestra en la base de datos
        $muestra = Muestras::find($id);

        // Verificar si la muestra existe
        if (!$muestra) {
            return response()->json(['success' => false, 'message' => 'Muestra no encontrada.']);
        }

        // Verificar el campo que se quiere actualizar
        if ($request->field == 'aprobado_jefe_comercial') {
            // Actualizar el campo 'aprobado_jefe_comercial'
            $muestra->aprobado_jefe_comercial = $request->value;

            // Si el jefe desaprueba, también desaprobamos la coordinadora
            if ($request->value == 0) {
                $muestra->aprobado_coordinadora = 0;
            }
        } elseif ($request->field == 'aprobado_coordinadora') {
            // Solo permitir aprobar si el jefe comercial ya aprobó
            if ($muestra->aprobado_jefe_comercial == 1) {
                $muestra->aprobado_coordinadora = $request->value;
            } else {
                return response()->json(['success' => false, 'message' => 'Primero debe aprobar el Jefe Comercial.']);
            }
        }

        // Deshabilitar temporalmente la actualización de la columna 'updated_at'
        $muestra->timestamps = false; // Esto evitará que 'updated_at' se actualice.

        $muestra->save();

        // Restaurar el comportamiento por defecto de los timestamps (por si se usa en otros lugares)
        $muestra->timestamps = true;

        // Disparar evento de actualización
        event(new MuestraActualizada($muestra));

        // Respuesta de éxito
        return response()->json(['success' => true, 'message' => 'Aprobación actualizada exitosamente.']);
    }

    public function actualizarFechaEntrega(Request $request, $id)
    {
        // Buscar la muestra en la base de datos
        $muestra = Muestras::find($id);
        $validated = $request->validate([
            'fecha_hora_entrega' => 'required|date|after_or_equal:' . \Carbon\Carbon::now()->format('Y-m-d\TH:i'),
        ]);

        // Usar DB para actualizar solo el campo fecha_hora_entrega sin modificar los timestamps
        DB::table('muestras')
            ->where('id', $id)
            ->update([
                'fecha_hora_entrega' => $request->fecha_hora_entrega,
            ]);
            // Disparar evento de actualización
        event(new MuestraActualizada($muestra));
        // Redirigir a la ruta 'muestras.estado' con un mensaje de éxito
        return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Fecha de entrega actualizada correctamente.');
    }

        public function aprobacionCoordinadora()
    {
        $muestras = Muestras::with(['clasificacion.unidadMedida'])->paginate(15);
        return view('muestras.coordinadora.aprob', compact('muestras'));
    }

    public function showCo($id)
    {
        // Cargar la muestra con su clasificación y la unidad de medida asociada
        $muestra = Muestras::with(['clasificacion.unidadMedida'])->findOrFail($id);
        
        // Retornar la vista de "Detalles de Muestra" con los datos
        return view('muestras.coordinadora.showCo', compact('muestra'));
    }

    public function createCO()
    {
        $clasificaciones = Clasificacion::with('unidadMedida')->get();
        return view('muestras.coordinadora.addCO', compact('clasificaciones'));
    }
       // Método para almacenar una nueva muestra
       public function storeCO(Request $request)
       {
           // Validar los datos del formulario
           $validated = $request->validate([
               'nombre_muestra' => 'required|string|max:255',
               'clasificacion_id' => 'required|exists:clasificaciones,id',
               'cantidad_de_muestra' => 'required|numeric|min:1|max:10000',
               'observacion' => 'nullable|string',
               'tipo_muestra' => 'required|in:frasco original,frasco muestra',
               'name_doctor' => 'nullable|string|max:80',
           ]);
   
           // Crear la muestra
           $muestra = Muestras::create([
               'nombre_muestra' => $validated['nombre_muestra'],
               'clasificacion_id' => $validated['clasificacion_id'],
               'cantidad_de_muestra' => $validated['cantidad_de_muestra'],
               'observacion' => $validated['observacion'],
               'tipo_muestra' => $validated['tipo_muestra'],
               'name_doctor' => $validated['name_doctor'],
               'created_by' => auth()->id(),
           ]);
   
           // Disparar evento de creación
           event(new MuestraCreada($muestra));
   
           // Redirigir a la lista de muestras con mensaje de éxito
           return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra registrada exitosamente.');
       }

       // Método para mostrar el formulario de edición de una muestra
       public function editCO($id)
       {
           // Buscar la muestra a editar
           $muestra = Muestras::findOrFail($id);
           $clasificaciones = Clasificacion::with('unidadMedida')->get(); // Cargar clasificaciones
   
           return view('muestras.coordinadora.editCO', compact('muestra', 'clasificaciones'));
       }
   
       // Método para actualizar una muestra
       public function updateCO(Request $request, $id)
       {
           // Validar los datos del formulario
           $validated = $request->validate([
               'nombre_muestra' => 'required|string|max:255',
               'clasificacion_id' => 'required|exists:clasificaciones,id',
               'cantidad_de_muestra' => 'required|numeric|min:1|max:10000',
               'observacion' => 'nullable|string',
               'tipo_muestra' => 'required|in:frasco original,frasco muestra',
               'name_doctor' => 'nullable|string|max:80',
           ]);
   
           // Buscar la muestra a actualizar
           $muestra = Muestras::findOrFail($id);
           $muestra->update($validated); // Actualizar la muestra
   
           // Disparar evento de actualización
           event(new MuestraActualizada($muestra));
   
           // Redirigir con mensaje de éxito
           return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra actualizada exitosamente.');
       }
   
       // Método para eliminar una muestra
       public function destroyCO($id)
       {
           // Buscar la muestra a eliminar
           $muestra = Muestras::findOrFail($id);
           $muestra->delete(); // Eliminar la muestra
   
           // Redirigir con mensaje de éxito
           return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra eliminada exitosamente.');
       }
}
