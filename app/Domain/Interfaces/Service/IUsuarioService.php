<?php

namespace App\Domain\Interfaces\Service;

use App\Models\Usuario;

interface IUsuarioService
{
    /**
     * @param array $dados
     * @return Usuario|null
     */
    function inserir(array $dados): ?Usuario;

    /**
     * @param int $id
     * @param array $dados
     */
    function atualizar(int $id, array $dados): void;
}
