<?php

namespace App\Providers;

use App\Composers\PermissionComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['roles.list', 'roles.form', 'users.list'], function ($view) {
            $menu = explode('/', request()->getRequestUri())[1];
            $view->with('menu', $menu);
        });
        View::composer(['posts.list','posts.form', 'roles.list', 'roles.form', 'users.list'], PermissionComposer::class);
    }
}
