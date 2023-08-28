<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Aluno\AlunoRepository;
use App\Domain\Aluno\EloquentAlunoRepository;
use App\Domain\Aluno\AlunoService;

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

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
