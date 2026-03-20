<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    
    protected $table = 'clientes';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'documento',
        'estado',
    ];
    //public function reservas(){
        //return $this->hasMany(Reserva::Class,'cliente_id');
    //}
}
