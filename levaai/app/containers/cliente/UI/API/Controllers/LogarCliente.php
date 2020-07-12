<?php

namespace Cliente\UI\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cliente\Actions\LogaUsuario;
use Ship\Http\Controllers\Controller;
use Cliente\UI\API\Requests\UsuarioRequest;

class LogarCliente extends Controller
{
    public function __invoke(
        UsuarioRequest $request,
        LogaUsuario $logaUsuarioAction
    ): Response
    {
        $resposta = $logaUsuarioAction->executar(
            $request->all()
        );

        return response($resposta);
    }

}
