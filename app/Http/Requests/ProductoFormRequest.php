<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nombre'=>'required|max:100',
            'PU_Venta' => 'required',
            'PU_Compra' => 'required',
            'Stock' => 'required',
            'Stock_Min' => 'required',
            'Descripcion' => 'required',
            'Ruta_Imagen'=>'required',
            'ID_Marca' => 'required',
            'ID_Categoria' => 'required',
            'ID_Modelo' => 'required',
            'iduser'=>'required'
        ];
    }
}
