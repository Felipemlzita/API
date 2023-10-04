<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Aluno\AlunoRepository;
use App\Domain\Aluno\EloquentAlunoRepository;
use App\Domain\Aluno\AlunoService;

use App\Domain\Usuario\UsuarioRepository;
use App\Domain\Usuario\EloquentUsuarioRepository;
use App\Domain\Usuario\UsuarioService;

use App\Domain\Campo\CampoRepository;
use App\Domain\Campo\EloquentCampoRepository;
use App\Domain\Campo\CampoService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        //
        $this->app->bind(UsuarioRepository::class, EloquentUsuarioRepository::class);
        $this->app->bind(UsuarioService::class, function ($app) {
            return new UsuarioService($app->make(UsuarioRepository::class));
        });

        //
        $this->app->bind(CampoRepository::class, EloquentCampoRepository::class);
        $this->app->bind(CampoService::class, function ($app) {
            return new CampoService($app->make(CampoRepository::class));
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
