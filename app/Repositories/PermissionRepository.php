<?php


namespace App\Repositories;


use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $permissionModel;

    /**
     * PermissionRepository constructor.
     */
    public function __construct()
    {
        $this->permissionModel = new Permission();
    }


    public function getAll()
    {
        return $this->permissionModel->get();
    }

    public function get($id)
    {
        return $this->permissionModel->findOrFail($id);
    }
}
