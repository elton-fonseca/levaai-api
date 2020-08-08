<?php

namespace Cotacao\UI\API\Controllers;

use Cotacao\Actions\CotaFrete;
use Illuminate\Http\Request;

class CotarFrete
{
    private CotaFrete $cotaFreteAction;

    public function __construct(
        CotaFrete $cotaFreteAction
    )
    {
        $this->cotaFreteAction = $cotaFreteAction;
    }

    public function __invoke(Request $request)
    {
        return [
            'valor' => $this->cotaFreteAction->executar($request)
        ];
    }
}