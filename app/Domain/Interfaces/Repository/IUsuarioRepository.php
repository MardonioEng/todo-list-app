<?php

namespace App\Domain\Interfaces\Repository;

use App\Models\Usuario;
use Illuminate\Support\Collection;

interface IUsuarioRepository
{
    /**
     * @param array $dados
     * @return Collection
     */
    function buscar(array $dados): Collection;

    /**
     * @param int $id
     * @return Usuario|null
     */
    function buscarPorId(int $id): ?Usuario;

    /**
     * @param array $dados
     * @return Usuario
     */
    function inserir(array $dados): Usuario;

    /**
     * @param int $id
     * @param array $dados
     * @return bool
     */
    function atualizar(int $id, array $dados): bool;
}
