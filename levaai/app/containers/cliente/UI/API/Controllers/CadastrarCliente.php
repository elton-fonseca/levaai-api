<?php

namespace Cliente\UI\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ship\Http\Controllers\Controller;
use Cliente\UI\API\Requests\UsuarioRequest;
use Cliente\Actions\CadastraCliente;

class CadastrarCliente extends Controller
{
    public function __invoke(
        UsuarioRequest $request, 
        CadastraCliente $cadastraClienteTask
    ) : Response
    {
        $resposta = $cadastraClienteTask->executar(
            $request->all()
        );

        return response($resposta);
    }

}
