<?php

namespace App\Providers;

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
        // usecase
        $this->app->bind(
            \packages\UseCase\User\UserCreateUseCaseInterface::class,
            \packages\Domain\Application\User\UserCreateInteractor::class
        );
        $this->app->bind(
            \packages\UseCase\Game\GamePlayUseCaseInterface::class,
            \packages\Domain\Application\Game\GamePlayInteractor::class
        );

        // repository
        $this->app->bind(
            \packages\Domain\Domain\User\UserRepositoryInterface::class,
            \packages\Infrastructure\Eloquent\User\UserRepository::class
        );
        $this->app->bind(
            \packages\Domain\Domain\Account\AccountRepositoryInterface::class,
            \packages\Infrastructure\Eloquent\Account\AccountRepository::class
        );

        // domein
        $this->app->bind(
            \packages\Domain\Domain\Game\GameInterface::class,
            \packages\Domain\Domain\Game\Game::class
        );
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
