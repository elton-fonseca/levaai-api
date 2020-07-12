<?php

namespace Cliente\Tasks;

use Cliente\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Cliente\Repositories\UsuarioRepository;
use Illuminate\Validation\ValidationException;

class VerificaUsuarioSenha
{
    /**
     * instancia do repositório
     */
    protected UsuarioRepository $usuarioRepository;

    /**
     * @param UsuarioRepository $usuarioRepository
     */
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    } 

    /**
     * Verifica se usuário e senha estão corretos
     *
     * @param array $dados
     * @return Usuario
     */
    public function executar(array $dados) : Usuario
    {
        $usuario = $this->usuarioRepository->buscarPeloEmail($dados['email']);

        if (! $usuario || ! Hash::check($dados['senha'], $usuario->password)) {
            throw ValidationException::withMessages([
                'email' => ['usuário ou senha invalidos'],
            ]);
        }

        return $usuario;
    }
    
}