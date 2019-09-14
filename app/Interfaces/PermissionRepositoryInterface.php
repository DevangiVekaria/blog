<?php


namespace App\Interfaces;


interface PermissionRepositoryInterface
{
    public function getAll();

    public function get($id);
}
