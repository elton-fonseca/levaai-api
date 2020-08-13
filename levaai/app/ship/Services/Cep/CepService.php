<?php

namespace Ship\Services\Cep;

interface CepService
{
    public function consultar(string $cep): array;
}