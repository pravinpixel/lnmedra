<?php

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

if(!function_exists('userHasAccess')) {
    function userHasAccess($permission) {
       $user =  Auth::user();
       $role = Role::find($user->role_id);
       if($role->name == 'admin'){
           return true;
       }
       return $role->hasPermissionTo($permission);
    }
}

if(!function_exists('user')) {
    function user() {
        return Auth::user();
    }
}
