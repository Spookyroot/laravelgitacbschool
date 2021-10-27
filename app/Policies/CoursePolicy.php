<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    function update(User $user) {
        return $user->isAdministrator();
        }
        function create(User $user) {
        
        return $this->update($user);
        }
        function delete(User $user) {
        
        return $this->update($user);
        }
}

