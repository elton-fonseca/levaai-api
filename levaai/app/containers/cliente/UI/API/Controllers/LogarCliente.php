<?php

namespace Cliente\UI\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ship\Http\Controllers\Controller;
use Cliente\UI\API\Requests\UsuarioRequest;

class LogarCliente extends Controller
{
    public function __invoke(UsuarioRequest $request): Response
    {
        return \response('aaaa');
    }

}
