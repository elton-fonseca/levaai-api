<?php

namespace Cotacao\Tasks;

use Cotacao\Models\Bloco;

class CalculaPrecoPeso
{
    /**
     * Calcula o preço baseado no peso dos itens
     *
     * @param float $peso
     * @param Bloco $blocoDestino
     * @return float
     */
    public function executar(float $peso, Bloco $blocoDestino): float
    {
        if ($peso < $blocoDestino->p1_blo) {
            return (float) $blocoDestino->s1_blo;
        }

        if ($peso >= $blocoDestino->p1_blo && $peso < $blocoDestino->p2_blo) {
            return (float) $blocoDestino->s2_blo;
        }

        if ($peso >= $blocoDestino->p2_blo && $peso < $blocoDestino->p3_blo) {
            return (float) $blocoDestino->s3_blo;
        }

        if ($peso >= $blocoDestino->p3_blo && $peso < $blocoDestino->p4_blo) {
            return (float) $blocoDestino->s4_blo;
        }
        
        if ($peso >= $blocoDestino->p4_blo && $peso < $blocoDestino->p5_blo) {
            return (float) $blocoDestino->s5_blo;
        }

        return (float) $blocoDestino->s5_blo + $this->precoExcedente($peso, $blocoDestino->ek_blo);
    }

    /**
     * Calcula o preço quando excede o campo p5
     *
     * @param [type] $peso
     * @param [type] $custoPorKG
     * @return void
     */
    private function precoExcedente($peso, $custoPorKG)
    {
        $pesoExcedente = $peso - 100;
        $precoExcedente = $pesoExcedente * $custoPorKG;

        return $precoExcedente;
    }
}