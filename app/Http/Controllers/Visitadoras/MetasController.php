<?php

namespace App\Http\Controllers\Visitadoras;

use App\Http\Controllers\Controller;
use App\Http\Requests\visitadoras\StoreOrUpdateMetasRequest;
use App\Models\GoalConfig;
use App\Models\MonthlyVisitorGoal;
use App\Models\User;
use App\Models\VisitorGoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MetasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('visitadoras.metas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function form()
    {
        return view('visitadoras.metas.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrUpdateMetasRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
