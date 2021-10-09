<?php

namespace App\Policies;

use App\DrugAllergies;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DrugAllergiesPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any drug allergies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the drug allergies.
     *
     * @param  \App\User  $user
     * @param  \App\DrugAllergies  $drugAllergies
     * @return mixed
     */
    public function view(User $user, DrugAllergies $drugAllergies)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create drug allergies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the drug allergies.
     *
     * @param  \App\User  $user
     * @param  \App\DrugAllergies  $drugAllergies
     * @return mixed
     */
    public function update(User $user, DrugAllergies $drugAllergies)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the drug allergies.
     *
     * @param  \App\User  $user
     * @param  \App\DrugAllergies  $drugAllergies
     * @return mixed
     */
    public function delete(User $user, DrugAllergies $drugAllergies)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can restore the drug allergies.
     *
     * @param  \App\User  $user
     * @param  \App\DrugAllergies  $drugAllergies
     * @return mixed
     */
    public function restore(User $user, DrugAllergies $drugAllergies)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the drug allergies.
     *
     * @param  \App\User  $user
     * @param  \App\DrugAllergies  $drugAllergies
     * @return mixed
     */
    public function forceDelete(User $user, DrugAllergies $drugAllergies)
    {
        //
    }
}
