<?php

namespace Cotacao\Actions;

use Cotacao\Models\Cidade;
use Illuminate\Http\Request;
use Cotacao\Tasks\BuscaCidade;
use Cotacao\Tasks\CalculaPeso;
use Cotacao\Tasks\CalculaPrecoPeso;
use Cotacao\Exceptions\CidadeException;
use Cotacao\Repositories\BlocoRepository;
use Cotacao\Tasks\CalculaPrecoAdvaloremEGris;
use Cotacao\Tasks\VerificaCidadesPercurso;

class VerificaCidadesAtendidas
{
    private BuscaCidade $buscaCidadeTask;
    private VerificaCidadesPercurso $verificaCidadesPercursoTask;


    public function __construct(
        BuscaCidade $buscaCidadeTask,
        VerificaCidadesPercurso $verificaCidadesPercursoTask
    )
    {
        $this->buscaCidadeTask = $buscaCidadeTask;
        $this->VerificaCidadesPercursoTask = $verificaCidadesPercursoTask;
    }

    /**
     * Verifica se o percurso é atendido e se retorna a cotação
     *
     * @param Request $request
     * @return float
     */
    public function executar(Request $request): bool
    {
        $cidadeOrigem = $this->buscaCidadeTask->executar($request->cep_origem);
        $cidadeDestino = $this->buscaCidadeTask->executar($request->cep_destino);

        $this->VerificaCidadesPercursoTask->executar($cidadeOrigem, $cidadeDestino);

        return true;
    }



}