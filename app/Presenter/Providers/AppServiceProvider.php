<?php

namespace App\Presenter\Providers;

use App\Application\Command\CommandBus;
use App\Application\Command\InMemoryCommandBus;
use App\Application\Query\InMemoryQueryBus;
use App\Application\Query\QueryBus;
use App\Domain\Repositories\CustomerRepository;
use App\Infrastructure\DBRepositories\EloquentCustomerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CommandBus::class, InMemoryCommandBus::class);
        $this->app->bind(QueryBus::class, InMemoryQueryBus::class);
        $this->app->bind(CustomerRepository::class, EloquentCustomerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
