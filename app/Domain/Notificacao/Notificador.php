<?php

namespace App\Domain\Notificacao;

use App\Domain\Interfaces\INotificador;
use Ramsey\Collection\Collection;

class Notificador implements INotificador
{
    private Collection $mensagens;

    public function __construct()
    {
        $this->mensagens = new Collection(Notificacao::class);
    }

    /**
     * @inheritDoc
     */
    function notificar(Notificacao $mensagem): void
    {
        $this->mensagens->add($mensagem);
    }

    /**
     * @inheritDoc
     */
    function obterNotificacoes(): array
    {
        return $this->mensagens->toArray();
    }

    /**
     * @inheritDoc
     */
    function temNotificacao(): bool
    {
        return !$this->mensagens->isEmpty();
    }
}
