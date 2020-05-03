<?php

namespace App\Repositories;

use App\Activity;
use App\UserActivity;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


interface IActivityRepository
{
    /**
     * Verification if the user is in the same grade of the actovity
     *
     * @param Activity $activity
     * @param User $user
     * @return boolean
     */
    public function forTheUser(Activity $activity, User $user): bool;

    /**
     * Register some activity was done by the user
     *
     * @param Activity $activity
     * @param User $user
     * @return UserActivity
     */
    public function register(Activity $activity, User $user) : UserActivity ;

    /**
     * Register some activity wasn't done by the user
     *
     * @param Activity $activity
     * @param User $user
     * @return void
     */
    public function unregister(Activity $activity, User $user) : void;

    /**
     * Calculate the status of an activity relative to the complete grade.
     *
     * @param Activity $today
     * @param User $user
     * @return array
     */
    public function calcGradeStatusOf(Activity $today, User $user): object;

    /**
     * Find the current week's pending activities for an user.
     *
     * @param User $user
     * @return array of Activity
     */
    public function pendingActivities(User $user): array;
}
