<?php

namespace App\Domain\Interfaces;

use App\Domain\Notificacao\Notificacao;

interface INotificador
{
    /**
     * @param Notificacao $mensagem
     */
    function notificar(Notificacao $mensagem): void;

    /**
     * @return array
     */
    function obterNotificacoes(): array;

    /**
     * @return bool
     */
    function temNotificacao(): bool;
}
