<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

use App\Activity;
use App\News;
use App\User;
use App\Repositories\IActivityRepository;
use Carbon\Carbon;

class ParentService implements IParentService
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

    public function land(User $user): array {
		$respuesta = [];

        foreach($user->childrens as $student) {

			$queryStr = "SELECT
            (select count(1) as done
                from user_activities
                where user_id = :user_id_1
                and deleted_at is null) as 'done',


            (select count(1) as total
                from activities a
                where a.course_id in (select id from courses c2 where c2.grade_id = :grade_id_1)) as 'total',

            (SELECT count(1) from activities a
                WHERE a.due_date BETWEEN :week_start_1 and :week_end_1
                AND a.course_id in (select id from courses c2 where c2.grade_id = :grade_id_6)
            ) as 'week',

            (SELECT count(1) from activities a
                WHERE a.due_date BETWEEN :week_start_2 and :week_end_2
                AND a.course_id in (select id from courses c2 where c2.grade_id = :grade_id_5)
                AND a.id not in ( select ua.activity_id from user_activities ua where user_id = :user_id_2 and deleted_at is null )
            ) as 'week_remaining',

            (SELECT count(1) from activities a
                WHERE a.due_date <= :today
                AND a.course_id in (select id from courses c2 where c2.grade_id = :grade_id_4)
                AND a.id not in ( select ua.activity_id from user_activities ua where user_id = :user_id_3 and deleted_at is null )
            ) as 'remaining',

            (select count(1) from users u where u.grade_id = :grade_id_2
            ) as 'students',

            (SELECT count(1)
                FROM user_activities ua
                WHERE ua.user_id in (SELECT id FROM users u2 where u2.grade_id = :grade_id_3) and deleted_at is null
            ) as 'average'

            ";

            $today = Carbon::today();

			$result = \DB::select( \DB::raw($queryStr), [
                'user_id_1' => $student->id,
                'user_id_2' => $student->id,
                'user_id_3' => $student->id,

                'grade_id_1' => $student->grade_id,
                'grade_id_2' => $student->grade_id,
                'grade_id_3' => $student->grade_id,
                'grade_id_4' => $student->grade_id,
                'grade_id_5' => $student->grade_id,
                'grade_id_6' => $student->grade_id,

                'week_start_1' => $today->startOfWeek()->format('Y-m-d H:i:s'),
                'week_start_2' => $today->startOfWeek()->format('Y-m-d H:i:s'),
                'week_end_1' => $today->endOfWeek()->format('Y-m-d H:i:s'),
                'week_end_2' => $today->endOfWeek()->format('Y-m-d H:i:s'),
                'today' => $today->format('Y-m-d H:i:s'),
            ]);

            $result = $result[0];

            $result->done = $result->done ?? 0;
            $result->total = $result->total ?? 0;
            $result->week = $result->week ?? 0;
            $result->remaining = $result->remaining ?? 0;

			$respuesta[] = [
                'student' => $student,

                'done' => $result->done ?? 0,
                'total' => $result->total ?? 0,
                'week' => $result->week ?? 0,
                'week_remaining' => $result->week_remaining ?? 0,
                'remaining' => $result->remaining ?? 0,

                'students' => $result->students ?? 0,
                'average' => $result->average / ($result->students ?? 0),
            ];
        }

        return $respuesta;
    }
}
