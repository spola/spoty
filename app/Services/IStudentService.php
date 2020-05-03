<?php

namespace App\Services;

use App\User;
use Illuminate\Database\Eloquent\Collection;

interface IStudentService
{
    /**
     * Find the pending activities for a given student returning the activities, today activities  and the stadistics.
     *
     * @param User $user
     * @return LandActivities
     */
    public function landActivities(User $user) : LandActivities;

    public function land(User $user): LandStudent;
}
