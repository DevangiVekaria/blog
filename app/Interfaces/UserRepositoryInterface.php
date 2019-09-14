<?php


namespace App\Interfaces;


interface UserRepositoryInterface
{
    public function getAll();

    public function get($id);

    public function delete($id);

    public function update($values, $id);
}
