<?php

namespace App\Providers;

use App\Events\QuizAttemptCompleted;
use App\Listeners\SendQuizResultEmail;
use App\Repositories\Contracts\PortfolioRepositoryInterface;
use App\Repositories\Contracts\QuizAttemptRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\PortfolioRepository;
use App\Repositories\QuizAttemptRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PortfolioRepositoryInterface::class, PortfolioRepository::class);
        $this->app->bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        $this->app->bind(QuizAttemptRepositoryInterface::class, QuizAttemptRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('skill-test-start', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip());
        });

        Event::listen(QuizAttemptCompleted::class, SendQuizResultEmail::class);
    }
}
