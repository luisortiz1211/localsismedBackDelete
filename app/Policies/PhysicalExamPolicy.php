<?php

namespace App\Policies;

use App\PhysicalExam;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhysicalExamPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->isGranted(User::ROLE_ADMIN)) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any physical exams.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can view the physical exam.
     *
     * @param  \App\User  $user
     * @param  \App\PhysicalExam  $physicalExam
     * @return mixed
     */
    public function view(User $user, PhysicalExam $physicalExam)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can create physical exams.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can update the physical exam.
     *
     * @param  \App\User  $user
     * @param  \App\PhysicalExam  $physicalExam
     * @return mixed
     */
    public function update(User $user, PhysicalExam $physicalExam)
    {
        return $user->isGranted(User::ROLE_ASSISTENT);
    }

    /**
     * Determine whether the user can delete the physical exam.
     *
     * @param  \App\User  $user
     * @param  \App\PhysicalExam  $physicalExam
     * @return mixed
     */
    public function delete(User $user, PhysicalExam $physicalExam)
    {
        return $user->isGranted(User::ROLE_ADMIN);
    }

    /**
     * Determine whether the user can restore the physical exam.
     *
     * @param  \App\User  $user
     * @param  \App\PhysicalExam  $physicalExam
     * @return mixed
     */
    public function restore(User $user, PhysicalExam $physicalExam)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the physical exam.
     *
     * @param  \App\User  $user
     * @param  \App\PhysicalExam  $physicalExam
     * @return mixed
     */
    public function forceDelete(User $user, PhysicalExam $physicalExam)
    {
        //
    }
}
