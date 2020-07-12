<?php

namespace Cliente\Actions;

use Cliente\Tasks\GeraToken;
use Cliente\Tasks\VerificaUsuarioSenha;

class LogaUsuario
{
    /**
     * task para verificar usuário e senha
     */
    protected VerificaUsuarioSenha $verificaUsuarioSenhaTask;

    protected GeraToken $geraTokenTask;

    /**
     * @param VerificaUsuarioSenha $verificaUsuarioSenhaTask
     */
    public function __construct(VerificaUsuarioSenha $verificaUsuarioSenhaTask, GeraToken $geraTokenTask)
    {
        $this->verificaUsuarioSenhaTask = $verificaUsuarioSenhaTask;
        $this->geraToken = $geraTokenTask;
    }

    /**
     * Loga usuário no sistema e retorna token
     *
     * @param iterable $dados
     * @return void
     */
    public function executar(iterable $dados)
    {
        $usuario = $this->verificaUsuarioSenhaTask->executar($dados);

        $token = $this->geraToken->executar($usuario, $dados['dispositivo']);

        return \compact('token');
    }
}
