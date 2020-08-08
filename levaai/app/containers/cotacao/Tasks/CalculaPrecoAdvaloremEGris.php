<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Bloco;

class CalculaPrecoAdvaloremEGris
{
    /**
     * Calcula o preço do AdValores e Gris
     *
     * @param float $valorTotal
     * @param Bloco $blocoDestino
     * @return float
     */
    public function executar(float $valorTotal, Bloco $blocoDestino): float
    {
        $adValorem = ($valorTotal * $blocoDestino->av_blo) / 100;

        $gris = ($valorTotal * $blocoDestino->g_blo) / 100;

        $gris = ($gris > $blocoDestino->mg_blo) ? $gris : $blocoDestino->mg_blo;

        return (float) $adValorem + $gris;
    }
}