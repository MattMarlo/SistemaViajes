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
        $codigo_reserva = $this->generarCodigo();
        $fecha_actual = now()->format('Y-m-d H:i:s');

        return DB::transaction(function () use ($datos, $usuario_id, $codigo_reserva, $fecha_actual) {
            
            // Determinar el estado inicial del pago
            $estado_pago = (!empty($datos['monto_depositado']) && $datos['monto_depositado'] > 0) 
                            ? 'parcial' 
                            : 'pendiente';

            // 1. Insertar la reserva
            $reserva_id = DB::table('reservas')->insertGetId([
                'codigo_reserva'     => $codigo_reserva,
                'cliente_id'         => $datos['cliente_id'],
                'destino_id'         => $datos['destino_id'],
                'user_id'            => $usuario_id,
                'tipo'               => 'individual',
                'fecha_viaje'        => $datos['fecha_viaje'],
                'precio_total_viaje' => $datos['precio_total_viaje'],
                'estado'             => 'pendiente',
                'estado_pago'        => $estado_pago, // Lo ponemos en parcial si pagó algo
                'created_at'         => $fecha_actual,
                'updated_at'         => $fecha_actual
            ]);

            // 2. LÓGICA DEL PRIMER PAGO: Si el usuario llenó el monto, lo guardamos
            if (!empty($datos['monto_depositado']) && $datos['monto_depositado'] > 0) {
                DB::table('pagos')->insert([
                    'reserva_id' => $reserva_id,
                    'cliente_id' => $datos['cliente_id'],
                    'user_id'    => $usuario_id,
                    'monto'      => $datos['monto_depositado'],
                    'metodo'     => $datos['metodo_pago'] ?? 'Efectivo',
                    'fecha_pago' => $fecha_actual,
                    'created_at' => $fecha_actual,
                    'updated_at' => $fecha_actual
                ]);

                // Si el monto depositado es igual o mayor al total, marcar como completado
                if ($datos['monto_depositado'] >= $datos['precio_total_viaje']) {
                    DB::table('reservas')->where('id', $reserva_id)->update(['estado_pago' => 'pagado']);
                }
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