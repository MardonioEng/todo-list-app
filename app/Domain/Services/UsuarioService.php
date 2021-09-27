<?php

namespace App\Domain\Services;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Interfaces\INotificador;
use App\Domain\Interfaces\Repository\IUsuarioRepository;
use App\Domain\Notificacao\Notificacao;
use App\Models\Usuario;
use \App\Domain\Interfaces\Service\IUsuarioService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class UsuarioService implements IUsuarioService
{
    private IUsuarioRepository $usuarioRepository;
    private INotificador $notificador;

    public function __construct(IUsuarioRepository $usuarioRepository, INotificador $notificador)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->notificador = $notificador;
    }

    /**
     * @inheritDoc
     */
    function inserir(array $dados): ?Usuario
    {
        $validated = Validator::make($dados, [
            'nome' => 'required',
            'email' => 'required',
            'senha' => 'required'
        ]);

        if($validated->fails()) {
            foreach ($validated->getMessageBag()->getMessages() as $messages) {
                foreach ($messages as $item) {
                    $this->notificador->notificar(new Notificacao($item));
                }
            }
            return null;
        }

        return $this->usuarioRepository->inserir($dados);

    }

    /**
     * @inheritDoc
     */
    function atualizar(int $id, array $dados): void
    {
        $usuario = $this->usuarioRepository->buscarPorId($id);

        if($usuario == null) {
            throw new ModelNotFoundException();
        }

        $validated = Validator::make($dados, [
            'nome' => 'required',
            'email' => 'required',
            'senha' => 'required'
        ]);

        if($validated->fails()) {
            throw new ValidationException($validated->getMessageBag()->getMessages());
        }

        if($this->usuarioRepository->atualizar($id, $dados)) {
            throw new \Exception("Não foi possível atualizar!");
        }
    }
}
