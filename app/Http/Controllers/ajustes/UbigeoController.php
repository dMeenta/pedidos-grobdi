<?php

namespace App\Http\Controllers\ajustes;

use App\Http\Controllers\Controller;
use App\Models\Distrito;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function ObtenerDistritosLimayCallao(){
        $distritros = Distrito::where('provincia_id',128)->orWhere('provincia_id',67)->get();
    }
}
