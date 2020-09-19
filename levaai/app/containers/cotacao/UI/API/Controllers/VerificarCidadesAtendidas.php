<?php

namespace Cotacao\UI\API\Controllers;


use Cotacao\Actions\VerificaCidadesAtendidas;
use Cotacao\UI\API\Requests\CidadesAtendidasRequest;

class VerificarCidadesAtendidas
{
    private VerificaCidadesAtendidas $verificaCidadesAtendidasAction;

    public function __construct(
        VerificaCidadesAtendidas $verificaCidadesAtendidasAction
    )
    {
        $this->verificaCidadesAtendidasAction = $verificaCidadesAtendidasAction;
    }

    public function __invoke(CidadesAtendidasRequest $request)
    {
        return [
            'atendida' => $this->verificaCidadesAtendidasAction->executar($request)
        ];
    }
}