<?php

namespace App\Policies;

use App\EmergencyContact;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmergencyContactPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any emergency contacts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //return $user->isGranted(User::ROLE_ADMIN);
        return true;
    }

    /**
     * Determine whether the user can view the emergency contact.
     *
     * @param  \App\User  $user
     * @param  \App\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function view(User $user, EmergencyContact $emergencyContact)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create emergency contacts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the emergency contact.
     *
     * @param  \App\User  $user
     * @param  \App\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function update(User $user, EmergencyContact $emergencyContact)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the emergency contact.
     *
     * @param  \App\User  $user
     * @param  \App\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function delete(User $user, EmergencyContact $emergencyContact)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the emergency contact.
     *
     * @param  \App\User  $user
     * @param  \App\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function restore(User $user, EmergencyContact $emergencyContact)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the emergency contact.
     *
     * @param  \App\User  $user
     * @param  \App\EmergencyContact  $emergencyContact
     * @return mixed
     */
    public function forceDelete(User $user, EmergencyContact $emergencyContact)
    {
        //
    }
}
