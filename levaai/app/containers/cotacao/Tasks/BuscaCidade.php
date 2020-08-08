<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Cidade;
use Ship\Services\Cep\CepService;
use Cotacao\Exceptions\CidadeException;
use Cotacao\Repositories\CidadeRepository;


class BuscaCidade
{
    private CidadeRepository $cidadeRepository;

    public function __construct(
        CidadeRepository $cidadeRepository,
        CepService $cepService
    )
    {
        $this->cidadeRepository = $cidadeRepository;
        $this->cepService = $cepService;
    }

    public function executar(string $cep): Cidade
    {
        $endereco = $this->cepService->consultar($cep);

        $cidade = $this->cidadeRepository->buscaPorCodigoMunicipio($endereco['ibge']);

        if (!$cidade) {
            throw CidadeException::percursoNaoAtendido();
        }

        return $cidade;
    }
}