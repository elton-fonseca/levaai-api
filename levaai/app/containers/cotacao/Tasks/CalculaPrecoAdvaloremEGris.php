<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Bloco;

class CalculaPrecoAdvaloremEGris
{
    public function executar(float $valorTotal, Bloco $blocoDestino)
    {
        $adValorem = ($valorTotal * $blocoDestino->av_blo) / 100;

        $gris = ($valorTotal * $blocoDestino->g_blo) / 100;

        $gris = ($gris > $blocoDestino->mg_blo) ? $gris : $blocoDestino->mg_blo;

        return (float) $adValorem + $gris;
    }
}