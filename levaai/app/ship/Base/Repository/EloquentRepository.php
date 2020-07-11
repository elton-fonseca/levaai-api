<?php

namespace Ship\Base\Repository;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * Instancia do model usado no repositório
     *
     * @var [type]
     */
    protected $model;

    /**
     * Retorna lista paginada
     *
     * @param integer $page
     * @return void
     */
    public function pegarTodos(int $page = 10)
    {
        return $this->model->paginate(10);
    }

    /**
     * Retorna registro por id
     *
     * @param integer $id
     * @return void
     */
    public function buscar(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Cria um registro pelo array de dados
     *
     * @param array $dados
     * @return void
     */
    public function criar(array $dados)
    {
        return $this->model->insert($dados);
    }

    /**
     * Atualiza um registro no banco
     *
     * @param integer $id
     * @param array $dados
     * @return void
     */
    public function atualizar(int $id, array $dados)
    {
        $instance = $this->model->find($id);

        if (!$instance) {
            return false;
        }

        return $instance->update($dados);
    }

    /**
     * Apaga um registro no banco
     *
     * @param integer $id
     * @return void
     */
    public function apagar(int $id)
    {
        $instance = $this->model->find($id);

        if (!$instance) {
            return false;
        }
    
        return $instance->delete();
    }
}
