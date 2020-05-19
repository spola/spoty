<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

use App\Services\DTO\TeacherReportedData;
use App\User;
use App\Grade;


class TeacherService implements ITeacherService
{
    public function DailyReport(Grade $grade): TeacherReportedData {
        $date = Carbon::now(); // or whatever you're using to set it
        $start = $date->copy()->startOfDay();
        $end = $date->copy()->endOfDay();

        $ids = $grade->courses->pluck('id')->toArray();




        $data = new TeacherReportedData();

        $data->grade    = $grade;
        $data->teacher  = $grade->teacher;

        $data->activities_count = 0;
        $data->done_count = 0;
        $data->no_done_count = 0;

        $data->students = [];

        return $data;
    }
}
