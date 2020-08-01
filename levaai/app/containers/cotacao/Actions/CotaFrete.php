<?php

namespace Cotacao\Actions;

use Cotacao\Tasks\BuscaBlocos;
use Cotacao\Tasks\CalculaPeso;
use Cotacao\Tasks\CalculaPrecoPeso;
use Cotacao\Tasks\CalculaPrecoAdvaloremEGris;
use Cotacao\Tasks\CalculaDificilAcesso;
use Cotacao\Tasks\CalculaColeta;
use Cotacao\Tasks\CalculaPedagio;
use Illuminate\Http\Request;

class CotaFrete
{
    private BuscaBlocos $buscaBlocosTask;
    private CalculaPeso $calculaPesoTask;
    private CalculaPrecoPeso $calculaPrecoPesoTask;
    private CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask;
    private CalculaDificilAcesso $calculaDificilAcessoTask;
    private CalculaPedagio $calculaPedagioTask;


    public function __construct(
        BuscaBlocos $buscaBlocosTask,
        CalculaPeso $calculaPesoTask,
        CalculaPrecoPeso $calculaPrecoPesoTask,
        CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask,
        CalculaDificilAcesso $calculaDificilAcessoTask,
        CalculaColeta $calculaColetaTask,
        CalculaPedagio $calculaPedagioTask
    )
    {
        $this->buscaBlocosTask = $buscaBlocosTask;
        $this->calculaPesoTask = $calculaPesoTask;
        $this->calculaPrecoPesoTask = $calculaPrecoPesoTask;
        $this->calculaPrecoAdvaloremEGrisTask = $calculaPrecoAdvaloremEGrisTask;
        $this->calculaDificilAcessoTask = $calculaDificilAcessoTask;
        $this->calculaColetaTask = $calculaColetaTask;
        $this->calculaPedagioTask = $calculaPedagioTask;
    }

    public function executar(Request $request)
    {
        $blocoOrigem = $this->buscaBlocosTask->executar($request->cep_origem); 
        $coleta = (float) $blocoOrigem->coleta_blo; 

        $blocoDestino = $this->buscaBlocosTask->executar($request->cep_destino);  

        $peso = $this->calculaPesoTask->executar($request->itens, $request->peso_total);
        $precoPeso = $this->calculaPrecoPesoTask->executar($peso, $blocoDestino);

        $taxaEntrega = (float) $blocoDestino->minima_blo;
        $despacho = (float) $blocoDestino->d_blo;

        $adValoremEGris = $this->calculaPrecoAdvaloremEGrisTask->executar($request->valor_total, $blocoDestino);
        $pedagio = $this->calculaPedagioTask->executar($peso, $blocoDestino);

        $total = $precoPeso + $adValoremEGris + $pedagio + $taxaEntrega + $despacho + $coleta;

        dd($total);
        //dd($peso, $blocoDestino, $precoPeso, $adValoremEGris, $pedagio, $taxaEntrega, $despacho, $coleta);

        $this->calculaDificilAcessoTask->executar();
    }
}