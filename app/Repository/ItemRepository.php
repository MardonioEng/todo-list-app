<?php

namespace App\Repository;

use App\Domain\Interfaces\Repository\IItemRepository;
use App\Models\Item;
use Illuminate\Support\Collection;

class ItemRepository implements IItemRepository
{
    /**
     * @param array $dados
     * @return Collection
     */
    function buscar(array $dados): Collection
    {
        $query = Item::query();

        return $query->get();
    }

    /**
     * @param int $id
     * @return Item|null
     */
    function buscarPorId(int $id): ?Item
    {
        return Item::withTrashed()->find($id);
    }

    /**
     * @param array $dados
     * @return Item
     */
    function inserir(array $dados): Item
    {
        return Item::create($dados);
    }

    /**
     * @param int $id
     * @param array $dados
     * @return bool
     */
    function atualizar(int $id, array $dados): bool
    {
        return Item::where('id', $id)->update($dados);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    function desativar(int $id): ?bool
    {
        $item = $this->buscarPorId($id);
        return $item->trashed();
    }

    /**
     * @param int $id
     * @return bool|null
     */
    function reativar(int $id): ?bool
    {
        $item = $this->buscarPorId($id);
        return $item->restore();
    }
}
