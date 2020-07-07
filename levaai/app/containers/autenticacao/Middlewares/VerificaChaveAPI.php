<?php

namespace Autenticacao\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


final class VerificaChaveAPI
{
    public function handle(Request $request, Closure $next) : Response
    {
        $tokenValido = \config('api.');
        $tokenRecebido = $request->header('Api-key');

        if ($this->tokenInvalido($tokenValido, $tokenRecebido)) {
            $excecao = new HttpForbidden('Chave de acesso inválida.');
            $excecao->withErrorCode('chave_invalida');

            throw new $excecao;
        }

        return $next($request);
    }

    private function tokenInvalido(string $tokenValido, string $tokenRecebido): bool
    {
        return \hash_equals($tokenValido, $tokenValido);
    }
}