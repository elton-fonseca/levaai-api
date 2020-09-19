<?php

namespace Cotacao\Actions;

use Cotacao\Models\Cidade;
use Illuminate\Http\Request;
use Cotacao\Tasks\BuscaCidade;
use Cotacao\Tasks\CalculaPeso;
use Cotacao\Tasks\CalculaPedagio;
use Cotacao\Tasks\CalculaPrecoPeso;
use Cotacao\Exceptions\CidadeException;
use Cotacao\Repositories\BlocoRepository;
use Cotacao\Tasks\VerificaCidadesPercurso;
use Cotacao\Tasks\CalculaPrecoAdvaloremEGris;


class CotaFrete
{
    private BuscaCidade $buscaCidadeTask;
    private BlocoRepository $blocoRepository;
    private CalculaPeso $calculaPesoTask;
    private CalculaPrecoPeso $calculaPrecoPesoTask;
    private CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask;
    private CalculaPedagio $calculaPedagioTask;
    private VerificaCidadesPercurso $verificaCidadesPercursoTask;


    public function __construct(
        BuscaCidade $buscaCidadeTask,
        BlocoRepository $blocoRepository,
        CalculaPeso $calculaPesoTask,
        CalculaPrecoPeso $calculaPrecoPesoTask,
        CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask,
        CalculaPedagio $calculaPedagioTask,
        VerificaCidadesPercurso $verificaCidadesPercursoTask
    )
    {
        $this->buscaCidadeTask = $buscaCidadeTask;
        $this->blocoRepository = $blocoRepository;
        $this->calculaPesoTask = $calculaPesoTask;
        $this->calculaPrecoPesoTask = $calculaPrecoPesoTask;
        $this->calculaPrecoAdvaloremEGrisTask = $calculaPrecoAdvaloremEGrisTask;
        $this->calculaPedagioTask = $calculaPedagioTask;
        $this->verificaCidadesPercursoTask = $verificaCidadesPercursoTask;
    }

    /**
     * Verifica se o percurso é atendido e se retorna a cotação
     *
     * @param Request $request
     * @return float
     */
    public function executar(Request $request): float
    {
        $cidadeOrigem = $this->buscaCidadeTask->executar($request->cep_origem);
        $cidadeDestino = $this->buscaCidadeTask->executar($request->cep_destino);

        $this->verificaCidadesPercursoTask->executar($cidadeOrigem, $cidadeDestino);

        return $this->calculaBlocoOrigem($cidadeOrigem) + $this->calculaBlocoDestino($cidadeDestino, $request);
    }

    /**
     * Faz os calculos do bloco de origem
     *
     * @param Cidade $cidade
     * @return float
     */
    private function calculaBlocoOrigem(Cidade $cidade): float
    {
        $blocoOrigem = $this->blocoRepository->buscar($cidade->BLOCO_CID);  

        return (float) $blocoOrigem->coleta_blo; 
    }

    /**
     * Faz os calculos do bloco de destino
     *
     * @param Cidade $cidade
     * @return float
     */
    private function calculaBlocoDestino(Cidade $cidade, Request $request): float
    {
        $blocoDestino = $this->blocoRepository->buscar($cidade->BLOCO_CID);  

        $peso = $this->calculaPesoTask->executar($request->itens, $request->peso_total);
        $precoPeso = $this->calculaPrecoPesoTask->executar($peso, $blocoDestino);

        $taxaEntrega = (float) $blocoDestino->minima_blo;
        $despacho = (float) $blocoDestino->d_blo;

        $adValoremEGris = $this->calculaPrecoAdvaloremEGrisTask->executar($request->valor_total, $blocoDestino);
        $pedagio = $this->calculaPedagioTask->executar($peso, $blocoDestino);

        return $precoPeso + $taxaEntrega + $despacho + $adValoremEGris + $pedagio;
    }
}