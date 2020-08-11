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
            'cep_origem' => ['required'],
            'cep_destino' => ['required'],
            'valor_total' => ['required'],
            'peso_total' => ['required'],
            'itens' => ['required', 'array'],
            'itens.*.quantidade' => ['required'],
            'itens.*.altura' => ['required'],
            'itens.*.largura' => ['required'],
            'itens.*.comprimento' => ['required'],
        ];
    }
}
