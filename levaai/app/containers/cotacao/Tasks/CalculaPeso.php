<?php

namespace Cotacao\Tasks;

class CalculaPeso
{
    public function executar(array $itens, float $peso): float
    {
        $pesoCubado = 0;
        foreach ($itens as $item) {
            $pesoCubado += $item['altura'] * $item['largura'] * $item['comprimento'];
            $pesoCubado *= $item['quantidade'];
        }

        $pesoCubado = $pesoCubado / 100;
        $pesoCubado = $pesoCubado * 300;
        $pesoCubado = $pesoCubado / 10000;

        return ($pesoCubado > $peso) ? $pesoCubado : $peso;
    }
}