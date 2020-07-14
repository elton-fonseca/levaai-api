<?php

namespace Cliente\Tasks;

use Cliente\Models\Usuario;
use Cliente\Repositories\UsuarioRepository;

class CadastraUsuario
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

    public function executar(array $dados) : Usuario
    {
        return $this->usuarioRepository->criar($dados);
    }
    
}
