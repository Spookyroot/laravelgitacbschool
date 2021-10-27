<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    function update(User $user) {
        return $user->isAdministrator();
        }
        
            function create(User $user) {
            return $this->update($user);
            }

       /* function delete(User $user, Subject $subject) {
        
        $subject->loadCount('courses');
        return $this->update($user) &&($subject->courses_count === 0);
        }*/
            function delete(User $user) {return $this->update($user);}
        }
