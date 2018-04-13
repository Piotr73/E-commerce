<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    protected $table = 't_categoria';
    protected $primaryKey = 'ID_Categoria';

    protected $fillable = [
    	'ID_General',
    	'ID_Nivel',
    	'ID_Nivel2',
        'Nombre',
        'Descripcion'
    ];
}
