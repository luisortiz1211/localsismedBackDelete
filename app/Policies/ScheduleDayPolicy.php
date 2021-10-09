<?php

namespace App\Policies;

use App\ScheduleDay;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScheduleDayPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any schedule days.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //return $user->isGranted(User::ROLE_ASSISTENT);
        return true;
    }

    /**
     * Determine whether the user can view the schedule day.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleDay  $scheduleDay
     * @return mixed
     */
    public function view(User $user, ScheduleDay $scheduleDay)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create schedule days.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the schedule day.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleDay  $scheduleDay
     * @return mixed
     */
    public function update(User $user, ScheduleDay $scheduleDay)
    {
        //return $user->id === $scheduleDay->user_id;
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the schedule day.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleDay  $scheduleDay
     * @return mixed
     */
    public function delete(User $user, ScheduleDay $scheduleDay)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can restore the schedule day.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleDay  $scheduleDay
     * @return mixed
     */
    public function restore(User $user, ScheduleDay $scheduleDay)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the schedule day.
     *
     * @param  \App\User  $user
     * @param  \App\ScheduleDay  $scheduleDay
     * @return mixed
     */
    public function forceDelete(User $user, ScheduleDay $scheduleDay)
    {
        //
    }
}
