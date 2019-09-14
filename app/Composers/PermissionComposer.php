<?php


namespace App\Composers;


use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PermissionComposer
{
    public function compose(View $view)
    {
        $auth = Auth::user();
        $permissions = [];
        if ($auth) {
            $role = $auth->role()->with(['permissions' => function ($query) {
                $query->select('role_id', 'name');
            }])->first();
            $permissions = $role->permissions->pluck("name");
        }
        $view->with('userPermissions', $permissions);
    }
}
