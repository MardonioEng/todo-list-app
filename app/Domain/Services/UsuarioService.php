<?php

namespace App\Domain\Services;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Interfaces\INotificador;
use App\Domain\Interfaces\Repository\IUsuarioRepository;
use App\Models\Usuario;
use \App\Domain\Interfaces\Service\IUsuarioService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        Validator::make($dados, [
            'nome' => 'required|min:2|max:80|regex:/^[ ]*(.+[ ]+)+.+[ ]*$/i',
            'email' => 'required|unique:usuarios',
            'senha' => 'required:min:6'
        ])->validate();


        $dados["senha"] = Hash::make($dados["senha"]);
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
            'nome' => 'required|min:2|max:80|regex:/^[ ]*(.+[ ]+)+.+[ ]*$/i',
            'email' => [
                'required',
                Rule::unique('usuarios')->ignore($usuario->id)
            ]
        ]);

        if($validated->fails()) {
            throw new ValidationException($validated->getMessageBag()->getMessages());
        }

        if(!$this->usuarioRepository->atualizar($id, $dados)) {
            throw new \Exception("Não foi possível atualizar!");
        }
    }

    function alterarSenha(int $id, array $dados): void
    {
        $validated = Validator::make($dados, [
            'senha' => 'required',
            'novaSenha' => 'required|min:6'
        ]);

        if($validated->fails()) {
            throw new ValidationException($validated->getMessageBag()->getMessages());
        }

        $usuario = $this->usuarioRepository->buscarPorId($id);
        if(!Hash::check($dados["senha"], $usuario->senha)) {
            throw new ValidationException(["Senha inválida!"]);
        }

        $senha = Hash::make($dados["novaSenha"]);
        if(!$this->usuarioRepository->atualizar($id, ["senha" => $senha])) {
            throw new \Exception("Não foi possível alterar a senha!");
        }
    }
}
