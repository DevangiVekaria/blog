<?php

namespace App\Providers;


use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\PermissionRepository;
use App\Repositories\PostRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind(PostRepositoryInterface::class, function ($app) {
            return $app->make(PostRepository::class);
        });

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return $app->make(UserRepository::class);
        });

        $this->app->bind(RoleRepositoryInterface::class, function ($app) {
            return $app->make(RoleRepository::class);
        });

        $this->app->bind(PermissionRepositoryInterface::class, function ($app) {
            return $app->make(PermissionRepository::class);
        });
    }
}
