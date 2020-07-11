<?php

namespace Cliente\Actions;

use Cliente\Tasks\GerarToken;
use Cliente\Tasks\CadastraUsuario;
use App\ship\Contracts\ActionInterface;

class CadastraCliente
{
    /**
     * Propriedade da task cadastrar usuario
     */
    private CadastraUsuario $cadastraUsuarioTask;

    /**
     * Propriedade da task gerar token
     */
    protected GerarToken $gerarTokenTask;

    /**
     * @param CadastraUsuario $cadastraUsuarioTask
     */
    public function __construct(CadastraUsuario $cadastraUsuarioTask, GerarToken $gerarTokenTask)
    {
        $this->cadastraUsuarioTask = $cadastraUsuarioTask;
        $this->gerarTokenTask = $gerarTokenTask;
    }

    /**
     * Executa o cadastro do usuario
     *
     * @param array $dados
     * @return void
     */
    public function executar(array $dados): array
    {
        $usuario = $this->cadastraUsuarioTask->executar($dados);

        $token = $this->gerarTokenTask->executar($usuario, $dados['dispositivo']);

        return \compact('token');
    }
}
