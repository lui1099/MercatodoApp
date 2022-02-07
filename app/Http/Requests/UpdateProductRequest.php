<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:50',
            'category' => 'required',
            'brand' => 'required|max:50',
            'description' => 'max:250',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El producto necesita un nombre!',
            'name.max' => 'Maximo numero de caracteres para nombre: 50',

            'category.required' => 'El producto necesita una categoria de la lista!',

            'brand.required' => 'El producto necesita una marca!',
            'brand.max' => 'Maximo numero de caracteres para marca: 50',

            'description.max' => 'Maximo numero de caracteres para descripcion: 200'

        ];
    }
}
