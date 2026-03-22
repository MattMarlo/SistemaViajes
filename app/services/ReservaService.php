<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ReservaService
{
    /**
     * Lógica para guardar la reserva INDIVIDUAL
     */
    public function guardarIndividual($datos)
    {
        $codigo_reserva = $this->generarCodigo();
        $fecha_actual = Carbon::now();

        return DB::transaction(function () use ($datos, $codigo_reserva, $fecha_actual) {
            $usuario_id = $datos['user_id'] ?? null;
            $estado_reserva = $datos['estado'] ?? 'pendiente';

            // Determinar el estado inicial del pago
            $monto_depo = $datos['monto_depositado'] ?? 0;
            $precio_total = $datos['precio_total_viaje'];

            $estado_pago = ($monto_depo > 0) ? 'parcial' : 'pendiente';
            if ($monto_depo >= $precio_total && $precio_total > 0) {
                $estado_pago = 'pagado';
            }

            // 1. Insertar la reserva (SIN grupo_id, ya no existe en esta tabla)
            $reserva_id = DB::table('reservas')->insertGetId([
                'codigo_reserva'     => $codigo_reserva,
                'cliente_id'         => $datos['cliente_id'],
                'destino_id'         => $datos['destino_id'],
                'user_id'            => $usuario_id,
                'tipo'               => 'individual',
                'fecha_reserva'      => $datos['fecha_reserva'],
                'fecha_viaje'        => $datos['fecha_viaje'],
                'precio_total_viaje' => $precio_total,
                'estado'             => $estado_reserva,
                'estado_pago'        => $estado_pago,
                'created_at'         => $fecha_actual,
                'updated_at'         => $fecha_actual
            ]);

            // 2. LÓGICA DEL PRIMER PAGO: Si hay monto, insertamos en la tabla de pagos
            if ($monto_depo > 0) {
                DB::table('pagos')->insert([
                    'reserva_id'       => $reserva_id,
                    'cliente_id'       => $datos['cliente_id'],
                    'user_id'          => $usuario_id,
                    'monto_depositado' => $monto_depo,
                    'fecha_pago'       => $datos['fecha_pago'] ?? $fecha_actual,
                    'metodo_pago'      => strtolower($datos['metodo_pago'] ?? 'efectivo')
                ]);
            }
            return $codigo_reserva;
        });
    }

    /**
     * Función privada para no repetir código de generación de IDs
     */
    private function generarCodigo()
    {
        return 'RES-' . strtoupper(substr(uniqid(), -6));
    }
}