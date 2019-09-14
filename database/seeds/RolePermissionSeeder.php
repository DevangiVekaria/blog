<?php

use App\Models\Permission;
use App\Models\PermissionToRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Truncate the user table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('permissions_to_roles')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //begin :: role table entries
        $adminRoleId = Role::create([
            'name' => 'Super Admin',
            'description' => 'Super admin with all the permissions'
        ])->id;
        $userRoleId = Role::create([
            'name' => 'User',
            'description' => 'User with limited permissions'
        ])->id;
        //end :: role table entries

        //begin :: user module permissions
        $listUserPermission = Permission::create([
            'name' => 'list-users',
            'display_name' => 'List Users',
            'description' => 'Person can view users.'
        ]);
        $addUserPermission = Permission::create([
            'name' => 'add-user',
            'display_name' => 'Add User',
            'description' => 'Person can add user.'
        ]);
        $editUserPermission = Permission::create([
            'name' => 'edit-user',
            'display_name' => 'Edit User',
            'description' => 'Person can edit user.'
        ]);
        $deleteUserPermission = Permission::create([
            'name' => 'delete-user',
            'display_name' => 'Delete User',
            'description' => 'Person can delete user.'
        ]);
        //end :: user module permissions

        //begin :: role module permissions
        $listRolePermission = Permission::create([
            'name' => 'list-roles',
            'display_name' => 'List Roles',
            'description' => 'Person can view roles.'
        ]);
        $addRolePermission = Permission::create([
            'name' => 'add-role',
            'display_name' => 'Add Role',
            'description' => 'Person can add role.'
        ]);
        $editRolePermission = Permission::create([
            'name' => 'edit-role',
            'display_name' => 'Edit Role',
            'description' => 'Person can edit role.'
        ]);
        $deleteRolePermission = Permission::create([
            'name' => 'delete-role',
            'display_name' => 'Delete Role',
            'description' => 'Person can delete role.'
        ]);
        //end :: post module permissions

        //begin :: post module permissions
        $listPostPermission = Permission::create([
            'name' => 'list-posts',
            'display_name' => 'List Posts',
            'description' => 'Person can view posts.'
        ]);
        $addPostPermission = Permission::create([
            'name' => 'add-post',
            'display_name' => 'Add Post',
            'description' => 'Person can add post.'
        ]);
        $editPostPermission = Permission::create([
            'name' => 'edit-post',
            'display_name' => 'Edit Post',
            'description' => 'Person can edit post.'
        ]);
        $deletePostPermission = Permission::create([
            'name' => 'delete-post',
            'display_name' => 'Delete Post',
            'description' => 'Person can delete post.'
        ]);
        //end :: post module permissions


        //begin :: permissions to Admin
        PermissionToRole::create([
            'permission_id' => $listUserPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $addUserPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $editUserPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $deleteUserPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $listPostPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $addPostPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $editPostPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $deletePostPermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $listRolePermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $addRolePermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $editRolePermission->id,
            'role_id' => $adminRoleId
        ]);
        PermissionToRole::create([
            'permission_id' => $deleteRolePermission->id,
            'role_id' => $adminRoleId
        ]);

        //end :: permission to admin

        //begin :: permission to user
        PermissionToRole::create([
            'permission_id' => $listPostPermission->id,
            'role_id' => $userRoleId
        ]);
        //end :: permission to user
    }
}
