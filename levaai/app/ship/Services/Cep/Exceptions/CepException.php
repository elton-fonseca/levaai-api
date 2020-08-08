<?php

namespace Ship\Services\Cep\Exceptions;

use Exception;

class CepException extends Exception
{
    public static function cepNaoEncontrado(): self
    {
        return new self("O Cep não foi encontrado em nosso sistema");
    }
}
