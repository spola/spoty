<?php

namespace App\Repositories;

use App\Activity;
use App\UserActivity;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ActivityRepository implements IActivityRepository
{

    public function forTheUser(Activity $activity, User $user): bool {
        $cant = $user->grade->courses()->where('id', $activity->course_id)->count();

        return $cant != 0;
    }


    public function register(Activity $activity, User $user) : UserActivity {

        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();

        $entity = UserActivity::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id
        ]);

        return $entity;
    }

    public function unregister(Activity $activity, User $user) : void {

        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();
    }
}
