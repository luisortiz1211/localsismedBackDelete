<?php

namespace App\Policies;

use App\PersonalHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonalHistoryPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any personal histories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the personal history.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalHistory  $personalHistory
     * @return mixed
     */
    public function view(User $user, PersonalHistory $personalHistory)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create personal histories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the personal history.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalHistory  $personalHistory
     * @return mixed
     */
    public function update(User $user, PersonalHistory $personalHistory)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the personal history.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalHistory  $personalHistory
     * @return mixed
     */
    public function delete(User $user, PersonalHistory $personalHistory)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the personal history.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalHistory  $personalHistory
     * @return mixed
     */
    public function restore(User $user, PersonalHistory $personalHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the personal history.
     *
     * @param  \App\User  $user
     * @param  \App\PersonalHistory  $personalHistory
     * @return mixed
     */
    public function forceDelete(User $user, PersonalHistory $personalHistory)
    {
        //
    }
}
