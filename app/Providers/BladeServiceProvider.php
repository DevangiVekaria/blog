<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        Blade::if('permission', function ($permission) {
            $role = Auth::user()->role()->with(['permissions' => function ($query) {
                $query->select('role_id', 'name');
            }])->first();

            if ($role->permissions->pluck("name")->contains($permission)) {
                return true;
            }
            return false;
        });
    }
}
