<?php

namespace App\Policies;

use App\ExplorationPatient;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExplorationPatientPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any exploration patients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the exploration patient.
     *
     * @param  \App\User  $user
     * @param  \App\ExplorationPatient  $explorationPatient
     * @return mixed
     */
    public function view(User $user, ExplorationPatient $explorationPatient)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can create exploration patients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can update the exploration patient.
     *
     * @param  \App\User  $user
     * @param  \App\ExplorationPatient  $explorationPatient
     * @return mixed
     */
    public function update(User $user, ExplorationPatient $explorationPatient)
    {
        return $user->isGranted(User::ROLE_MEDIC);
    }

    /**
     * Determine whether the user can delete the exploration patient.
     *
     * @param  \App\User  $user
     * @param  \App\ExplorationPatient  $explorationPatient
     * @return mixed
     */
    public function delete(User $user, ExplorationPatient $explorationPatient)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the exploration patient.
     *
     * @param  \App\User  $user
     * @param  \App\ExplorationPatient  $explorationPatient
     * @return mixed
     */
    public function restore(User $user, ExplorationPatient $explorationPatient)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the exploration patient.
     *
     * @param  \App\User  $user
     * @param  \App\ExplorationPatient  $explorationPatient
     * @return mixed
     */
    public function forceDelete(User $user, ExplorationPatient $explorationPatient)
    {
        //
    }
}
