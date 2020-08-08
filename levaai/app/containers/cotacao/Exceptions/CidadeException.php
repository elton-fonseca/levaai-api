<?php

namespace Cotacao\Exceptions;

use Exception;

class CidadeException extends Exception
{
    public static function percursoNaoAtendido(): self
    {
        return new self("O percurso ainda não é atendido");
    }
}
