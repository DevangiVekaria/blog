<?php


namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    protected $userModel;

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->userModel = new User();
    }


    public function getAll()
    {
        return $this->userModel->with(['role' => function ($query) {
            $query->select(['id', 'name']);
        }])->get();
    }

    public function get($id)
    {
        return $this->userModel->find($id)->with(['role' => function ($query) {
            $query->select(['id', 'name']);
        }]);
    }

    public function delete($id)
    {
        return $this->userModel->findOrFail($id)->delete();
    }

    public function update($values, $id)
    {
        return $this->userModel->findOrFail($id)->update($values);
    }
}
