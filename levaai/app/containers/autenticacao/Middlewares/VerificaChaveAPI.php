<?php
declare(strict_types=1);

namespace Autenticacao\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


final class VerificaChaveAPI
{
    public function handle(Request $request, Closure $next) : Response
    {
        $tokenValido = \config('api.mobile.token');
        $tokenRecebido = $request->header('Api-token');

        if ($tokenValido !== $tokenRecebido) {
            throw new AccessDeniedHttpException("chave-api-invalida");
        }

        return $next($request);
    }
}