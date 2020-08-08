<?php

namespace Ship\Services\Cep\Providers;

use Illuminate\Support\Facades\Http;
use Ship\Services\Cep\CepService;
use Ship\Services\Cep\Exceptions\CepException;

class WebManiaProvider implements CepService
{
    /**
     * Token da api
     *
     * @var string
     */
    private $token;

    /**
     * URL da API
     *
     * @var string
     */
    private $url;

    /**
     * Recebe os dados de acesso da API
     *
     * @param string $token
     * @param string $url
     */
    public function __construct(string $token, string $url)
    {
        $this->token = $token;
        $this->url = $url;
    }

    /**
     * Consulta o cep via api webmania
     *
     * @param string $cep
     * @return integer
     */
    public function consultar(string $cep): array
    {
        $response = Http::get($this->url($cep));

        $resultado = $response->json();

        if (isset($resultado['error'])) {
            throw CepException::cepNaoEncontrado();
        }
       
        return $response->json();
    }

    /**
     * monta URL para consulta
     *
     * @param string $cep
     * @return string
     */
    private function url(string $cep): string
    {
        return \sprintf('%s/1/cep/%s/?app_key=%s', $this->url, $cep, $this->token);
    }
}