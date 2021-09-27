<?php

namespace App\Domain\Services;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Interfaces\INotificador;
use App\Domain\Interfaces\Repository\ICategoriaRepository;
use App\Domain\Notificacao\Notificacao;
use App\Models\Categoria;
use \App\Domain\Interfaces\Service\ICategoriaService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class CategoriaService implements ICategoriaService
{

    private ICategoriaRepository $categoriaRepository;
    private INotificador $notificador;

    public function __construct(ICategoriaRepository $categoriaRepository, INotificador $notificador)
    {
        $this->categoriaRepository = $categoriaRepository;
        $this->notificador = $notificador;
    }

    /**
     * @inheritDoc
     */
    function inserir(array $dados): ?Categoria
    {
        $validated = Validator::make($dados, [
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        if($validated->fails()) {
            foreach ($validated->getMessageBag()->getMessages() as $messages) {
                foreach ($messages as $item) {
                    $this->notificador->notificar(new Notificacao($item));
                }
            }
            return null;
        }

        return $this->categoriaRepository->inserir($dados);
    }

    /**
     * @inheritDoc
     */
    function atualizar(int $id, array $dados): void
    {
        $categoria = $this->categoriaRepository->buscarPorId($id);

        if($categoria == null) {
            throw new ModelNotFoundException();
        }

        $validated = Validator::make($dados, [
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        if($validated->fails()) {
            throw new ValidationException($validated->getMessageBag()->getMessages());
        }

        if(!$this->categoriaRepository->atualizar($id, $dados)) {
            throw new \Exception("Não foi possível atualizar!");
        }

    }

    /**
     * @inheritDoc
     */
    function desativar(int $id): bool
    {
        $categoria = $this->categoriaRepository->buscarPorId($id);

        if($categoria == null) {
            throw new ModelNotFoundException();
        }

        return $this->categoriaRepository->desativar($id);

    }

    /**
     * @inheritDoc
     */
    function reativar(int $id): bool
    {
        $categoria = $this->categoriaRepository->buscarPorId($id);

        if($categoria == null) {
            throw new ModelNotFoundException();
        }

        return $this->categoriaRepository->reativar($id);
    }
}
