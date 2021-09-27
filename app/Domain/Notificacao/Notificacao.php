<?php

namespace App\Domain\Notificacao;

class Notificacao
{
    public $mensagem;

    public function __construct(string $mensagem)
    {
        $this->mensagem = $mensagem;
    }
}
