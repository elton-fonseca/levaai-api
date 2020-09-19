<?php

namespace Cotacao\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CidadesAtendidasRequest extends FormRequest
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
            'cep_origem' => ['required', 'regex:/^[0-9]{5}-[0-9]{3}$/'],
            'cep_destino' => ['required', 'regex:/^[0-9]{5}-[0-9]{3}$/'],
        ];
    }
}
