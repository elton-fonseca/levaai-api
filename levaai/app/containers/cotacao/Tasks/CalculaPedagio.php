<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Bloco;

class CalculaPedagio
{
    /**
     * Retorna o preço do pedágio pelo peso ou valor mínimo
     *
     * @param float $peso
     * @param Bloco $blocoDestino
     * @return float
     */
    public function executar(float $peso, Bloco $blocoDestino): float
    {
        $precoPedagio = ($peso / $blocoDestino->p_blo) * $blocoDestino->mp_blo;

        return ($blocoDestino->mp_blo > $precoPedagio) ? $blocoDestino->mp_blo : $precoPedagio;
    }
}