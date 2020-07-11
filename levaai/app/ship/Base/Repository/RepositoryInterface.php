<?php

namespace Ship\Base\Repository;

interface RepositoryInterface
{
    public function pegarTodos(int $page);
    public function buscar(int $id);
    public function criar(array $dados);
    public function atualizar(int $id, array $dados);
    public function apagar(int $id);
}
