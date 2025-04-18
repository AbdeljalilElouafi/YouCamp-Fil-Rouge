<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\ServiceRepository;
use App\Repositories\Interfaces\AubergeRepositoryInterface;
use App\Repositories\AubergeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(AubergeRepositoryInterface::class, AubergeRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
