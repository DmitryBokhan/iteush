<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getRoles(){
        return auth()->user()->roles;
    }

    public function getPermissions(){
        $roles = auth()->user()->roles;
        $permissions = new Collection();
        foreach ($roles as $role){
            $permissions= $permissions->concat($role->permissions);
        }
        return $roles;
    }
};

