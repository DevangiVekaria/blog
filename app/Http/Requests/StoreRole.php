<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRole extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = Auth::user()->role()->with(['permissions' => function ($query) {
            $query->select('role_id', 'name');
        }])->first();
        if ($role->permissions->pluck('name')->contains('add-role') || $role->permissions->pluck('name')->contains('edit-role')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|max:200',
            'permissions' => 'required'
        ];
    }
}
