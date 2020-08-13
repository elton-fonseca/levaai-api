<?php

namespace Ship\Services\Cep\Exceptions;

use Illuminate\Validation\ValidationException;

class CepException
{
    public static function cepNaoEncontrado(): ValidationException
    {
        return ValidationException::withMessages(['cep' => 'O Cep não foi encontrado em nosso sistema']);
    }
}
