<?php

namespace Cotacao\UI\API\Controllers;

use Cotacao\Actions\CotaFrete;
use Cotacao\UI\API\Requests\CotacaoRequest;

class CotarFrete
{
    private CotaFrete $cotaFreteAction;

    public function __construct(
        CotaFrete $cotaFreteAction
    )
    {
        $this->cotaFreteAction = $cotaFreteAction;
    }

    public function __invoke(CotacaoRequest $request)
    {
        return [
            'valor' => $this->cotaFreteAction->executar($request)
        ];
    }
}