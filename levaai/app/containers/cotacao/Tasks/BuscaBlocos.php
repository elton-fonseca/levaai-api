<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Bloco;
use Cotacao\Repositories\BlocoRepository;
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

    public function executar(string $cep): ?Bloco
    {
        $cidade = $this->cidadeRepository->buscaPorCodigoMunicipio($cep);
        
        return $this->blocoRepository->buscar($cidade->BLOCO_CID);
    }
}