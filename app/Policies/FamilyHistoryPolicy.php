<?php

namespace App\Policies;

use App\FamilyHistory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FamilyHistoryPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any family histories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the family history.
     *
     * @param  \App\User  $user
     * @param  \App\FamilyHistory  $familyHistory
     * @return mixed
     */
    public function view(User $user, FamilyHistory $familyHistory)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create family histories.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the family history.
     *
     * @param  \App\User  $user
     * @param  \App\FamilyHistory  $familyHistory
     * @return mixed
     */
    public function update(User $user, FamilyHistory $familyHistory)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the family history.
     *
     * @param  \App\User  $user
     * @param  \App\FamilyHistory  $familyHistory
     * @return mixed
     */
    public function delete(User $user, FamilyHistory $familyHistory)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can restore the family history.
     *
     * @param  \App\User  $user
     * @param  \App\FamilyHistory  $familyHistory
     * @return mixed
     */
    public function restore(User $user, FamilyHistory $familyHistory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the family history.
     *
     * @param  \App\User  $user
     * @param  \App\FamilyHistory  $familyHistory
     * @return mixed
     */
    public function forceDelete(User $user, FamilyHistory $familyHistory)
    {
        //
    }
}
