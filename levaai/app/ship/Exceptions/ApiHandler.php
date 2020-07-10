<?php

namespace Ship\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait ApiHandler {

    /**
     * Trata Exceções da API
     *
     * @param Request $request
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function getJsonException(Request $request, \Throwable $e): JsonResponse
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->notFoundException();
        }

        if ($e instanceof HttpException) {
         return $this->httpException($e);
        }

        if ($e instanceof ValidationException) {
          return $this->validationException($e);
        }

         return $this->genericException();
    }

    /**
     * Retornar o erro 404
     *
     * @return JsonResponse
     */
    protected function notFoundException(): JsonResponse
    {
        return $this->getResponse(
            "Recurso não encontrado",
            "01",
            404
        );
    }

    /**
     * Retornar o erro 500
     *
     * @return JsonResponse
     */
    protected function genericException(): JsonResponse
    {
        return $this->getResponse(
            "Erro interno no servidor",
            "02",
            500
        );
    }

    
    /**
     * Retornar o erro de validação
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function validationException(\Throwable $e): JsonResponse
    {
        return response()->json($e->errors(), $e->status);
    }

    /**
     * Retornar o erro de http
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function httpException(\Throwable $e): JsonResponse
    {
        return $this->getResponse(
            $e->getMessage(),
            'http-error',
            $e->getStatusCode()
        );
    }

    
    /**
     * Cria a resposta com base nos dados passados
     *
     * @param string $message
     * @param integer $code
     * @param string $status
     * @return JsonResponse
     */
    protected function getResponse(string $message, string $code, int $status): JsonResponse
    {
        return response()->json([
            "errors" => [
                [
                    "status" => $status,
                    "code" => $code,
                    "message" => $message
                ]
            ]
        ], $status);
    }

}