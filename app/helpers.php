<?php

use App\PosSetting;
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

if(!function_exists('useInRole')) {
    function useInRole($role) {
        $rolesData = is_array($role) ?  $role : [$role];
        $user =  Auth::user();
        $role = Role::find($user->role_id);
        return in_array($role->name, $rolesData);
    }
}

if(!function_exists('getDefaultSupplier')) {
    function getDefaultSupplier() {
        return PosSetting::first()->supplier_id;
    }
}
