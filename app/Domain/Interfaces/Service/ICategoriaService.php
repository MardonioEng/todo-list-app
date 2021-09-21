<?php

namespace App\Domain\Interfaces\Service;

use App\Models\Categoria;

interface ICategoriaService
{
    /**
     * @param array $dados
     * @return Categoria|null
     */
    function inserir(array $dados): ?Categoria;

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
