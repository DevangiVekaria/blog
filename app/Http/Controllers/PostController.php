<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    protected $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $limit = 3;
        $posts = $this->postRepository->getWithLimit($limit);
        return view('posts.list', compact('posts'));
    }

    public function create()
    {
        return view('posts.form');
    }

    public function store(StorePost $request)
    {
        try {
            $values = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ];
            $this->postRepository->store($values);
            $message = [
                'type' => 'success',
                'message' => 'Posted Blog Successfully'
            ];
            return redirect()->route('posts')->with('message', $message);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            return back()->withErrors('Failed to Add Post.');
        }
    }

    public function edit($id)
    {
        try {
            $post = $this->postRepository->get($id);
            return view('posts.form', compact('post'))->with('editId', $id);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            $message = [
                'type' => 'danger',
                'message' => 'Can not Find Record to Edit'
            ];
            return redirect()->route('posts')->with('message', $message);
        }
    }

    public function update(StorePost $request, $id)
    {
        try {
            $values = [
                'title' => $request->title,
                'description' => $request->description
            ];
            $this->postRepository->update($values, $id);
            $message = [
                'type' => 'success',
                'message' => 'Updated Post Successfully'
            ];
            return redirect()->route('posts')->with('message', $message);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            return back()->withErrors('Failed to Update Post.');
        }
    }

    public function delete($id)
    {
        try {
            $this->postRepository->delete($id);
            $message = [
                'type' => 'success',
                'message' => 'Deleted Post Successfully'
            ];
            return redirect()->route('posts')->with('message', $message);
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            return back()->withErrors('Failed to Delete Post.');
        }
    }

}
