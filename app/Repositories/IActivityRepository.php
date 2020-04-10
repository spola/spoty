<?php

namespace App\Repositories;

use App\Activity;
use App\UserActivity;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


interface IActivityRepository
{
    public function register(Activity $activity, User $user) : UserActivity ;

    public function unregister(Activity $activity, User $user) : void;
}
