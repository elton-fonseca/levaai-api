<?php

namespace Cotacao\UI\API\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotacaoRequest extends FormRequest
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
            'valor_total' => ['required', 'numeric', 'min:0'],
            'peso_total' => ['required', 'numeric', 'min:0'],
            'itens' => ['required', 'array'],
            'itens.*.quantidade' => ['required', 'numeric', 'min:0'],
            'itens.*.altura' => ['required', 'integer', 'min:0'],
            'itens.*.largura' => ['required', 'integer', 'min:0'],
            'itens.*.comprimento' => ['required', 'integer', 'min:0'],
        ];
    }
}
