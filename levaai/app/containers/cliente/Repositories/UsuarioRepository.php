<?php

namespace Cliente\Repositories;

use Cliente\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Ship\Base\Repository\EloquentRepository;

class UsuarioRepository extends EloquentRepository
{
    /**
     * Propriedade que defini o model
     */
    protected $model;

    /**
     * Inicializa o repositório com o model
     *
     * @param Usuario $usuario
     */
    public function __construct(Usuario $usuario)
    {
        $this->model = $usuario;
    }

    /**
     * Cria um usuário apartir dos dados
     *
     * @param array $dados
     * @return Usuario
     */
    public function criar(array $dados): Usuario
    {
        $usuario = new Usuario;
        $usuario->name = $dados['nome'];
        $usuario->email = $dados['email'];
        $usuario->password = Hash::make($dados['senha']);

        $usuario->save();

        return $usuario;
    }
    
    /**
     * Busca usuário por email
     *
     * @param string $email
     * @return Usuario
     */
    public function buscarPeloEmail(string $email): ?Usuario
    {
        return Usuario::where('email', $email)->first();
    }
}
