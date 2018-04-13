<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoFoto extends Model
{
	protected $table = 't_producto_foto';
    protected $primaryKey = 'ID_Foto';
    protected $fillable = ['ID_Producto', 'Nombre','Nombre_Org'];
 
}
