<?php

namespace Cliente\Actions;

use Cliente\Tasks\GeraToken;
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
    protected GeraToken $geraTokenTask;

    /**
     * @param CadastraUsuario $cadastraUsuarioTask
     */
    public function __construct(CadastraUsuario $cadastraUsuarioTask, GeraToken $geraTokenTask)
    {
        $this->cadastraUsuarioTask = $cadastraUsuarioTask;
        $this->geraTokenTask = $geraTokenTask;
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

        $token = $this->geraTokenTask->executar($usuario, $dados['dispositivo']);

        return \compact('token');
    }
}
