<?php

namespace App\Http\Controllers;

use App\Events\RoleChanged;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }


    public function index()
    {
        $currentUser = Auth::user();
        $users = $this->userRepository->getAll()->except($currentUser->id);
        $roles = $this->roleRepository->getCustomColumns(['id', 'name']);
        if ($currentUser->role_id != 1) {
            $roles = $roles->except(1);
        }
        $roles = $roles->sort()->pluck('name', 'id');
        return view('users.list', compact('users', 'roles'));
    }

    public function delete($id)
    {
        try {
            $this->userRepository->delete($id);
            $message = [
                'type' => 'success',
                'message' => 'User Deleted'
            ];
        } catch (\Exception $exception) {
            if (env('APP_DEBUG')) {
                dd($exception->getMessage());
            }
            $message = [
                'type' => 'danger',
                'message' => 'Failed to Delete User'
            ];
        }
        return redirect()->route('users')->with('message', $message);
    }

    public function ajaxRoleUpdate(Request $request)
    {
        try {
            $values = [
                'role_id' => $request->roleId
            ];
            $userId = $request->userId;
            $this->userRepository->update($values, $userId);

            event(new RoleChanged($userId, $this->roleRepository->get($request->roleId)->name));

            return ['message' => 'success'];
        } catch (\Exception $exception) {
            return ['message' => 'error'];
        }
    }
}
