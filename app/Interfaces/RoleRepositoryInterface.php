<?php


namespace App\Interfaces;


interface RoleRepositoryInterface
{
    public function getAll();

    public function getCustomColumns($columns);

    public function get($id);

    public function store($role, $permissions);

    public function update($role, $permissions, $roleId);

    public function delete($id);
}
