<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    //    public function viewAny(User $user)
    //     {
    //         return $user->hasRole(['admin', 'manager']);
    //     }

    //     public function view(User $user, User $model)
    //     {
    //         return $user->hasRole(['admin', 'manager']) || $user->id === $model->id;
    //     }

    //     public function create(User $user)
    //     {
    //         return $user->hasRole('admin');
    //     }

    //     public function update(User $user, User $model)
    //     {
    //         return $user->hasRole('admin') || ($user->hasRole('manager') && $model->hasRole('employee'));
    //     }

    //     public function delete(User $user, User $model)
    //     {
    //         return $user->hasRole('admin');
    //     } 
}
