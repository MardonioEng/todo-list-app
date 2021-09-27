<?php

namespace App\Providers;

use App\Domain\Interfaces\INotificador;
use App\Domain\Interfaces\Repository\ICategoriaRepository;
use App\Domain\Interfaces\Repository\IItemRepository;
use App\Domain\Interfaces\Repository\IUsuarioRepository;
use App\Domain\Interfaces\Service\ICategoriaService;
use App\Domain\Interfaces\Service\IItemService;
use App\Domain\Interfaces\Service\IUsuarioService;
use App\Domain\Notificacao\Notificador;
use App\Domain\Services\CategoriaService;
use App\Domain\Services\ItemService;
use App\Domain\Services\UsuarioService;
use App\Repository\CategoriaRepository;
use App\Repository\ItemRepository;
use App\Repository\UsuarioRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(INotificador::class, Notificador::class);

        $this->app->bind(IItemService::class, ItemService::class);
        $this->app->bind(ICategoriaService::class, CategoriaService::class);
        $this->app->bind(IUsuarioService::class, UsuarioService::class);

        $this->app->bind(IItemRepository::class, ItemRepository::class);
        $this->app->bind(ICategoriaRepository::class, CategoriaRepository::class);
        $this->app->bind(IUsuarioRepository::class, UsuarioRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
