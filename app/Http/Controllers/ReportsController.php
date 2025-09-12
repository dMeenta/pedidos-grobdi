<?php

namespace App\Http\Controllers;

use App\Models\Distrito;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function indexVisitadoras()
    {
        return view('reports.visitadoras.index');
    }

    public function getDistritosByZone($zoneId)
    {
        $distritosByZone = Distrito::whereHas('listas', function ($q) use ($zoneId) {
            $q->where('zone_id', $zoneId);
        })->get();

        return response()->json($distritosByZone);
    }
}
