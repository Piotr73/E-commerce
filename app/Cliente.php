<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 't_persona';
    protected $primaryKey = 'ID_Persona';

    protected $fillable = [
        'DNI',
        'RUC',
        'Nombre',
        'Ap_Paterno',
        'Ap_Materno',
        'ID_Tipo'
    ];
}
