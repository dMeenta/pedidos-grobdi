<?php

namespace App\Http\Controllers\Visitadoras\Metas;

use App\Application\Services\Visitadoras\Metas\MetasService;
use App\Http\Controllers\Controller;
use App\Http\Requests\visitadoras\metas\StoreOrUpdateMetasRequest;
use App\Models\Doctor;
use App\Models\User;
use App\Models\VisitorGoal;
use Illuminate\Validation\ValidationException;

class MetasController extends Controller
{

    public function __construct(private readonly MetasService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listOfMetas = $this->service->getListOfMetas();
        return view('visitadoras.metas.index', compact('listOfMetas'));
    }

    /**
     * Show the form for creating a new Meta (Month, Tipo_Medico, GeneralMeta).
     */
    public function form()
    {
        $visitadoras = User::visitadoras()->get();
        $tipoMedicoList = Doctor::distinct()->pluck('tipo_medico')->filter()->values()->all();

        return view('visitadoras.metas.form', compact('visitadoras', 'tipoMedicoList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrUpdateMetasRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->service->create($validated);
            return response()->json(['success' => true, 'message' => 'Metas creadas exitosamente.']);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Error de validación'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->service->getListOfVisitorGoalByMetaId($id);
        return view('colocar-view', compact('data'));
    }

    public function getDataForChartByVisitorGoal(int $visitorGoalId)
    {
        try {
            $visitorGoal = VisitorGoal::with([
                'visitadora:id',
                'monthlyVisitorGoal:id,start_date,end_date'
            ])
                ->select('id', 'user_id', 'goal_amount', 'debited_amount', 'monthly_visitor_goal_id')
                ->findOrFail($visitorGoalId);

            return response()->json([
                'success' => true,
                'message' => 'Datos para chart obtenidos.',
                'chart-data' => $this->service->getDataForChart($visitorGoal),
                'doctors-data' => $this->service->getPedidosDoctorStatsByMonthlyVisitorGoal($visitorGoal->monthlyVisitorGoal->id)
            ]);
        } catch (\Throwable $th) {
            // Manejo de error apropiado (log, respuesta de error, etc.)
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
