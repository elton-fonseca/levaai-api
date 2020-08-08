<?php

namespace Cotacao\Exceptions;

use Exception;

class CidadeException extends Exception
{
    /**
     * Quando uma ou as duas cidades não são atendidas
     *
     * @return self
     */
    public static function percursoNaoAtendido(): self
    {
        return new self("O percurso ainda não é atendido");
    }
}
