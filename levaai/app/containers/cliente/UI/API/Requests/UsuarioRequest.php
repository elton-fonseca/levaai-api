<?php

namespace Cliente\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $regrasEmail = ['required', 'email'];

        if ($this->is('api/cliente')) {
            $regrasEmail[] = 'unique:Cliente\Models\Usuario,email';
        }
        
        return [
            'nome' => ['required'],
            'email' => $regrasEmail,
            'senha' => ['required'],
            'dispositivo' => ['required']
        ];
    }
}
