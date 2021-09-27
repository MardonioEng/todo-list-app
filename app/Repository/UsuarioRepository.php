<?php

namespace App\Repository;

use App\Models\Usuario;
use Illuminate\Support\Collection;
use \App\Domain\Interfaces\Repository\IUsuarioRepository;

class UsuarioRepository implements IUsuarioRepository
{

    /**
     * @inheritDoc
     */
    function buscar(array $dados): Collection
    {
        $query = Usuario::query();

        return $query->get();
    }

    /**
     * @inheritDoc
     */
    function buscarPorId(int $id): ?Usuario
    {
        return Usuario::find($id);
    }

    /**
     * @inheritDoc
     */
    function inserir(array $dados): Usuario
    {
        return Usuario::create($dados);
    }

    /**
     * @inheritDoc
     */
    function atualizar(int $id, array $dados): bool
    {
        return Usuario::where('id', $id)->update($dados);
    }
}
