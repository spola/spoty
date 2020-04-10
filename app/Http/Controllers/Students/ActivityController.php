<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\IActivityRepository;
use App\UserActivity;
use App\Activity;

use Auth;

class ActivityController extends Controller
{
    private $repository;

    public function __construct(IActivityRepository $repository) {
        $this->repository = $repository;
    }

    public function register(Activity $activity)
    {
        $user = Auth::user();

        $entity = $this->repository->register($activity, $user);

        return response()
            ->json($entity);
    }

    public function unregister(Activity $activity)
    {
        $user = Auth::user();

        $this->repository->unregister($activity, $user);

        return response()
            ->json(['res'=>true]);
    }
}
