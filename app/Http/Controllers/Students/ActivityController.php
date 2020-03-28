<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserActivity;
use App\Activity;

use Auth;

class ActivityController extends Controller
{
    public function register(Activity $activity)
    {
        $user = Auth::user();
        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();

        $entity = UserActivity::create([
            'user_id' => $user->id,
            'activity_id' => $activity->id
        ]);

        return response()
            ->json($entity);
    }

    public function unregister(Activity $activity)
    {
        $user = Auth::user();
        $userActivities = UserActivity::query()
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->delete();

        return response()
            ->json(['res'=>true]);
    }
}
