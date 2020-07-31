<?php

namespace Ship\Base\Repository;

interface RepositoryInterface
{
    public function pegarTodos(int $page = 10);
    public function buscar($id);
    public function criar(array $dados);
    public function atualizar(int $id, array $dados);
    public function apagar(int $id);
}
