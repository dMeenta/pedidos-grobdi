<?php

namespace App\Http\Controllers\muestras; // Namespace correcto para la carpeta "muestras"

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MuestrasExport;
use App\Models\TipoMuestra;

class coordinadoraController extends Controller
{
    public function exportarExcel(Request $request)
    {
        $muestras = Muestras::with(['clasificacion', 'creator'])
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Nombre de la Muestra',
            'Clasificación',
            'Tipo de Muestra',
            'Día de Entrega',
            'Doctor',
            'Creado por'
        ];

        return \Excel::download(
            new \App\Exports\muestras\MuestrasExport($muestras, $headers),
            'muestras_coordinadora.xlsx'
        );
    }

    public function aprobacionCoordinadora()
    {
        $muestras = Muestras::with(['clasificacion.unidadMedida'])->orderBy('created_at', 'desc')->get();
        $tiposMuestra = TipoMuestra::all();
        return view('muestras.coordinadora.aprob', compact('muestras', 'tiposMuestra'));
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
        $validated = $request->validate([
            'nombre_muestra' => 'required|string|max:255',
            'clasificacion_id' => 'required|exists:clasificaciones,id',
            'cantidad_de_muestra' => 'required|numeric|min:1|max:10000',
            'observacion' => 'nullable|string',
            'tipo_frasco' => 'required|in:frasco original,frasco muestra',
            'name_doctor' => 'nullable|string|max:80',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // VALIDACIÓN DE IMAGEN
        ], [
            'cantidad_de_muestra.min' => 'La cantidad de muestra debe ser al menos 1.',
            'cantidad_de_muestra.max' => 'La cantidad de muestra no puede exceder 10,000.',
            'foto.image' => 'El archivo debe ser una imagen válida.',
            'foto.mimes' => 'La imagen debe ser de tipo jpg, jpeg, png o webp.',
        ]);

        // Manejar la subida de la imagen si existeq
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $timestamp = Carbon::now()->format('m-d_H-i');
            $filename = Str::slug($validated['nombre_muestra']) . "_$timestamp." . $file->getClientOriginalExtension();
            $relativePath = 'images/muestras_fotos';
            $fullPath = public_path($relativePath);
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            } //crea directorio si no existe
            $file->move($fullPath, $filename);
            $fotoPath = $relativePath . '/' . $filename;
        }

        $muestra = Muestras::create([
            'nombre_muestra' => $validated['nombre_muestra'],
            'clasificacion_id' => $validated['clasificacion_id'],
            'cantidad_de_muestra' => $validated['cantidad_de_muestra'],
            'observacion' => $validated['observacion'],
            'tipo_frasco' => $validated['tipo_frasco'],
            'name_doctor' => $validated['name_doctor'],
            'foto' => $fotoPath,
            'estado' => 'Pendiente',
            'created_by' => auth()->id(),
        ]);

        event(new MuestraCreada($muestra));
        return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra registrada exitosamente.');
    }

    public function editCO($id)
    {
        $muestra = Muestras::findOrFail($id);
        $clasificaciones = Clasificacion::with('unidadMedida')->get(); // Cargar clasificaciones

        return view('muestras.coordinadora.editCO', compact('muestra', 'clasificaciones'));
    }

    public function updateCO(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre_muestra' => 'required|string|max:255|unique:muestras,nombre_muestra,' . $id,
            'clasificacion_id' => 'required|exists:clasificaciones,id',
            'cantidad_de_muestra' => 'required|numeric|min:1|max:10000',
            'observacion' => 'nullable|string',
            'tipo_muestra' => 'required|in:frasco original,frasco muestra',
            'name_doctor' => 'nullable|string|max:80',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nombre_muestra.unique' => 'El nombre de la muestra ya está en uso.',
            'cantidad_de_muestra.min' => 'La cantidad de muestra debe ser al menos 1.',
            'cantidad_de_muestra.max' => 'La cantidad de muestra no puede exceder 10,000.',
            'foto.image' => 'El archivo debe ser una imagen válida.',
            'foto.mimes' => 'La imagen debe ser de tipo jpg, jpeg, png o webp.',
        ]);

        $muestra = Muestras::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nombreMuestra = Str::slug($validated['nombre_muestra'], '_');
            $fecha = now()->format('m-d_H-i');
            $extension = $file->getClientOriginalExtension();
            $fileName = "{$nombreMuestra}-{$fecha}.{$extension}";
            $destinationPath = public_path('images/muestras_fotos');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            if (isset($muestra->foto) && $muestra->foto) {
                $oldFilePath = public_path($muestra->foto);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
            $file->move($destinationPath, $fileName);
            $validated['foto'] = 'images/muestras_fotos/' . $fileName;
        }

        $muestra->update($validated);
        event(new MuestraActualizada($muestra));

        return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra actualizada exitosamente.');
    }

    public function destroyCO($id)
    {
        $muestra = Muestras::findOrFail($id);
        $muestra->delete(); // Eliminar la muestra

        return redirect()->route('muestras.aprobacion.coordinadora')->with('success', 'Muestra eliminada exitosamente.');
    }
}
