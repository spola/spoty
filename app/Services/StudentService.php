<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

use App\Activity;
use App\News;
use App\User;
use App\Repositories\IActivityRepository;
use Carbon\Carbon;

class LandStudent {
    public $activities;
    public $today;
    public $dones;
    public $news;
}
class LandActivities {
    public $activities;
    public $today;
    public $dones;
}

class StudentService implements IStudentService
{
    /**
     * Repository of activities
     *
     * @var IActivityRepository
     */
    private $activityRepository;

    public function __construct(IActivityRepository $activityRepository) {
        $this->activityRepository = $activityRepository;
    }

    public function landActivities(User $user) : LandActivities {
        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $dones = null;
        $today = null;
        $activities = $this->activityRepository->pendingActivities($user);

        $todayPending = array_filter($activities, function ($item) {
            return $item->due_date->isToday();
        });

        if(!empty($todayPending)) {
            $today = array_shift($todayPending);
            $dones = $this->activityRepository->calcGradeStatusOf($today, $user);

            $activities = array_filter($activities, function ($item) use($today) {
                return $item->id != $today->id;
            });
        }

        $return = new LandActivities();
        $return->activities = $activities;
        $return->today = $today;
        $return->dones = $dones;

        return $return;
    }

    public function land(User $user): LandStudent {

        $data = $this->landActivities($user);

        $news = News::where('grade_id', $user->grade_id)
            ->where('published', '<=', Carbon::now())
            ->orderBy('published', 'desc')
            ->take(5)
            ->get();

        $return = new LandStudent();

        $return->activities = $data->activities;
        $return->today = $data->today;
        $return->dones = $data->dones;

        $return->news = $news;

        return $return;
    }
}
