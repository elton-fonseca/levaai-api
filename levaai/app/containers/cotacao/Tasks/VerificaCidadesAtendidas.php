<?php

namespace Cotacao\Tasks;

use Cotacao\Repositories\CidadeRepository;

class BuscaBlocos
{
    private BlocoRepository $blocoRepository;

    private CidadeRepository $cidadeRepository;

    public function __construct(
        BlocoRepository $blocoRepository,
        CidadeRepository $cidadeRepository
    )
    {
        $this->blocoRepository = $blocoRepository;
        $this->cidadeRepository = $cidadeRepository;
    }

    public function executar(): void
    {
        $cidadeOrigem = $this->cidadeRepository->buscaPorCodigoMunicipio($cepOrigem);
        $cidadeDestino = $this->cidadeRepository->buscaPorCodigoMunicipio($cepDestino);

        $atendeCidadeOrigem = '';
        
    }
}