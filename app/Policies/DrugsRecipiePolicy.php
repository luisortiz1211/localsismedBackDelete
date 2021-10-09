<?php

namespace App\Policies;

use App\DrugsRecipie;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DrugsRecipiePolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any drugs recipies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the drugs recipie.
     *
     * @param  \App\User  $user
     * @param  \App\DrugsRecipie  $drugsRecipie
     * @return mixed
     */
    public function view(User $user, DrugsRecipie $drugsRecipie)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can create drugs recipies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can update the drugs recipie.
     *
     * @param  \App\User  $user
     * @param  \App\DrugsRecipie  $drugsRecipie
     * @return mixed
     */
    public function update(User $user, DrugsRecipie $drugsRecipie)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can delete the drugs recipie.
     *
     * @param  \App\User  $user
     * @param  \App\DrugsRecipie  $drugsRecipie
     * @return mixed
     */
    public function delete(User $user, DrugsRecipie $drugsRecipie)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can restore the drugs recipie.
     *
     * @param  \App\User  $user
     * @param  \App\DrugsRecipie  $drugsRecipie
     * @return mixed
     */
    public function restore(User $user, DrugsRecipie $drugsRecipie)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the drugs recipie.
     *
     * @param  \App\User  $user
     * @param  \App\DrugsRecipie  $drugsRecipie
     * @return mixed
     */
    public function forceDelete(User $user, DrugsRecipie $drugsRecipie)
    {
        //
    }
}
