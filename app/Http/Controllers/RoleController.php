<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    /**
     * RoleController constructor.
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRepositoryInterface $permissionRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }


    public function index()
    {
        $roles = $this->roleRepository->getAll();
        return view('roles.list', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->getAll();
        return view('roles.form', compact('permissions'));
    }

    public function store(StoreRole $request)
    {
        try {
            $role = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $permissions = $request->permissions;
            $this->roleRepository->store($role, $permissions);
            $message = [
                'type' => 'success',
                'message' => 'Role Added Successfully'
            ];
            return redirect()->route('roles')->with('message', $message);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            return back()->withErrors('Failed to Create Role');
        }
    }

    public function edit($id)
    {
        try {
            $role = $this->roleRepository->get($id);
            $permissions = $this->permissionRepository->getAll();
            return view('roles.form', compact('role', 'permissions'))->with('editId', $id);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            $message = [
                'type' => 'danger',
                'message' => 'Can not Find Record to Edit'
            ];
            return redirect()->route('roles')->with('message', $message);
        }
    }

    public function update(StoreRole $request, $id)
    {
        try {
            $role = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $permissions = $request->permissions;
            $this->roleRepository->update($role, $permissions, $id);
            $message = [
                'type' => 'success',
                'message' => 'Role Updated Successfully'
            ];
            return redirect()->route('roles')->with('message', $message);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            return back()->withErrors('Failed to Create Role');
        }
    }

    public function delete($id)
    {
        try {
            $users = $this->roleRepository->get($id)->users()->count();
            if ($users > 0) {
                $message = [
                    'type' => 'danger',
                    'message' => 'Failed to Delete. ' . $users . ' user(s) having this role'
                ];
            } else {
                $this->roleRepository->delete($id);
                $message = [
                    'type' => 'success',
                    'message' => 'Role Deleted'
                ];
            }
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            $message = [
                'type' => 'danger',
                'message' => 'Failed to Delete Role'
            ];
        }
        return redirect()->route('roles')->with('message', $message);
    }
}
