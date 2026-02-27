<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\LearningProfileRepositoryInterface;
use App\Repositories\LearningProfileRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            LearningProfileRepositoryInterface::class,
            LearningProfileRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
