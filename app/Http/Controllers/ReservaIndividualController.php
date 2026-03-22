<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservaService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservaIndividualController extends Controller
{
    protected $reservaService;
    // Inyectamos el servicio en el constructor
    public function __construct(ReservaService $reservaService)
    {
        $this->reservaService = $reservaService;
    }
    public function create()
    {
        $clientes = DB::table('clientes')->get();
        $destinos = DB::table('destinos')->get();
        $reservas = DB::table('reservas')->get();
        return view('modules.reservas.individual.create', compact('clientes', 'destinos','reservas'));
    }
    
    public function store(Request $request){
        $datos=$request->validate([
            'cliente_id'=>'required|integer',
            'destino_id'=>'required|integer',
            'fecha_viaje'=>'required|date',
            'precio_total_viaje'=>'required|numeric',
            'monto_depositado' => 'nullable|numeric',
            'metodo_pago' => 'nullable|string',
        ]);
        try{
            //llamamos al método específico del service
            $codigo=$this->reservaService->guardarIndividual($datos,Auth::id()??1);
        }catch(\Exception $e){
            return back()->with('error','Error al crear'.$e->getMessage());
        }
    }
}
