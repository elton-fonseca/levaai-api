<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Cidade;

class VerificaCidadesPercurso
{
    /**
     * Verifica se ao menos uma das duas cidades é atendida pela Tadex
     *
     * @param Cidade $cidadeOrigem
     * @param Cidade $cidadeDestino
     * @return void
     */
    public function executar(Cidade $cidadeOrigem, Cidade $cidadeDestino): void
    {
        if ($cidadeOrigem->FILIAL_CID === 'N' || $cidadeDestino->FILIAL_CID === 'N') {
            throw CidadeException::percursoNaoAtendido();
        }

        if ($cidadeOrigem->FILIAL_CID === 'P' && $cidadeDestino->FILIAL_CID === 'P') {
            throw CidadeException::percursoNaoAtendido();
        }
    }
}