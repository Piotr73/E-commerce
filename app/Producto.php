<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table='t_producto';
    protected $primaryKey='ID_Producto';

    protected $fillable=[
        'Nombre',
        'PU_Venta',
        'PU_Compra',
        'Stock',
        'Stock_Min',
        'Descripcion',
        'Ruta_Imagen',
        'ID_Marca',
        'ID_Categoria',
        'ID_Modelo',
        'iduser'
    ];
}
