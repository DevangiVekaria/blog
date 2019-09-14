<?php


namespace App\Repositories;


use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    protected $postModel;

    /**
     * PostRepository constructor.
     * @param $postModel
     */
    public function __construct()
    {
        $this->postModel = new Post();
    }


    public function getAll()
    {
        return $this->postModel->with('user')->get();
    }

    public function getWithLimit($limit = 3)
    {
        return $this->postModel->with(['user' => function ($query) {
            $query->select(['id', 'name']);
        }])->latest()->paginate($limit);
    }

    public function get($id)
    {
        return $this->postModel->findOrFail($id);
    }

    public function store($values)
    {
        return $this->postModel->create($values);
    }

    public function update($values, $id)
    {
        return $this->postModel->where('id', $id)->update($values);
    }

    public function delete($id)
    {
        return $this->postModel->find($id)->delete();
    }
}
