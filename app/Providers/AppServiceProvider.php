<?php

namespace App\Providers;

use App\Events\ChirpCreated;
use App\Listeners\SendChirpCreatedNotifications;
use App\Models\User;
use App\Policies\ChirpPolicy;
use Illuminate\Console\Application;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Gate::before(function (User $user, string $ability) {
        //     if ($user->isAdministrator()) {
        //         return true;
        //     }
        // });

        $this->app->bindMethod([SendChirpCreatedNotifications::class, 'handle'], function (SendChirpCreatedNotifications $job, Application $app) {
            return $job->handle($app->make(ChirpCreated::class));
        });

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
    }
}
