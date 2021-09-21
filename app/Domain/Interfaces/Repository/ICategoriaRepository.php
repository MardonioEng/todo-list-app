<?php

namespace App\Domain\Interfaces\Repository;

use App\Models\Categoria;
use Illuminate\Support\Collection;

interface ICategoriaRepository
{
    /**
     * @param array $dados
     * @return Collection
     */
    function buscar(array $dados): Collection;

    /**
     * @param int $id
     * @return Categoria|null
     */
    function buscarPorId(int $id): ?Categoria;

    /**
     * @param array $dados
     * @return Categoria
     */
    function inserir(array $dados): Categoria;

    /**
     * @param int $id
     * @param array $dados
     * @return bool
     */
    function atualizar(int $id, array $dados): bool;

    /**
     * @param int $id
     * @return bool|null
     */
    function desativar(int $id): ?bool;

    /**
     * @param int $id
     * @return bool|null
     */
    function reativar(int $id): ?bool;
}
