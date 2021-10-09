<?php

namespace App\Policies;

use App\ImageRecipie;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImageRecipiePolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any image recipies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the image recipie.
     *
     * @param  \App\User  $user
     * @param  \App\ImageRecipie  $imageRecipie
     * @return mixed
     */
    public function view(User $user, ImageRecipie $imageRecipie)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can create image recipies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can update the image recipie.
     *
     * @param  \App\User  $user
     * @param  \App\ImageRecipie  $imageRecipie
     * @return mixed
     */
    public function update(User $user, ImageRecipie $imageRecipie)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can delete the image recipie.
     *
     * @param  \App\User  $user
     * @param  \App\ImageRecipie  $imageRecipie
     * @return mixed
     */
    public function delete(User $user, ImageRecipie $imageRecipie)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the image recipie.
     *
     * @param  \App\User  $user
     * @param  \App\ImageRecipie  $imageRecipie
     * @return mixed
     */
    public function restore(User $user, ImageRecipie $imageRecipie)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the image recipie.
     *
     * @param  \App\User  $user
     * @param  \App\ImageRecipie  $imageRecipie
     * @return mixed
     */
    public function forceDelete(User $user, ImageRecipie $imageRecipie)
    {
        //
    }
}
