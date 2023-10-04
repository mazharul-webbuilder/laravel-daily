<?php

namespace App\Traits;

use App\Models\Permission;

trait HasPermissionTrait
{
//    get permission
    public function getAllPermissions($permission) {
        return Permission::whereIn('slug', $permission)->get();
    }

//    check has Permission
    public function hasPermission($permission): bool
    {
        return (bool) Permission::where('slug', $permission->slug)->count();
    }

    public function permissions()
    {

    }





}
