<?php


namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAll();

    public function getWithLimit($limit);

    public function get($id);

    public function store($values);

    public function update($values, $id);

    public function delete($id);
}
