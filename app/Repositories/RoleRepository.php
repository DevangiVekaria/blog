<?php


namespace App\Repositories;


use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RoleRepositoryInterface
{

    protected $roleModel;

    /**
     * RoleRepository constructor.
     */
    public function __construct()
    {
        $this->roleModel = new Role();
    }

    public function getAll()
    {
        return $this->roleModel->get();
    }

    public function getCustomColumns($columns)
    {
        return $this->roleModel->select($columns)->get();
    }

    public function get($id)
    {
        return $this->roleModel->find($id);
    }

    public function store($role, $permissions)
    {
        try {
            DB::beginTransaction();
            $roleRecord = $this->roleModel->create($role);
            $roleRecord->rolePermissions()->sync($permissions);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function update($role, $permissions, $roleId)
    {
        try {
            DB::beginTransaction();
            $this->roleModel->where('id', $roleId)->update($role);
            $this->roleModel->find($roleId)->rolePermissions()->sync($permissions);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function delete($id)
    {
        return $this->roleModel->findOrFail($id)->delete();
    }
}
