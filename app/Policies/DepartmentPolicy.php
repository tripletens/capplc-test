<?php

namespace App\Policies;

use App\Models\User;

class DepartmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // view departments 
    public function view(User $user){
        return $user->hasRole('admin');
    }

    // create department 
    public function create(User $user){
        return $user->hasRole('admin');
    }

    // update department 
    public function delete(User $user){
        return $user->hasRole('admin');
    }
}

