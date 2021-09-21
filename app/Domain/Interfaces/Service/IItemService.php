<?php

namespace App\Domain\Interfaces\Service;

use App\Models\Item;

interface IItemService
{
    /**
     * @param array $dados
     * @return Item|null
     */
    function inserir(array $dados): ?Item;

    /**
     * @param int $id
     * @param array $dados
     */
    function atualizar(int $id, array $dados): void;

    /**
     * @param int $id
     * @return bool
     */
    function desativar(int $id): bool;

    /**
     * @param int $id
     * @return bool
     */
    function reativar(int $id): bool;
}
