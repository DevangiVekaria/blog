<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $role =$request->user()->role()->with(['permissions' => function ($query) {
            $query->select('role_id', 'name');
        }])->first();
        if ($this->auth->guest() || !$role->permissions->pluck("name")->contains($permission)) {
            abort(403);
        }
        return $next($request);
    }
}
