<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Domain\Aluno\AlunoRepository;
use App\Domain\Aluno\EloquentAlunoRepository;
use App\Domain\Aluno\AlunoService;

use App\Domain\Usuario\UsuarioRepository;
use App\Domain\Usuario\EloquentUsuarioRepository;
use App\Domain\Usuario\UsuarioService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(AlunoRepository::class, EloquentAlunoRepository::class);
        $this->app->bind(AlunoService::class, function ($app) {
            return new AlunoService($app->make(AlunoRepository::class));
        });

        //
        $this->app->bind(UsuarioRepository::class, EloquentUsuarioRepository::class);
        $this->app->bind(UsuarioService::class, function ($app) {
            return new UsuarioService($app->make(UsuarioRepository::class));
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
