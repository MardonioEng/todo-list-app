<?php

namespace App\Http\Controllers;

use App\Domain\Interfaces\INotificador;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected INotificador $notificador;

    public function __construct(INotificador $notificador)
    {
        $this->notificador = $notificador;
    }
}
