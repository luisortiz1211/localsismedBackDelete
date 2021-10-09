<?php

namespace App\Policies;

use App\ScheduleUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScheduleUserPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
    if ($user->isGranted(User::ROLE_ADMIN)) {
    return true;
    }
    }
    /**
     * Determine whether the user can view any schedule users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can view the schedule user.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleUser  $scheduleUser
     * @return mixed
     */
    public function view(User $user, ScheduleUser $scheduleUser)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create schedule users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can update the schedule user.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleUser  $scheduleUser
     * @return mixed
     */
    public function update(User $user, ScheduleUser $scheduleUser)
    {
        //return $user->id === $scheduleUser->user_id;
        return $user->isGranted(User::ROLE_ASSISTENT) ;
    }

    /**
     * Determine whether the user can delete the schedule user.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleUser  $scheduleUser
     * @return mixed
     */
    public function delete(User $user, ScheduleUser $scheduleUser)
    {
        return $user->isGranted(User::ROLE_ADMIN) ;
    }

    /**
     * Determine whether the user can restore the schedule user.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleUser  $scheduleUser
     * @return mixed
     */
    public function restore(User $user, ScheduleUser $scheduleUser)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the schedule user.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleUser  $scheduleUser
     * @return mixed
     */
    public function forceDelete(User $user, ScheduleUser $scheduleUser)
    {
        //
    }
}
