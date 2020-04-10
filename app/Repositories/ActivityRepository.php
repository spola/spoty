<?php

namespace App\Repositories;

use App\Activity;
use App\UserActivity;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ActivityRepository implements IActivityRepository
{
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
