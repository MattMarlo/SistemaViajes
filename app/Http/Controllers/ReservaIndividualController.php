<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservaService;
use Illuminate\Support\Facades\DB;

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
        return view('modules.reservas.individual.create', compact('clientes', 'destinos'));
    }
}
