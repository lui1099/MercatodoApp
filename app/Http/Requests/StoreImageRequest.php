<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use MongoDB\Driver\Session;

class StoreImageRequest extends FormRequest
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
            'picture1' => 'mimes:jpeg,bmp,png,jpg|max:1000',
            'picture2' => 'mimes:jpeg,bmp,png,jpg|max:1000',
            'picture3' => 'mimes:jpeg,bmp,png,jpg|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'picture1.mimes' => "Los formatos de archivos soportados son .jpg, .bmp, .png",
            'picture1.max' => "Peso de imagen maximo 1MB",

            'picture2.mimes' => "Los formatos de archivos soportados son .jpg, .bmp, .png",
            'picture2.max' => "Peso de imagen maximo 1MB",

            'picture3.mimes' => "Los formatos de archivos soportados son .jpg, .bmp, .png",
            'picture3.max' => "Peso de imagen maximo 1MB",
        ];
    }

    /**
     * Get the session associated with the request.
     *
     * @return \Illuminate\Session\Store|null
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the session instance on the request.
     *
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @return void
     */
    public function setLaravelSession($session)
    {
        $this->session = $session;

        $this->session()->reflash();

    }




}
