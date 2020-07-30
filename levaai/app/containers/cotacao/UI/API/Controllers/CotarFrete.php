<?php

namespace Cotacao\UI\API\Controllers;

use Cotacao\Actions\CotaFrete;


class CotarFrete
{
    private CotaFrete $cotaFreteActio;

    public function __construct(
        CotaFrete $cotaFreteActio
    )
    {
        $this->cotaFreteActio = $cotaFreteActio;
    }

    public function __invoke()
    {
        return 'cccc';
    }
}