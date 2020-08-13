<?php

namespace Cotacao\Exceptions;

use Illuminate\Validation\ValidationException;

class CidadeException 
{
    /**
     * Quando uma ou as duas cidades não são atendidas
     *
     * @return self
     */
    public static function percursoNaoAtendido(): ValidationException
    {
        return ValidationException::withMessages(['cep' => 'O percurso ainda não é atendido']);
        
    }
}
