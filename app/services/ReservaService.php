<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReservaService
{
    /**
     * Lógica para guardar la reserva INDIVIDUAL
     */
    public function guardarIndividual($datos, $usuario_id)
    {
        
    }

    

    /**
     * Función privada para no repetir código de generación de IDs
     */
    private function generarCodigo()
    {
        return 'RES-' . strtoupper(substr(uniqid(), -6));
    }
}