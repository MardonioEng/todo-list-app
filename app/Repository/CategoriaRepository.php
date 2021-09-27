<?php

namespace App\Repository;

use App\Models\Categoria;
use Illuminate\Support\Collection;
use \App\Domain\Interfaces\Repository\ICategoriaRepository;

class CategoriaRepository implements ICategoriaRepository
{

    /**
     * @inheritDoc
     */
    function buscar(array $dados): Collection
    {
        $query = Categoria::query();

        return $query->get();
    }

    /**
     * @inheritDoc
     */
    function buscarPorId(int $id): ?Categoria
    {
        return Categoria::withTrashed()->find($id);
    }

    /**
     * @inheritDoc
     */
    function inserir(array $dados): Categoria
    {
        return Categoria::create($dados);
    }

    /**
     * @inheritDoc
     */
    function atualizar(int $id, array $dados): bool
    {
        return Categoria::where('id', $id)->update($dados);
    }

    /**
     * @inheritDoc
     */
    function desativar(int $id): ?bool
    {
        $categoria = $this->buscarPorId($id);
        return $categoria->trashed();
    }

    /**
     * @inheritDoc
     */
    function reativar(int $id): ?bool
    {
        $categoria = $this->buscarPorId($id);
        return $categoria->restore();
    }
}
