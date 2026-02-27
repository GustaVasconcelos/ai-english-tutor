<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\LearningProfileRepositoryInterface;
use App\Repositories\LearningProfileRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\AgentConversationMessageRepositoryInterface;
use App\Repositories\AgentConversationMessageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            LearningProfileRepositoryInterface::class,
            LearningProfileRepository::class,
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
        $this->app->bind(
            AgentConversationMessageRepositoryInterface::class,
            AgentConversationMessageRepository::class,
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
