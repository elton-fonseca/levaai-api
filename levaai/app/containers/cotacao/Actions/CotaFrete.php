<?php

namespace Cotacao\Actions;

use Cotacao\Tasks\BuscaBlocos;
use Cotacao\Tasks\CalculaPeso;
use Cotacao\Tasks\CalculaPrecoPeso;
use Cotacao\Tasks\CalculaPrecoAdvaloremEGris;
use Cotacao\Tasks\CalculaDificilAcesso;
use Cotacao\Tasks\CalculaDespachoEColeta;
use Cotacao\Tasks\CalculaPedagio;
use Illuminate\Http\Request;

class CotaFrete
{
    private BuscaBlocos $buscaBlocosTask;
    private CalculaPeso $calculaPesoTask;
    private CalculaPrecoPeso $calculaPrecoPesoTask;
    private CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask;
    private CalculaDificilAcesso $calculaDificilAcessoTask;
    private CalculaDespachoEColeta $calculaDespachoEColetaTask;
    private CalculaPedagio $calculaPedagioTask;


    public function __construct(
        BuscaBlocos $buscaBlocosTask,
        CalculaPeso $calculaPesoTask,
        CalculaPrecoPeso $calculaPrecoPesoTask,
        CalculaPrecoAdvaloremEGris $calculaPrecoAdvaloremEGrisTask,
        CalculaDificilAcesso $calculaDificilAcessoTask,
        CalculaDespachoEColeta $calculaDespachoEColetaTask,
        CalculaPedagio $calculaPedagioTask
    )
    {
        $this->buscaBlocosTask = $buscaBlocosTask;
        $this->calculaPesoTask = $calculaPesoTask;
        $this->calculaPrecoPesoTask = $calculaPrecoPesoTask;
        $this->calculaPrecoAdvaloremEGrisTask = $calculaPrecoAdvaloremEGrisTask;
        $this->calculaDificilAcessoTask = $calculaDificilAcessoTask;
        $this->calculaDespachoEColetaTask = $calculaDespachoEColetaTask;
        $this->calculaPedagioTask = $calculaPedagioTask;
    }

    public function executar(Request $request)
    {
        var_dump($request->all());

        $blocoDestino = $this->buscaBlocosTask->executar($request->cep_destino);  

        $peso = $this->calculaPesoTask->executar($request->itens, $request->peso_total);
        $precoPeso = $this->calculaPrecoPesoTask->executar($peso, $blocoDestino);

        $adValoremEGris = $this->calculaPrecoAdvaloremEGrisTask->executar($request->valor_total, $blocoDestino);

        dd($peso, $blocoDestino, $precoPeso, $adValoremEGris);

        $this->calculaDificilAcessoTask->executar();
        $this->calculaDespachoEColetaTask->executar();
        $this->calculaPedagioTask->executar();
    }
}