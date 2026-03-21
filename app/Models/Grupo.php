<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $fillable = [
        'nombre_grupo',
        'descripcion'
    ];
    public function clientes(){
        return $this->belongsToMany(Cliente::class, 'grupo_cliente')
                    ->withPivot('monto_asignado', 'es_lider');
    }

    public function reservas(){
        return $this->hasMany(Reserva::class, 'grupo_id');
    }
}
