<?php

namespace App\Policies;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user){

        return $user->can('is-admin');

    }
    public function user(User $user){

        return $user->can('is-user');

    }
}
